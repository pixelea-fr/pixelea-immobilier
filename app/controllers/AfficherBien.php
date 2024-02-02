<?php 
class AfficherBienController {
    public function __construct() {
        $this->addFilterToTwiggyLikeBienMethod();
    }

    /**
     * Affiche la card d'un bien pour un ID de post donné.
     * si le fichier bien.php existe dans le dossier immobilier du thème actif
     * c'est ce fichier qui sera utiliser pour l'affichage sinon ce dera celui 
     * de la vue du plugin
     * 
     * @param int $postId L'ID du post.
     * @throws Some_Exception_Class Description de l'exception.
     * @return void
     */
    public function afficherCard($postId) {

        $bien= new Bien($postId);
 
        // Vérifier si le fichier card.php existe dans le dossier ng1-immo/view du thème actif
        $theme_directory = get_stylesheet_directory();
        ob_start();
        $view_path = $theme_directory . '/immobilier/card.php';
        if ( file_exists( $view_path ) ) {
            include_once $view_path;
        } else {
            include_once NG1_IMMO_PATH . 'app/view/card.php';
        }

        $out =ob_get_clean();
      
       echo $this->remplacerMethodes($out, $bien);
       $nouveau_tableau =array();
       unset($bien);
    }
    public function afficherCardHtml($postId) {
        $bien= new Bien($postId);
        $nouveau_tableau = $bien->getFormattedData();
        // Vérifier si le fichier card.php existe dans le dossier ng1-immo/view du thème actif
        $theme_directory = get_stylesheet_directory();

        $use_admin_card_tmpl = get_option("ng1UseCardTmpl");
        $admin_card_tmpl = get_option("ng1CardTmpl");
        if($use_admin_card_tmpl && !empty($admin_card_tmpl)){
            $html = $admin_card_tmpl;
        }else{
       
 
        $view_path = $theme_directory . '/immobilier/card.html';
        if ( file_exists( $view_path ) ) {
            $html = file_get_contents($view_path);
        } else {
            $html = file_get_contents(NG1_IMMO_PATH . 'app/view/card.html');
        }
    }
       echo $this->remplacerMethodes($html, $bien);
       $nouveau_tableau =array();
       unset($bien);
    }
    /**
     * Affiche le detail d'un bien.
     * si le fichier bien.php existe dans le dossier immobilier du thème actif
     * c'est ce fichier qui sera utiliser pour l'affichage sinon ce dera celui 
     * de la vue du plugin
     *
     * @param int $postId L'ID de la propriété à afficher.
     * @throws Exception Si les métadonnées de la propriété ne peuvent pas être récupérées.
     * @return void
     */
    public function afficherBien($postId) {

        $bien= new Bien();
        // Vérifier si le fichier bien.php existe dans le dossier immobilier du thème actif
        $theme_directory = get_stylesheet_directory();
    
        $view_path = $theme_directory . '/immobilier/debug.php';
        if ( file_exists( $view_path ) ) {
            include_once $view_path;
        } else {
            include_once NG1_IMMO_PATH . 'app/view/debug.php';
        }

    }
    public function afficherArchive() {
        global $wp_query;
        $query =new WP_Query($wp_query->query);
        ?>
        <div class="ng1-immo-archive">
            <div class="ng1-immo-archive__items">
            <?php
            while (  $query->have_posts() ):
                $query->the_post();
                $post=get_post();
                $bien= new Bien($post->ID);
                ?>
                <?php //var_dump($post->dataImmobilier) ?>
                
                <a class="ng1-immo-archive__item" href="<?php the_permalink(); ?>">   
                <?php $this->afficherCardHtml(get_the_ID()); ?>
                </a>
                <?php
            endwhile;
             wp_reset_query();
            ?>
            </div>
        </div>
        <?php
            
    }
    
   /**
    * Affiche les informations de débogage d'un bien pour un ID de post donné.
    * si le fichier debug.php existe dans le dossier immobilier du thème actif
    * c'est ce fichier qui sera utiliser pour l'affichage sinon ce dera celui 
    * de la vue du plugin
    *
    * @param int $postId L'ID de l'article pour lequel afficher les informations de débogage.
    * @throws Some_Exception_Class Une description de l'exception qui peut être lancée.
    * @return void
    */
    public function afficherDebug($postId) {
        $bien= new Bien($postId);
        // Vérifier si le fichier card.php existe dans le dossier ng1-immo/view du thème actif
        $theme_directory = get_stylesheet_directory();
        ob_start();
        $view_path = $theme_directory . '/immobilier/debug.php';
        if ( file_exists( $view_path ) ) {
            include_once $view_path;
        } else {
            include_once NG1_IMMO_PATH . 'app/view/debug.php';
        }
    }

    /**
     * Met à jour les méthodes Twig-like de l'objet Bien en utilisant le filtre de Ng1TwigLikeParser
     *
     * @return array Un tableau contenant les méthodes mises à jour.
     */
    public function addFilterToTwiggyLikeBienMethod() {
        try {
            $bien = new Bien();
            $propertiesObject = $bien->getVariables();
            if (!is_array($propertiesObject)) {
                throw new Exception('La méthode getVariables() n\'a pas renvoyé un tableau.');
            }
    
            $propertiesObject = Ng1ImmoFormat::getPropertyMethodArray($propertiesObject);
            if (!is_array($propertiesObject)) {
                throw new Exception('La méthode getPropertyMethodArray() n\'a pas renvoyé un tableau.');
            }
    
            foreach ($propertiesObject as $property => $method) {
                if (!is_string($property) || !is_string($method)) {
                    throw new Exception('Les valeurs de propriété ou de méthode ne sont pas des chaînes de caractères valides.');
                }
    
                if (!method_exists($bien, $method)) {
                    throw new Exception('La méthode ' . $method . ' n\'existe pas dans la classe Bien.');
                }
    
                add_filter('ng1_twig_like_bien_get_method_' . $property, function($bien) use ($method)  {
                    if (!is_callable([$bien, $method])) {
                        throw new Exception('La méthode ' . $method . ' n\'est pas appelable dans la classe Bien.');
                    }
    
                    return $bien->$method();
                }, 10, 2);
            } 
        } catch (Exception $e) {
            // Gérez l'erreur ici, par exemple, en enregistrant le message d'erreur dans un journal.
            // Vous pouvez également choisir de lancer une exception personnalisée ou de retourner un message d'erreur.
            error_log('Erreur lors de l\'ajout des filtres TwiggyLikeBienMethod : ' . $e->getMessage());
        }
    }
    
    
    /**
     * Remplace les méthodes dans le HTML avec la valeur fournie $bien.
     *
     * @param string $html La chaîne HTML à modifier.
     * @param mixed $bien La valeur à remplacer dans les méthodes.
     * @throws Exception Si une erreur se produit lors du remplacement de méthode.
     * @return string La chaîne HTML modifiée.
     */
    public function remplacerMethodes($html, $bien) {
        $twigLikeParser = new Ng1TwiggyLikeParser();
        return $twigLikeParser->interpretTwiggyLikeString($html, $bien);
    }
        
}

