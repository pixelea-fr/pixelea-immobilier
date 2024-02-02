<?php 

class ng1BienImmobilierAdminPage {
    // Constructeur de la classe
    public function __construct() {
        // Ajoutez les actions et les filtres nécessaires spécifiques à votre plugin
        add_action('admin_menu', array($this, 'admin_page'));
        add_action('admin_init', array($this, 'settings'));
    }

    // Fonction pour ajouter la page d'administration spécifique à votre plugin
    public function admin_page() {
        add_menu_page(
            'Pixelea Immobilier',  // Titre de la page
            'Immobilier',     // Texte du menu
            'manage_options',            // Capacité requise pour voir la page
            'ng1-immobilier-settings',       // Slug de la page
            array($this, 'render_setting_page'), // Fonction de rendu de la page
            'dashicons-building'    // Icône du menu
        );
    }

    // Fonction pour afficher la page de configuration spécifique à votre plugin
    public function render_setting_page() {
        ?>
        <div class="wrap">
            <h2>Configuration des imports</h2>

            <form method="post" action="options.php">
                <?php
                    settings_fields('ng1_import_settings');
                    do_settings_sections('ng1-import-settings');
                    submit_button('Enregistrer les paramètres');
                ?>
            </form>
        </div>
        <?php
    }

    // Fonction pour enregistrer les paramètres spécifiques à votre plugin
    public function settings() {
        add_settings_section('ng1_import_section', 'Paramètres ng1 Import', null, 'ng1-import-settings');
        
        // Ajoutez d'autres champs spécifiques à votre plugin au besoin
        add_settings_field('ng1_immobilier_import_file_path', 'Chemin du fichier à importer', array($this, 'render_file_path_field'), 'ng1-import-settings', 'ng1_import_section');
        
        // Enregistrez les paramètres spécifiques à votre plugin
        register_setting('ng1_import_settings', 'ng1_immobilier_import_file_path');
    }

    // Fonction de rendu du champ de chemin de fichier spécifique à votre plugin
    public function render_file_path_field() {
        $file_path = get_option('ng1_immobilier_import_file_path');
        ?>
        <input type="text" name="ng1_immobilier_import_file_path" value="<?php echo esc_attr($file_path); ?>" />
        <p class="description">Entrez le chemin depuis wp-content ( commence par un / )</p>
        <?php
    }
}