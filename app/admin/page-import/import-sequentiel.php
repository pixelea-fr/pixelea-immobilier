<?php 

class ng1BienImmobilierImportSequencielPage {
    // Constructeur de la classe
    public function __construct() {
        // Ajoutez les actions et les filtres nécessaires spécifiques à votre plugin
        add_action('admin_menu', array($this, 'admin_page'));
        add_action('admin_init', array($this, 'settings'));
        add_action('wp_ajax_ng1_import_bien_sequenciel_ajax', array($this,'import_bien_sequenciel_ajax')); // Action AJAX
        add_action('admin_enqueue_scripts', array($this, 'load_styles'), 103);
        
    }

    public function load_styles() {
        $plugin_url = plugins_url('', __FILE__);
        wp_enqueue_style('ng1-bien-immobilier-import',$plugin_url . '/style.css', array(), null, 'all');

    }    
    // Foncction pour ajouter la page d'administration spécifique à votre plugin
    public function admin_page() {
        add_submenu_page(
            'ng1-immobilier-settings',                  // Slug de la page parente
            'Import Sequenciel',                        // Titre de l'onglet
            'Import Sequenciel',                        // Texte du menu
            'manage_options',                           // Capacité requise pour voir la page
            'ng1-import-sequenciel-general-settings',   // Slug de la sous-page
            array($this,'render_setting_page')          // Fonction de rendu de la sous-page
        );
    }

    // Fonction pour afficher la page de configuration spécifique à votre plugin
    public function render_setting_page() {
        ?>
        <div class="wrap">
            <h2>Import sequenciel des biens</h2>
            <?php $path =get_option('ng1_immobilier_import_file_path'); ?>
            <?php if($path): ?>
                <div>Chemin du fichier à importer : <?php echo $path; ?></div>
            <?php endif; ?>
            <div>
                <div class="ng1-import-progress"></div>
            <button type="button" class="button button-primary" id="ng1ImportBien">Importer les biens</button>
            </div>
        </div>
    
        <!-- Script AJAX pour lancer l'import -->
        <script>
            jQuery(document).ready(function($) {
                $('#ng1ImportBien').on('click', function() {
                // Appel AJAX pour lancer l'import
                    $.ajax({
                        type: 'POST',
                        url: ajaxurl, // L'URL AJAX de WordPress
                        data: {
                            action: 'ng1_import_bien_sequenciel_ajax', // Action AJAX à traiter dans vos fonctions PHP
                            file_path: '<?php echo $path; ?>',
                            security: '<?php echo wp_create_nonce("ng1_import_bien_sequenciel_ajax_nonce"); ?>', // Sécurité contre les attaques CSRF
                        },
                        success: function(response) {
                            var responseData = JSON.parse(response);
                            if (responseData.status === 'success') {
                                if (responseData.percentage !== undefined) {
                                    var percentage = responseData.percentage;
                                    var currentRow = responseData.current_row;
                                    var totalRows = responseData.total_rows;
                                    $('.ng1-import-progress__progress').css('width', percentage);
                                    $('.ng1-import-progress').append('<p>Avancement : ' + percentage + ' (Ligne ' + currentRow + '/' + totalRows + ')</p>');
                                } else {
                                    alert('Import terminé avec succès!');
                                }
                            } else {
                                console.error('Erreur lors de l\'import :', responseData.message);
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

            });
        </script>
        <?php
    }

    // Fonction pour enregistrer les paramètres spécifiques à votre plugin
    public function settings() {
        add_settings_section('ng1_import_section', 'Paramètres ng1 Import', null, 'ng1-import-settings');
    }

    // Fonction de gestion AJAX pour l'import
    public function import_bien_sequenciel_ajax() {
        $ng1_immobilier_import_file_path = get_option('ng1_immobilier_import_file_path');
        check_ajax_referer('ng1_import_bien_sequenciel_ajax_nonce', 'security'); 

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


}