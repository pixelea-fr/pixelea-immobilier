<?php 

class ng1BienImmobilierImportPage {
    // Constructeur de la classe
    public function __construct() {
        // Ajoutez les actions et les filtres nécessaires spécifiques à votre plugin
        add_action('admin_menu', array($this, 'admin_page'));
        add_action('admin_init', array($this, 'settings'));
        add_action('wp_ajax_ng1_import_bien_ajax', array($this,'import_bien_ajax')); // Action AJAX
        add_action('wp_ajax_ng1_delete_biens_ajax', array($this,'delete_biens_ajax')); // Action AJAX
        add_action('wp_ajax_ng1_get_progress_data_ajax', array($this,'ng1_get_progress_data_ajax'));
        add_action('wp_ajax_ng1_init_progress_data_ajax', array($this,'ng1_init_progress_data_ajax'));
        add_action('admin_enqueue_scripts', array($this, 'load_styles'), 103);
        
    }

    public function load_styles() {
        $plugin_url = plugins_url('', __FILE__);
        wp_enqueue_style('ng1-bien-immobilier-import',$plugin_url . '/style.css', array(), null, 'all');

    }    
    // Foncction pour ajouter la page d'administration spécifique à votre plugin
    public function admin_page() {
        add_submenu_page(
            'ng1-immobilier-settings',          // Slug de la page parente
            'Import',                      // Titre de l'onglet
            'Import',                      // Texte du menu
            'manage_options',               // Capacité requise pour voir la page
            'ng1-import-general-settings',  // Slug de la sous-page
            array($this,'render_setting_page') // Fonction de rendu de la sous-page
        );
    }

    // Fonction pour afficher la page de configuration spécifique à votre plugin
    public function render_setting_page() {
        ?>
        <div class="wrap">
            <h2>Gestion des biens</h2>
            <?php $path =get_option('ng1_immobilier_import_file_path'); ?>
            <?php if($path): ?>
                <div>Chemin du fichier à importer : <?php echo $path; ?></div>
            <?php endif; ?>

            <div>
                <div class="ng1-import-progress"></div>
            <button type="button" class="button button-primary" id="ng1ImportBien">Importer les biens</button>
            <button type="button" class="button button-primary" id="ng1DeleteBiens">Supprimer les biens</button>
            </div>
        </div>
    
        <!-- Script AJAX pour lancer l'import -->
        <script>
            jQuery(document).ready(function($) {
                $('#ng1ImportBien').on('click', function() {
                    initProgressData();
                    setInterval(updateProgressData, 5000);
                // Appel AJAX pour lancer l'import
                    $.ajax({
                        type: 'POST',
                        url: ajaxurl, // L'URL AJAX de WordPress
                        data: {
                            action: 'ng1_import_bien_ajax', // Action AJAX à traiter dans vos fonctions PHP
                            file_path: '<?php echo $path; ?>',
                            security: '<?php echo wp_create_nonce("ng1_import_bien_ajax_nonce"); ?>', // Sécurité contre les attaques CSRF
                        },
                        success: function(response) {
                            // Réponse de l'import
                            console.log(response);

                            // Parsez la réponse JSON
                            var responseData = JSON.parse(response);

                            // Vérifiez si des données de progression sont présentes
                            if (responseData.percentage !== undefined) {
                                var percentage = responseData.percentage;
                                var currentRow = responseData.current_row;
                                var totalRows = responseData.total_rows;

                                // Mettez à jour la barre de progression
                                $('.ng1-import-progress__progress').css('width', percentage);
                                $('.ng1-import-progress').append('<p>Avancement : ' + percentage + ' (Ligne ' + currentRow + '/' + totalRows + ')</p>');
                            } else if (responseData.status === 'success') {
                            
                                // La dernière ligne indique que l'import est terminé avec succès
                                alert('Import terminé avec succès!');
                            }
                        },
                        error: function(error) {
                            // Gestion des erreurs
                            console.error('Erreur lors de l\'import :', error.responseText);
                        },
                        complete: function() {
                  
                            // La fonction complete sera appelée à la fin de la requête AJAX
                            console.log('Requête AJAX terminée.');
                        }
                    });
                });

                $('#ng1DeleteBiens').on('click', function() {
                
                    // Appel AJAX pour lancer l'import
                    $.ajax({
                        type: 'POST',
                        url: ajaxurl, // L'URL AJAX de WordPress
                        data: {
                            action: 'ng1_delete_biens_ajax', // Action AJAX à traiter dans vos fonctions PHP
                            security: '<?php echo wp_create_nonce("ng1_delete_biens_ajax_nonce"); ?>', // Sécurité contre les attaques CSRF
                        },
                        success: function(response) {
                            // Réponse de l'import
                            alert('Supprimé avec succès!');
                            console.log(response);
                        },
                        error: function(error) {
                            // Gestion des erreurs
                            console.error('Erreur lors de la suppression :', error.responseText);
                        }
                    });
                });
                function initProgressData() {
             
                    $.ajax({
                        type: 'POST',
                        url: ajaxurl, // URL de l'API AJAX de WordPress
                        data: {
                            action: 'ng1_init_progress_data_ajax', // Action AJAX pour récupérer les données
                            security: '<?php echo wp_create_nonce("ng1_init_progress_data_ajax_nonce"); ?>', // Sécurité CSRF
                        },
                        success: function(response) {
                            // Mettre à jour le contenu de la div avec les données de progression récupérées
                            $('.ng1-import-progress').html('');
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                            console.error("Erreur lors de la récupération des données de progression :", error);
                        }
                    });
                }
                function updateProgressData() {
             
                    $.ajax({
                        type: 'POST',
                        url: ajaxurl, // URL de l'API AJAX de WordPress
                        data: {
                            action: 'ng1_get_progress_data_ajax', // Action AJAX pour récupérer les données
                            security: '<?php echo wp_create_nonce("ng1_get_progress_data_ajax_nonce"); ?>', // Sécurité CSRF
                        },
                        success: function(response) {
                            
                            // Mettre à jour le contenu de la div avec les données de progression récupérées
                            $('.ng1-import-progress').html(JSON.stringify(response));
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                            console.error("Erreur lors de la récupération des données de progression :", error);
                        }
                    });
                }
            });
        </script>
        <?php
    }

    // Fonction pour enregistrer les paramètres spécifiques à votre plugin
    public function settings() {
        add_settings_section('ng1_import_section', 'Paramètres ng1 Import', null, 'ng1-import-settings');
        
        // Ajoutez d'autres champs spécifiques à votre plugin au besoin
        //add_settings_field('file_path', 'Chemin du fichier à importer', array($this, 'render_file_path_field'), 'ng1-import-settings', 'ng1_import_section');
        
        // Enregistrez les paramètres spécifiques à votre plugin
        //register_setting('ng1_import_settings', 'file_path');
    }

    // Fonction de rendu du champ de chemin de fichier spécifique à votre plugin
    public function render_file_path_field() {

    }

    // Fonction AJAX pour récupérer le contenu du fichier JSON de progression
    public function ng1_get_progress_data_ajax() {
        // Chemin du fichier JSON de progression
        $progressFilePath = WP_CONTENT_DIR . '/progress_data.json';

        // Vérifier si le fichier existe
        if (file_exists($progressFilePath)) {
            // Lire le contenu du fichier JSON
            $progressData = file_get_contents($progressFilePath);
            // Envoyer le contenu au format JSON
            wp_send_json_success(json_decode($progressData, true));
        } else {
            // Si le fichier n'existe pas, renvoyer une réponse JSON vide
            wp_send_json_success(array());
        }
    }
    public function ng1_init_progress_data_ajax() {
        // Chemin du fichier JSON de progression
        $progressFilePath = WP_CONTENT_DIR . '/progress_data.json';
    
        // Supprimer le contenu du fichier en écrivant une chaîne vide
        file_put_contents($progressFilePath, '');
    
        // Vérifier si le fichier a été correctement vidé
        if (filesize($progressFilePath) === 0) {
            // Envoyer une réponse JSON de succès
            wp_send_json_success(array('success' => true));
        } else {
            // Envoyer une réponse JSON d'erreur si le fichier n'a pas pu être vidé
            wp_send_json_error(array('message' => 'Erreur lors de la suppression du contenu du fichier.'));
        }
    }
    // Fonction de gestion AJAX pour l'import
    public function import_bien_ajax() {
        $ng1_immobilier_import_file_path = get_option('ng1_immobilier_import_file_path');
        check_ajax_referer('ng1_import_bien_ajax_nonce', 'security'); 

        if($ng1_immobilier_import_file_path != ''){
            $tempDir=ng1UnzipFile(  WP_CONTENT_DIR.$ng1_immobilier_import_file_path);
            $fichierAnnonces = $tempDir . '/Annonces.csv';

            // Vérifier si le fichier annonces.csv est présent
            if (file_exists($fichierAnnonces)) {
                $importContext= new ImportContext();
                $importContext->setImportStrategy(new CSVImport());
                $return = $importContext->importFile($fichierAnnonces);
       
                $response = array(
                    'status' => 'success',
                    'message' => $return ,
                );
    
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Aucun fichier Annonces.csv dans le Zip !',
                );
            }

        }else{
            $response = array(
                'status' => 'error',
                'message' => 'Aucun Zip dans le dossier !',
            );
        }
        wp_send_json($response);
    }

    
    public function delete_biens_ajax() {
       check_ajax_referer('ng1_delete_biens_ajax_nonce', 'security');
    
        // Récupérer tous les posts de type 'bien'
        $args = array(
            'post_type' => 'bien',
            'posts_per_page' => -1, // Récupérer tous les posts du type 'bien'
        );
    
        $bien_posts = get_posts($args);
    
        // Supprimer chaque post de type 'bien'
        foreach ($bien_posts as $post) {
            wp_delete_post($post->ID, true); // Le deuxième paramètre à true force la suppression définitive
        }
    
        // Réponse JSON
        $response = array(
            'status' => 'success',
            'message' => 'Tous les posts de type "bien" ont été supprimés avec succès.',
        );
    
        wp_send_json($response);
    }
}