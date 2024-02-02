<?php
// Class for registering the taxonomy
class Ng1ImmobilierTaxonomyTypeDeBien {

    public function __construct() {
        // Enregistrement de la taxonomie "Type de bien"
        add_action('init', array($this, 'register_taxonomy'));

    }

    public function register_taxonomy() {
        $labels = array(
            'name'                       => _x('Types de bien', 'taxonomy general name', 'textdomain'),
            'singular_name'              => _x('Type de bien', 'taxonomy singular name', 'textdomain'),
            // Ajoutez d'autres étiquettes selon vos besoins
        );

        $args = array(
            'labels'                     => $labels,
            'public'                     => true,
            'hierarchical'               => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'query_var'                  => true,
            'rewrite'                    => array('slug' => 'type-de-bien'),
            // Ajoutez d'autres paramètres selon vos besoins
        );

        register_taxonomy('type_de_bien', array('bien'), $args);

        // Ajout des termes par défaut
        $this->add_default_terms();
    }

    private function add_default_terms() {
        $default_terms = array('Maison', 'Appartement', 'Terrain','immeuble');

        foreach ($default_terms as $term) {
            if (!term_exists($term, 'type_de_bien')) {
                wp_insert_term($term, 'type_de_bien');
            }
        }
    }
}