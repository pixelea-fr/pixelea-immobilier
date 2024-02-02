<?php
class Ng1BienRewriteRules {

    public function __construct() {
        add_action('init', array($this, 'rewrite_rules'));
        add_action('init', array($this, 'rewrite_tags'));
        add_action('query_vars', array($this, 'add_custom_query_vars'));
        add_action('init', array($this, 'flush_rewrite_rules'));  // Ajout de la fonction de rafraîchissement
        add_filter('post_type_link', array($this, 'post_type_link'), 10, 2);
        add_action('template_redirect', array($this,'display_query_vars'));
    }

    public function rewrite_rules() {
        global $wp_rewrite;
        // Remplacez 'type_de_bien' et 'ville' par les noms de vos taxonomies
        $wp_rewrite->add_rule('^(bien)\/([^&]+)\/([^&]+)\/(.?.+?)?(:/([0-9]+))?/?$','index.php?post_type=$matches[1]&ville=$matches[3]&type_de_bien=$matches[2]&name=$matches[4]','top');
        $wp_rewrite->add_rule('^(bien)\/([^&]+)\/([^&]+)','index.php?post_type=$matches[1]&ville=$matches[3]&type_de_bien=$matches[2]','top');
        $wp_rewrite->add_rule('^(bien)\/([^&]+)','index.php?post_type=$matches[1]&type_de_bien=$matches[2]','top');
        $wp_rewrite->flush_rules();
    }

    public function rewrite_tags() {
        add_rewrite_tag('%type_de_bien%', '([^&]+)');
        add_rewrite_tag('%ville%', '([^&]+)');
    }

    public function add_custom_query_vars($vars) {
        $vars[] = 'type_de_bien';
        $vars[] = 'ville';
        return $vars;
    }
    public function flush_rewrite_rules() {
        flush_rewrite_rules();
    }
    public function pixelea_id($item){
        return str_replace(" ", "-", strtolower($item));
    }
       
    public function post_type_link($permalink, $post) {
        // Obtenez les termes de la taxonomie 'ville'.
        $terms_ville = wp_get_post_terms($post->ID, 'ville');
        // Obtenez les termes de la taxonomie 'type_de_bien'.
        $terms_type = wp_get_post_terms($post->ID, 'type_de_bien');
    
        // Assurez-vous qu'il y a au moins un terme pour chaque taxonomie.
        if (!empty($terms_ville) && !empty($terms_type)) {
            $custom_link_ville = $terms_ville[0]->slug;
            $custom_link_type = $terms_type[0]->slug;
    
            // Choisissez le format d'URL souhaité /biens/ville/type/ID
            $url = "bien/{$custom_link_type}/{$custom_link_ville}/{$post->post_name}";
    
            // Retournez l'URL complète.
            return home_url($url);
        }
    
        // S'il n'y a pas de termes, retournez le permalink d'origine.
        return $permalink;
    }

    function display_query_vars() {
        if (is_admin()) {
            return;
        }
    
        global $wp_query;
    ob_start()
    ?>
     
        <div id="toggle_debug" class="query-vars__debug__toggle"  style="cursor:pointer; font-size: 8px; padding: 2px 5px; color:white; background: black; border-radius: 5px; display: inline-block">Query_vars</div>
        <div class="query-vars__debug" style="display:none">
        <pre > <?php print_r($wp_query->query_vars); ?></pre>
        </div>
        <script>document.addEventListener('DOMContentLoaded', function () {
    var toggleDebug = document.getElementById('toggle_debug');
    if (toggleDebug) {
        toggleDebug.addEventListener('click', function () {

            toggleDebug.remove();
            var debugElement = document.querySelector('.query-vars__debug');
            if (debugElement) {
                debugElement.style.display = 'block';
            }
        });
    }
});

        </script>
      <?php
    }
    

}
