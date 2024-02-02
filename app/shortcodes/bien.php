<?php
function ng1_immo_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'view' => 'default',
    ), $atts );
switch ($atts['view']) {
    case 'card':
        ob_start();
        $controller = new AfficherBienController();
        $controller->afficherCard( get_the_ID() );
        return ob_get_clean();
        break;
    case 'card.html':
        ob_start();
        $controller = new AfficherBienController();
        $controller->afficherCardHtml( get_the_ID());
        return ob_get_clean();
        break;
    case 'bien':
        ob_start();
        $controller = new AfficherBienController();
        $controller->afficherBien( get_the_ID() );
        return ob_get_clean();
        break;
    case 'archive':
            ob_start();
            $controller = new AfficherBienController();
            $controller->afficherArchive();
            return ob_get_clean();
            break;
    case 'debug':
            ob_start();
            $controller = new AfficherBienController();
            $controller->afficherDebug( get_the_ID() );
            return ob_get_clean();
            break;
    case 'id':
        return get_the_ID();
        break;
    default:
        return 'Aucune vue : '. $atts['view'].' n\'existe.';
        break;

}
}

add_shortcode( 'ng1-immo', 'ng1_immo_shortcode' );