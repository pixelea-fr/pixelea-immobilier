<?php
add_action('rest_api_init', function () {
    register_rest_field('bien', '011_prix', array(
        'get_callback' => function ($object) {
            // Récupère la méta-donnée. Assurez-vous que 'price' est une méta-donnée valide enregistrée pour 'mon_cpt'.
            return get_post_meta($object['id'], '011_prix', true);
        },
        'schema' => array(
            'description' => 'Prix du produit',
            'type'        => 'number',
            'context'     => array('view', 'edit')
        )
    ));
});