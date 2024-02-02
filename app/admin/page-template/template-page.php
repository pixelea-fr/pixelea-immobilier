<?php

class ng1BienImmobilierTemplatePage {
    private $ng1UseCardTmpl;
    private $ng1CardTmpl;
    private $ng1UseBienTmpl;
    private $ng1BienTmpl;
    // Constructeur de la classe
    public function __construct() {
        // Ajoutez les actions et les filtres nécessaires spécifiques à votre plugin
        add_action('admin_menu', array($this, 'add_plugin_page'));
        add_action('admin_init', array($this, 'page_init'));
        add_action('admin_enqueue_scripts', array($this, 'load_styles'), 103);
        add_action('admin_enqueue_scripts', array($this, 'load_scripts'), 103);
        
    }

    public function load_styles() {
        $plugin_url = plugins_url('', __FILE__);
        wp_enqueue_style('ng1-bien-immobilier-admin-template',$plugin_url . '/style.css', array(), null, 'all');

    }    
    public function load_scripts() {
        $plugin_url = plugins_url('', __FILE__);
        wp_enqueue_script('ng1-bien-immobilier-functions', $plugin_url . '/assets/js/function.js', array('jquery'), null, true);
    }

 
    public function add_plugin_page() {
    
        add_submenu_page(
            'ng1-immobilier-settings',          // Slug de la page parente
            'Template',                // Titre de l'onglet
            'Templates',                // Texte du menu
            'manage_options',               // Capacité requise pour voir la page
            'ng1-template-page',            // Slug de la sous-page
            array($this, 'create_admin_page') // Fonction de rendu de la sous-page
        );
    }

    // Fonction pour afficher la page de configuration spécifique à votre plugin
    public function create_admin_page() {

        ?>
        <div class="wrap ng1-immobilier-template">
        <h2 class="nav-tab-wrapper">
                <a class="nav-tab nav-tab-active" href="#tab0">Accueil</a>
                <a class="nav-tab" href="#tab1">Templates</a>
                <a class="nav-tab" href="#tab2">Manuel</a>
                <a class="nav-tab" href="#tab3">Filtres disponibles</a>
                <a class="nav-tab" href="#tab4">Shortcodes</a>
                <!-- Add more tabs as needed -->
            </h2>
            <div id="tab0" class="tab-content">
           
            </div>
            <div id="tab1" class="tab-content" style="display:none;">
                <?php include_once('part/form.php'); ?>
            </div>
            <div id="tab2" class="tab-content" style="display:none;">
                <?php include_once('part/manuel.php');?>
            </div>
            <div id="tab3" class="tab-content" style="display:none;">
                <?php include_once('part/filters.php');?>
            </div>
            <div id="tab4" class="tab-content" style="display:none;">
                <?php include_once('part/shortcodes.php');?>
            </div>
        </div>

        <?php
    }
// Fonction pour afficher la section card
public function card_section() {
    $this->ng1UseCardTmpl = get_option('ng1UseCardTmpl', 0);
    $this->ng1CardTmpl = get_option('ng1CardTmpl', '');

    ?>
   <section>
    <div>
        <label for="ng1UseCardTmpl">Replace Template</label>
        <input type="checkbox" id="ng1UseCardTmpl" name="ng1UseCardTmpl" <?php checked($this->ng1UseCardTmpl, 1); ?> value="1">
        </div>
 
        <?php
            $editor_id = 'ng1CardTmpl';
            wp_editor($this->ng1CardTmpl, $editor_id, array(
                'textarea_name' => 'ng1CardTmpl',
                'wpautop' => false,
                'media_buttons' => false,
                'textarea_rows' => 15,
                'teeny' =>true, // This disables TinyMCE
                'quicktags' => true, // Remove view as HTML button.
            ));
        ?>
    </section>
    <?php
}

// Fonction pour afficher la section single
public function single_section() {
    $this->ng1UseBienTmpl = get_option('ng1UseBienTmpl', 0);
    $this->ng1BienTmpl = get_option('ng1BienTmpl', '');

    ?>
    <section>
    <div>
        <label for="ng1UseBienTmpl">Replace Template</label>
        <input type="checkbox" id="ng1UseBienTmpl" name="ng1UseBienTmpl" <?php checked($this->ng1UseBienTmpl, 1); ?> value="1">
        </div>
   
        <?php
            $editor_id = 'ng1BienTmpl';
            wp_editor($this->ng1BienTmpl, $editor_id, array(
                'textarea_name' => 'ng1BienTmpl',
                'wpautop' => false,
                'media_buttons' => false,
                'textarea_rows' => 15,
                'teeny' =>true, // This disables TinyMCE
                'quicktags' => true, // Remove view as HTML button.
            ));
        ?>
    </section>
    <?php
}
    public function page_init() {

        register_setting('ng1-template-settings', 'ng1UseCardTmpl', array( $this, 'sanitize' ));
        register_setting('ng1-template-settings', 'ng1CardTmpl', array( $this, 'sanitize' ));
        register_setting('ng1-template-settings', 'ng1UseBienTmpl', array( $this, 'sanitize' ));
        register_setting('ng1-template-settings', 'ng1BienTmpl', array( $this, 'sanitize' ));

        add_settings_section('ng1_card_section', 'Template pour les cartes', array($this, 'card_section'), 'ng1-template-settings');
        add_settings_section('ng1_single_section', 'Template pour un bien', array($this, 'single_section'), 'ng1-template-settings');
    }

    public function save_template_options() {
        // Enregistrez les options dans la base de données
        update_option('ng1UseCardTmpl', isset($_POST['ng1UseCardTmpl']) ? 1 : 0);
        update_option('ng1CardTmpl', sanitize_text_field($_POST['ng1CardTmpl']));
        update_option('ng1UseBienTmpl', isset($_POST['ng1UseBienTmpl']) ? 1 : 0);
        update_option('ng1BienTmpl', sanitize_text_field($_POST['ng1BienTmpl']));

        // Mettez à jour les variables privées
        $this->ng1UseCardTmpl = get_option('ng1UseCardTmpl', 0);
        $this->ng1CardTmpl = get_option('ng1CardTmpl', '');
        $this->ng1UseBienTmpl = get_option('ng1UseBienTmpl', 0);
        $this->ng1BienTmpl = get_option('ng1BienTmpl', '');

        // Redirigez l'utilisateur après la sauvegarde
        $redirect_url = menu_page_url('ng1-template-page', false);

        wp_redirect($redirect_url);

        exit();
    }
    


}
