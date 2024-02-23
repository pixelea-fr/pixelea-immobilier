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
                'taxonomies'         => array('type_de_bien', 'ville','etat'),
                'rewrite'            => array('slug' => 'bien', 'with_front' => false),
                'supports'           => array('title', 'thumbnail','custom-fields',"editor"),
                // Ajoutez d'autres paramètres selon vos besoins
            );

            register_post_type('bien', $args);
        }
    }
        



function ajouter_meta_box_bien() {
    add_meta_box(
        'meta-box-bien', // ID de la méta-boîte
        'Informations sur le bien', // Titre de la méta-boîte
        'afficher_meta_box_bien', // Callback pour afficher le contenu de la méta-boîte
        'bien', // Type de publication où ajouter la méta-boîte
        'normal', // Contexte de la méta-boîte (normal, side, advanced)
        'default' // Priorité de la méta-boîte (high, core, default, low)
    );
}
add_action( 'add_meta_boxes', 'ajouter_meta_box_bien' );

// Afficher le contenu de la méta-boîte
function afficher_meta_box_bien( $post ) {
    // Récupérer toutes les balises meta pour le bien
    $meta_data = get_post_meta( $post->ID );

    // Afficher les balises meta dans la méta-boîte

    echo '<ul>';
    foreach ( $meta_data as $meta_key => $meta_value ):
        if(!empty($meta_value)):
        // Ignorer les clés de méta-données internes de WordPress commençant par un souligné
            if ( substr( $meta_key, 0, 1 ) !== '_' ):
                ?>
                <style>
                    .meta-box-bien {
                        display: grid;
                       grid-template-columns: repeat(2, 1fr);
                        margin-bottom: 10px;
                    }
                    .meta-box-bien__key {
                        padding-right: 2em;
                        text-align: right;
                        font-weight: bold;
                    }
                    .meta-box-bien__value {
                        
                    }
                </style>
                
                <div class="meta-box-bien">
                    <div class="meta-box-bien__key"><?php echo esc_html( $meta_key ); ?></div>
                    <div class="meta-box-bien__value"><?php echo esc_html( implode( ', ', $meta_value ) ) ?></div>
                </div>
                <?php
            endif;
        endif;
    endforeach;
    echo '</ul>';
}

