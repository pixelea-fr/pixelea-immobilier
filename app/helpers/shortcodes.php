<?php
// function bien_shortcode($atts) {
//     // Paramètres par défaut
//     $atts = shortcode_atts(
//         array(
//             'data' => 'prix', // Métadonnée par défaut à afficher
//         ),
//         $atts,
//         'bien'
//     );

//     // Récupérer l'ID du post actuel
//     $post_id = get_the_ID();

//     // Vérifier si le post est de type "bien"
//     if (get_post_type($post_id) === 'bien') {
//         // Récupérer la métadonnée spécifiée
//         $meta_value = get_post_meta($post_id, $atts['data'], true);

//         // Si la métadonnée n'est pas vide, l'afficher
//         if (!empty($meta_value)) {
//             return esc_html($meta_value);
//         } else {
//             return 'Aucune métadonnée trouvée pour "' . esc_html($atts['data']) . '".';
//         }
//     } else {
//         return 'Ce shortcode ne peut être utilisé que sur des posts de type "bien".';
//     }
// }
// add_shortcode('bien', 'bien_shortcode');