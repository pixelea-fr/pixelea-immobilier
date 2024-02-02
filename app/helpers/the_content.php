<?php

// Fonction pour afficher le contenu du bien
function afficher_contenu_bien($content) {
    // Vérifier si c'est une page de type 'bien_immobilier'
    if (is_single() && get_post_type() === 'bien') {
        // Récupérer l'ID du post actuel
        $postId = get_the_ID();

        // Créer une instance du contrôleur
        $controller = new AfficherBienController();

        // Afficher le bien en utilisant l'ID du post
        ob_start();
        $controller->afficherBien($postId);
        $objetBienContent = ob_get_clean();

        // Ajouter le contenu du bien à la fin du contenu de la page
        $content .= $objetBienContent;
    }

    return $content;
}

// Ajouter la fonction au hook the_content
add_filter('the_content', 'afficher_contenu_bien');