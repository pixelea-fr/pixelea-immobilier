<?php
// Hook pour intercepter la suppression d'un post (bien)
add_action('before_delete_post', 'delete_images_on_post_delete');

function delete_images_on_post_delete($post_id) {
    // Vérifiez si le post est de type 'bien' (ajustez le type de post selon vos besoins)
    if (get_post_type($post_id) === 'bien') {
        // Obtenez les attachments associés au post
        $attachments = get_posts(array(
            'post_type' => 'attachment',
            'posts_per_page' => -1,
            'post_parent' => $post_id,
            'fields' => 'ids',
        ));

        // Supprimez chaque attachment
        foreach ($attachments as $attachment_id) {
            wp_delete_attachment($attachment_id, true); // true indique de supprimer définitivement le fichier
        }
    }
}