<?php 
add_action('the_post', 'ajouterDonneesAuBien');

function ajouterDonneesAuBien($post) {
    $bien = new Bien($post->ID);

    // Vérifiez si le type de post est "bien"
    if ($post->post_type == 'bien') {
       
        $post->dataImmobilier = json_encode($bien->getFormattedData());
   
    }
    return $post;
}