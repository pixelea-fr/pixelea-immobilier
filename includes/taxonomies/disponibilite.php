<?php
// Classe pour l'enregistrement de la taxonomie "Disponibilité"
class Ng1ImmobilierTaxonomyDisponibilite {

    public function __construct() {
        // Enregistrement de la taxonomie "Disponibilité"
        add_action('init', array($this, 'register_taxonomy'));
    }

    public function register_taxonomy() {
        $labels = array(
            'name'                       => _x('Disponibilités', 'taxonomy general name', 'ng1'),
            'singular_name'              => _x('Disponibilité', 'taxonomy singular name', 'ng1'),
            // Ajoutez d'autres étiquettes selon vos besoins
        );

        $args = array(
            'labels'                     => $labels,
            'public'                     => true,
            'hierarchical'               => true, // Mettre à false si vous souhaitez une taxonomie non hiérarchique (comme les tags)
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'query_var'                  => true,
            'show_in_rest'               => true, // Activer pour l'éditeur de bloc (Gutenberg)
            'publicly_queryable'         => true,
            'rewrite'                    => array('slug' => 'disponibilite'),
            // Ajoutez d'autres paramètres selon vos besoins
        );

        register_taxonomy('disponibilite', array('bien'), $args);

        // Ajout des termes pour la disponibilité
        $this->add_availability_terms();
    }

    private function add_availability_terms() {
        $availability_terms = array('Disponible', 'Sous offre', 'Vendu');

        foreach ($availability_terms as $term) {
            if (!term_exists($term, 'disponibilite')) {
                wp_insert_term($term, 'disponibilite');
            }
        }
    }
}
