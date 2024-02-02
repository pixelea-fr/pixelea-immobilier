<?php

/**
 * Classe Singleton pour la gestion des filtres d'affichage.
 */
class Ng1ImmobilierFilterManager {

    private static $instance = null;
    private $filterDocs = array();
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    /**
     * Constructeur privé pour éviter l'instanciation directe.
     */
    private function __construct() {
        // Ajoutez ici les filtres nécessaires avec leurs commentaires PHPDoc.
        $this->add_filter_with_doc('render_image',3);
        $this->add_filter_with_doc('render_slides');
    }

    /**
     * Ajoute un filtre avec son commentaire PHPDoc associé.
     *
     * @param string $filter_name Le nom du filtre.
     * @param int $nb_args Le nombre d'arguments pour le filtre (par défaut : 1).
     * @throws ReflectionException Si la création de ReflectionMethod échoue.
     * @note Attention, le filtre creer doit avoir des valeur par defaut pour ses arguments
     * @return void
     */
    private function add_filter_with_doc($filter_name,$nb_args = 1) {
        // Récupère la réflexion de la méthode de rendu.
        $method = new ReflectionMethod($this, $filter_name);

        // Récupère les commentaires PHPDoc associés à la méthode.
        $doc_comment = $method->getDocComment();

        // Ajoute le filtre avec son commentaire PHPDoc.
        add_filter($filter_name, array($this, $filter_name), 10, $nb_args);

        // Ajoute le commentaire PHPDoc au tableau de stockage.
        $this->add_filter_doc($filter_name, $doc_comment);
    }
    /**
     * A partir d'un ID d'image
     * affiche l'image correspondantes
     *
     * @param int $value ID de l'image.
     *
     */
    public function render_image($value,$size="medium",$class="img-twig") {?>
 
    <?php
        if(is_array($value)){
            $value=$value[0];
        }
        // Ajoutez ici le code de rendu pour 'render_image'.
        echo wp_get_attachment_image($value, $size,false,array('class'=>$class));
        return;
    }

    /**
     * A partir d'ids d'images au format '1,2,3', 
     * affiche les images correspondantes
     *
     * @param string $value Chaîne d'ID d'images séparées par des virgules.
     */
    public function render_slides($value) {
        if (!is_string($value)) {
            $images=$value;
        }else{
            $images = explode(',', $value);
        }
        // Ajoutez ici le code de rendu pour 'render_slides'.
   
        foreach ($images as $img_id){
            echo wp_get_attachment_image($img_id, 'medium');
        }
        return;
    }

    /**
     * Méthode pour récupérer les commentaires PHPDoc des filtres.
     *
     * @return array Tableau des commentaires PHPDoc des filtres.
     */
    public function get_docs() {

        return $this->filterDocs;
    }

    /**
     * Ajoute les commentaires PHPDoc associés à un filtre.
     *
     * @param string $filter_name Nom du filtre.
     * @param string $doc Commentaire PHPDoc du filtre.
     */
    public function add_filter_doc($filter_name, $doc) {
        $this->filterDocs[$filter_name] = $doc;
    }
}