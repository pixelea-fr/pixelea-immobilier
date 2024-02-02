<?php 
class Ng1ImmobilierTaxonomyVille {

    public function __construct() {
        // Enregistrement de la taxonomie "Ville"
        add_action('init', array($this, 'register_taxonomy'));
    }

    public function register_taxonomy() {
        $labels = array(
            'name'                       => _x('Villes', 'taxonomy general name', 'textdomain'),
            'singular_name'              => _x('Ville', 'taxonomy singular name', 'textdomain'),
            // Ajoutez d'autres étiquettes selon vos besoins
        );

        $args = array(
            'labels'                     => $labels,
            'public'                     => true,
            'hierarchical'               => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'query_var'                  => true,
            'rewrite'                    => array('slug' => 'ville'),
            // Ajoutez d'autres paramètres selon vos besoins
        );

        register_taxonomy('ville', array('bien'), $args);
    }
}

