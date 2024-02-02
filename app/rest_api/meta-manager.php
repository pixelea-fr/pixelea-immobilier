<?php
// Vérifiez si la classe existe déjà pour éviter les conflits.
if ( ! class_exists( 'Meta_Manager' ) ) {

    class Meta_Manager {

        // Constructeur
        public function __construct() {
            add_action( 'init', array( $this, 'register_meta' ) );
        }

        // Fonction pour enregistrer la méta-donnée
        public function register_meta() {
            register_post_meta( 'post', 'price', array(
                'show_in_rest' => true,
                'single' => true,
                'type' => 'number', // Définissez le type selon vos besoins, ici 'number' pour un prix.
                'sanitize_callback' => 'absint', // Optionnel : callback pour la validation/sanitisation
                'auth_callback' => function() { 
                    return current_user_can( 'edit_posts' ); 
                } // Optionnel : callback pour la gestion des permissions
            ));
        }
    }

}

// Création d'une instance de la classe
new Meta_Manager();

add_action('rest_api_init', function () {
    register_rest_field('bien', '011_prix', array(
        'get_callback' => function ($object) {
            // Récupère la méta-donnée. Assurez-vous que 'price' est une méta-donnée valide enregistrée pour 'mon_cpt'.
            return 'test';
        },
        'schema' => array(
            'description' => 'Prix du produit',
            'type'        => 'number',
            'context'     => array('view', 'edit')
        )
    ));
});