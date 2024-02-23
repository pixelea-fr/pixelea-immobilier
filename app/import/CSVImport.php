<?php 
class CSVImport implements ImportStrategy {
    public function import($file) {
        // Chemin du fichier JSON de progression
            $progressFilePath = WP_CONTENT_DIR . '/progress_data.json';
            // Vérifier si le fichier existe
            if (file_exists($progressFilePath)) {
                // Si le fichier existe, lire son contenu
                $existingProgressData = file_get_contents($progressFilePath);
                // Convertir le JSON en tableau PHP
                $progressDataArray = json_decode($existingProgressData, true);
            } else {
                // Si le fichier n'existe pas, initialiser le tableau de progression
                $progressDataArray = array();
            }
            // Récupérer les données du fichier CSV
            $data = parseImportFileCsv($file);

 

        if (isset($data) && !empty($data) && is_array($data)) {
            // Calculer le nombre total de lignes
            $total_rows = count($data);
            $current_row = 0;
            $limit=40;
     
            foreach ($data as $item) {
                $current_row++;
    
                // Calculer le pourcentage d'avancement
                $progress_percentage = ($current_row / $total_rows) * 100;
                $formatted_percentage = number_format($progress_percentage, 0) . '%';
    
                // Ajouter les données de progression à un tableau
                $progressData = array(
                    'percentage' => $formatted_percentage,
                    'current_row' => $current_row,
                    'total_rows' => $total_rows
                );
                $progressDataArray[] = $progressData;
  
               
                // Envoyer le tableau au client

                // echo json_encode($progressData);
                // flush();
                // ob_flush();

                // Appeler la fonction d'import pour chaque bien
                if($current_row <= $limit){
                    $this->importBien($item);
                    WP_Filesystem();
                    global $wp_filesystem;
                    $wp_filesystem->put_contents($progressFilePath, json_encode($progressDataArray));
                }
            
            }

            // À la fin, ajouter la réponse finale au tableau
            $responseData = array(
                'status' => 'success',
                'message' => null
            );
            // Envoyer le tableau final au client
            wp_send_json_success(array('message' => 'Importation terminée.'));

        }
    
        return false;
    }
    // public function importByRow($file, $current_row = 0) {
    //     // Récupérer les données du fichier CSV
    //     $data = parseImportFileCsv($file);

    //     if (isset($data) && !empty($data) && is_array($data)) {
    //         // Calculer le nombre total de lignes
    //         $total_rows = count($data);
    //         $limit = 10;

    //         // Tableau pour stocker les données de progression
    //         $progressData = array();
     
    //         foreach ($data as $index => $item) {
    //             // Vérifier si nous devons traiter cette ligne
    //             if ($index < $current_row) {
    //                 continue; // Passer à la prochaine itération
    //             }

    //             // Traitement de la ligne $item...
    //             $this->importBien($item);
                

    //             // Calculer le pourcentage d'avancement
    //             $progress_percentage = (($index + 1) / $total_rows) * 100;
    //             $formatted_percentage = number_format($progress_percentage, 0) . '%';

    //             // Ajouter les données de progression au tableau
    //             $progressData = array(
    //                 'percentage' => $formatted_percentage,
    //                 'current_row' => $index + 1,
    //                 'total_rows' => $total_rows
    //             );
    //                // Envoyer les données de progression au client sous forme de JSON
    //             wp_send_json_success($progressData);


    //             // Limiter le nombre de lignes traitées pour chaque appel
    //             if (($index + 1) >= $current_row + $limit) {
    //                 return; // Terminer l'exécution
    //             }
    //         }

    //         // Si toutes les lignes ont été traitées
    //         wp_send_json_success(array('message' => 'Importation terminée.'));
    //     }
    
    //     wp_send_json_error(array('message' => 'Erreur lors de l\'importation du fichier CSV.'));
    // }
    public function create_or_get_term($term_value, $taxonomy, $description = "") {
        $existing_term = term_exists($term_value, $taxonomy);
    
        if ($existing_term) {
            return $existing_term['term_id'];
        } else {
            
            $new_term = wp_insert_term( str_replace('"', '',$term_value), $taxonomy, array('description' => str_replace(array('"',"'"), array('',''),trim($description))));
    
            if (!is_wp_error($new_term)) {
                return $new_term['term_id'];
            } else {
                error_log('Erreur lors de la création du terme : ' . $new_term->get_error_message());
                return null;
            }
        }
    }
    
    public function add_term_to_post($post_id, $term_id, $taxonomy) {
        if (isset($term_id)) {
            wp_set_post_terms($post_id, $term_id, $taxonomy, true);
        } else {
            error_log('ID du terme non défini.');
        }
    }

    public function importBien($data) {
        $table_header_json = __DIR__ . '/csvDataColumns.json';
        $table_header = file_get_contents($table_header_json);
        $json_array = json_decode($table_header, true);
        $combined_array = [];

        foreach ($json_array as $key => $json_key) {
            $combined_array[$json_key] =mb_convert_encoding($data[$key - 1], 'UTF-8', 'ISO-8859-1');
        }

        $post_title = str_replace('"', '', $combined_array['002_ref']);

        $post_args = [
            'post_title'   => $post_title,
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'bien',
        ];

        $existing_post = ng1_get_post_by_title($post_title,"bien");

        if ($existing_post) {
            $post_id = $existing_post->ID;

            foreach ($combined_array as $meta_key => $meta_value) {
                update_post_meta($post_id, $meta_key, str_replace('"', '', $meta_value));
            }

            $this->processTerms($post_id, $combined_array);
            
        } else {
            $post_id = wp_insert_post($post_args);

            if (!is_wp_error($post_id)) {
                foreach ($combined_array as $meta_key => $meta_value) {
                    add_post_meta($post_id, $meta_key, str_replace('"', '', $meta_value), true);
                }
                $this->processTerms($post_id, $combined_array);
            }
        }
        foreach ($combined_array as $meta_key => $meta_value) {
            if (strpos($meta_key, '_photo_') !== false && !empty($meta_value)) {  

                // Si la clé contient le mot "photo", enregistrer l'image

                $this->processImage($post_id, $meta_key, str_replace('"', '',$meta_value));
                
            } else {
                // Sinon, mettre à jour les métadonnées
            // update_post_meta($post_id, $meta_key, str_replace('"', '', $meta_value));
            }
        }
    }

    private function processTerms($post_id, $combined_array) {
        $ville_key_exists = isset($combined_array['006_ville']) && isset($combined_array['005_cp']);
        $type_bien_key_exists = isset($combined_array['004_type_bien']);
        $etat_key_exists = isset($combined_array['136_etat_interieur']);
        //$disponibilite_key_exists = isset($combined_array['136_etat_interieur']);

        if ($ville_key_exists) {
            $term_id = $this->create_or_get_term($combined_array['006_ville'], 'ville', $combined_array['005_cp']);
            $this->add_term_to_post($post_id, $term_id, 'ville');
        } else {
            error_log('Les clés \'006_ville\' ou \'005_cp\' sont absentes dans $combined_array.');
        }

        if ($type_bien_key_exists) {
            $term_id = $this->create_or_get_term($combined_array['004_type_bien'], 'type_de_bien');
            $this->add_term_to_post($post_id, $term_id, 'type_de_bien');
        } else {
            error_log('La clé \'004_type_bien\' est absente dans $combined_array.');
        }
        if ($etat_key_exists) {
            $term_id = $this->create_or_get_term($combined_array['136_etat_interieur'], 'etat');
            $this->add_term_to_post($post_id, $term_id, 'etat');
        } else {
            error_log('La clé \'004_type_bien\' est absente dans $combined_array.');
        }
    }

    /**
     * Traite l'image et effectue les opérations nécessaires.
     *
     * @param int $post_id L'ID du bien.
     * @param string $meta_key La clé méta.
     * @param string $image_url L'URL de l'image.
     * @throws Exception S'il y a une erreur.
     * @return void
     */
    private function processImage($post_id, $meta_key, $image_url) {
        // Générer le titre et la description de l'image
        $photo_number = substr($meta_key, -1);
        $title = "($post_id) Photo $photo_number";
        $description = str_replace('"', '', $image_url);

        // Créer une pièce jointe dans WordPress
        $attachment_id = ng1AddImgFromUrl($image_url, $post_id, $title, $description);

        // Vérifier si l'ajout de l'image a réussi
        if ($attachment_id && !is_wp_error($attachment_id)) {
            if ($photo_number == "1") {
                set_post_thumbnail($post_id, $attachment_id);
            }

            update_post_meta($post_id, $meta_key, $attachment_id);
            return $attachment_id;
        } else {
            // Si l'ajout d'image a échoué, retourner l'URL de l'image directement
            return $image_url;
        }
    }


}
