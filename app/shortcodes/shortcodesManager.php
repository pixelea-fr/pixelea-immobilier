<?php
/**
 * Classe Singleton pour la gestion des shortcodes d'affichage.
 */
class Ng1ImmobilierShortcodeManager {

    private static $instance = null;
    private $shortcodeDocs = array();

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        // Ajoutez ici les shortcodes nécessaires avec leurs commentaires PHPDoc.
        $this->add_shortcode_with_doc('ng1_immo_shortcode');
        $this->add_shortcode_with_doc('ng1_immo_data_shortcode');
  
    }

    private function add_shortcode_with_doc($shortcode_name) {
        // Récupère la réflexion de la méthode de rendu.
        $method = new ReflectionMethod($this,  $shortcode_name);
        $shortcode_id =$this->formatShortcodeIdentifer($shortcode_name);
        // Récupère les commentaires PHPDoc associés à la méthode.
        $doc_comment = $method->getDocComment();

        // Ajoute le shortcode avec son commentaire PHPDoc.
        add_shortcode($shortcode_id, array($this,  $shortcode_name));

        // Ajoute le commentaire PHPDoc au tableau de stockage.
        $this->add_shortcode_doc($shortcode_id , $doc_comment);
    }
    private function formatShortcodeIdentifer($shortcodeName) {
        return str_replace(array("_shortcode", "_"),array("","-"), $shortcodeName);
    }
    /**
     * Affiche la vue correspondante 
     * 
     *
     * @param array $atts Attributs du shortcode.
     * @return string Résultat du rendu du shortcode.
     */
    public function ng1_immo_shortcode($atts) {
        $atts = shortcode_atts(array(
            'view' => 'default',
            'data' => 'default',
        ), $atts);
 
            switch ($atts['view']) {
                case 'card':
                    ob_start();
                    $controller = new AfficherBienController();
                    $controller->afficherCard(get_the_ID());
                    return ob_get_clean();
                    break;
                case 'card.html':
                    ob_start();
                    $controller = new AfficherBienController();
                    $controller->afficherCardHtml(get_the_ID());
                    return ob_get_clean();
                    break;
                case 'bien':
                    ob_start();
                    $controller = new AfficherBienController();
                    $controller->afficherBien(get_the_ID());
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
                    $controller->afficherDebug(get_the_ID());
                    return ob_get_clean();
                    break;
                case 'id':
                    return get_the_ID();
                    break;
                default:
                  //  return 'Aucune vue : ' . $atts['view'] . ' n\'existe.';
                    break;
            }
   
    }
    /**
     * Affiche la donnée correspondante 
     *  
     * [ng1-immo-data data="prix"] affichera $bien->getPrix();
     *
     * @param array $atts Attributs du shortcode.
     * @return string Résultat du rendu du shortcode.
     */
    public function ng1_immo_data_shortcode($atts) {
        $atts = shortcode_atts(array(
            'data' => 'default',
        ), $atts);
    
        if(isset($atts['data']) && !empty($atts['data']) && $atts['data'] != 'default'){
            $bien = new Bien(get_the_ID());
            if($atts['data'] != ''){
                $method =Ng1ImmoFormat::getMethodFromProperty($atts['data']);
                return $bien->$method();
            }
        }
   
    }
    /**
     * Méthode pour récupérer les commentaires PHPDoc des shortcodes.
     *
     * @return array Tableau des commentaires PHPDoc des shortcodes.
     */
    public function get_docs() {
        return $this->shortcodeDocs;
    }

    /**
     * Ajoute les commentaires PHPDoc associés à un shortcode.
     *
     * @param string $shortcode_name Nom du shortcode.
     * @param string $doc Commentaire PHPDoc du shortcode.
     */
    public function add_shortcode_doc($shortcode_id, $doc) {
        
        $view =array('card', 'bien', 'archive', 'debug');
        if($shortcode_id =="ng1-immo"){
            foreach($view as $value){
                $this->shortcodeDocs["[".$shortcode_id." view='".$value."']"] = $doc." -> ".$value;
            }
         
        }else{
            $this->shortcodeDocs["[".$shortcode_id."]"] = $doc;
        }
    }
}
