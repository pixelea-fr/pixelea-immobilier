<?php 
// Class for registering the custom post type
class Ng1ImmobilierCptBien {

    public function __construct() {
        // Enregistrement du CPT "Bien"
        add_action('init', array($this, 'register_custom_post_type'));
    }

    public function register_custom_post_type() {
        $labels = array(
            'name'               => _x('Biens', 'post type general name', 'textdomain'),
            'singular_name'      => _x('Bien', 'post type singular name', 'textdomain'),
            // Ajoutez d'autres étiquettes selon vos besoins
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'has_archive'        => true,
            'show_in_rest'       => true,
            'rest_base'    => 'biens',
            'taxonomies'         => array('type_de_bien'),
            'rewrite'            => array('slug' => 'bien', 'with_front' => false),
            'supports'           => array('title', 'thumbnail','custom-fields',"editor"),
            // Ajoutez d'autres paramètres selon vos besoins
        );

        register_post_type('bien', $args);
    }
}
