<?php function ng1_get_post_by_title($post_title, $post_type = 'bien'){
{
    $args = array(
        'post_type'   => $post_type,
        'numberposts' => 1,  // Récupérer au plus 1 post
        'post_status' => 'any',  // Inclure les posts de tous les statuts
        'title'       => $post_title,
    );

    $existing_posts = get_posts($args);

    if ($existing_posts) {
        return $existing_posts[0];  // Retourner le premier post trouvé
    } else {
        return null;
    }
}
}