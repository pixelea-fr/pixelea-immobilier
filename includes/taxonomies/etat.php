<?php
// Class for registering the taxonomy
class Ng1ImmobilierTaxonomyEtat {

    public function __construct() {
        // Enregistrement de la taxonomie "État du bien"
        add_action('init', array($this, 'register_taxonomy'));

    }

    public function register_taxonomy() {
        $labels = array(
            'name'                       => _x('États du bien', 'taxonomy general name', 'ng1'),
            'singular_name'              => _x('État du bien', 'taxonomy singular name', 'ng1'),
            // Ajoutez d'autres étiquettes selon vos besoins
        );

        $args = array(
            'labels'                     => $labels,
            'public'                     => true,
            'hierarchical'               => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'query_var'                  => true,
            'show_in_rest'               => true,
            'publicly_queryable'         => true,
            'rewrite'                    => array('slug' => 'etat'),
            // Ajoutez d'autres paramètres selon vos besoins
        );

        register_taxonomy('etat', array('bien'), $args);

        // Ajout des termes pour l'état du bien
        $this->add_estate_terms();
    }

    private function add_estate_terms() {
        $estate_terms = array('Neuf', 'Récent', 'Rénové');

        foreach ($estate_terms as $term) {
            if (!term_exists($term, 'etat')) {
                wp_insert_term($term, 'etat');
            }
        }
    }
}