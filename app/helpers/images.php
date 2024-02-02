<?php 

function ng1AddImgFromUrl($url_download, $post_id, $title, $description = null) {
    // Récupérer l'ID du post auquel l'image est attachée
    $image_id = attachment_url_to_postid($url_download);

    // Si l'image est déjà attachée à un post, retournez son ID
    if ($image_id) {
        return $image_id;
    }

    // Si l'image n'est pas encore attachée, téléchargez-la
    $image_html = media_sideload_image($url_download, $post_id, $title, $description);

    // Vérifier s'il y a des erreurs lors du téléchargement de l'image
    if (is_wp_error($image_html)) {
        return $image_html->get_error_message();
    }

    // Extraire l'URL de l'image du HTML
    preg_match('/src=["\']([^"\']+)["\']/i', $image_html, $matches);
    
    if ($matches && isset($matches[1])) {
        // Obtenir l'ID de l'image à partir de l'URL
        $image_url = $matches[1];
        $image_id = attachment_url_to_postid($image_url);
        return $image_id;
    } else {
        return "Impossible d'extraire l'URL de l'image.";
    }
}



/**
 * Gère une image jointe.
 *
 * Récupère les informations sur l'attachement,
 * vérifie si l'attachement est associé à un article de type 'bien',
 * s'assure que l'attachement est une image,
 * copie l'image dans un répertoire personnalisé,
 * met à jour le champ de métadonnées pour l'image téléchargée avec le nouveau chemin,
 * déplace les tailles d'images associées dans le répertoire personnalisé,
 * met à jour les métadonnées avec les nouveaux chemins pour les tailles d'images,
 * et supprime éventuellement les fichiers du répertoire précédent.
 *
 * @param int $attachment_id L'ID de l'attachement.
 * @throws -
 * @return -
 */

 function ng1_handle_attached_image($attachment_id) {
    global $_wp_additional_image_sizes;
    // Récupérer les informations sur l'attachement
    $attachment = get_post($attachment_id);
    $post_id = $attachment->post_parent;

    if (get_post_type($post_id) !== 'bien') { 
        return;
    }

    // S'assurer qu'il s'agit d'une image et non d'un autre type de fichier
    if (strpos($attachment->post_mime_type, 'image') !== false) {
        // Récupérer les tailles d'images par défaut
    $tailles_par_defaut = get_intermediate_image_sizes();

    // Récupérer les tailles d'images supplémentaires
    $tailles_supplementaires = array_keys($_wp_additional_image_sizes);

    // Fusionner les deux tableaux pour obtenir toutes les tailles d'images
    $image_sizes = array_unique(array_merge($tailles_par_defaut, $tailles_supplementaires));
        //$image_sizes = array('thumbnail', 'medium', 'large');
        foreach ($image_sizes as $size) {
            $image_src = wp_get_attachment_image_src($attachment_id, $size);
            if ($image_src) {
                list($source_url, $width, $height) = $image_src;

                $upload_dir = wp_upload_dir();
                $target_dir = trailingslashit($upload_dir['basedir']) . "/bien/" . $post_id;
                $target_path = $target_dir . '/' . basename($source_url);

                // Assurez-vous que le dossier de destination existe, sinon, créez-le
                if (!file_exists($target_dir)) {
                    wp_mkdir_p($target_dir);
                }

                // Copier l'image dans le dossier personnalisé
                copy($source_url, $target_path);

                // Mettre à jour le champ de métadonnées pour l'image téléchargée avec le nouveau chemin
                update_attached_file($attachment_id, $target_path);

                // Générer les nouvelles métadonnées
                $metadata = wp_generate_attachment_metadata($attachment_id, $target_path);

                // Mettre à jour les métadonnées
                wp_update_attachment_metadata($attachment_id, $metadata);
            }
        }
    }
}



add_action('add_attachment', 'ng1_handle_attached_image');

function custom_upload_dir_for_bien($attachment_id) {
    // Récupérer les informations sur l'attachement
    $attachment = get_post($attachment_id);

    // Vérifier si le post parent est du type souhaité (remplacez 'bien' par le type de post souhaité)
    $post_type = get_post_type($attachment->post_parent);

    if ($post_type === 'bien') {
        // Construire le chemin du dossier d'upload personnalisé
        $custom_dir = '/bien';

        // Mettre à jour les éléments du tableau $upload
        $upload_dir = wp_upload_dir();
        $custom_path = $upload_dir['basedir'] . $custom_dir . '/' . $attachment->post_parent;
        $custom_url = $upload_dir['baseurl'] . $custom_dir . '/' . $attachment->post_parent;

        wp_update_attachment_metadata($attachment_id, array('file' => $custom_dir . '/' . $attachment->post_parent . '/' . $attachment->post_name));

        update_attached_file($attachment_id, $custom_path . '/' . $attachment->post_name);
    }
}

//add_action('add_attachment', 'custom_upload_dir_for_bien');