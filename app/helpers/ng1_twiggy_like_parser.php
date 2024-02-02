<?php 
class Ng1TwiggyLikeParser
{
    /**
     * Analyse une chaîne en utilisant une syntaxe proche de Twig.
     * exemple : {thumbnail|render_image|small} blahblah {prix|format_price}
     *
     * @param string $string La chaîne à analyser.
     * @return array Un tableau contenant les parties analysées.
     */
    public function parseString($string)
    {
        $result = [];
        $pattern = '/\{([^}]+)\}|([^{}]+)/';

        preg_match_all($pattern, $string, $matches);

        foreach ($matches[0] as $match) {
            if (strpos($match, '{') === 0) {
                // Si la chaîne commence par '{', c'est une partie entre accolades
                $parts = explode('|', trim($match, '{}'));
                $result[] = $parts;
            } else {
                // Sinon, c'est une partie en dehors des accolades
                $result[] = $match;
            }
        }

        return $result;
    }
    /**
     * Interprète une chaîne Twiggy et applique des filtres en fonction de l'objet donné.
     *
     * @param string $string La chaîne Twiggy à interpréter.
     * @param object $object L'objet sur lequel appliquer les filtres.
     * @return string Le résultat filtré de l'interprétation de la chaîne Twiggy.
     */
    public function interpretTwiggyLikeString($string, $object) {
        $className = get_class($object);
        $twigLikeParser = new Ng1TwiggyLikeParser();
        $parsedParts = $twigLikeParser->parseString($string);


        $filteredResult = '';

        foreach ($parsedParts as $part) {
            if (is_array($part) && count($part) > 0) {
                // Si la partie est un tableau, appliquer apply_filters
                $filterName = $part[0]; // Le premier élément est le nom du filtre

                $filter_callback = apply_filters('ng1_twig_like_'. strtolower($className).'_get_method_'.$filterName, $object,  $filterName );
                $part[0] = $filter_callback;
                if($filterName != 'post_id'){
                    echo $filterName;
                     }
                if (count($part) > 1) {
                    // reordonner les arguments popur que le filtre puisse fonctionner
                    // déplacment du callback en 2nd position
                    $tmp = $part[0];
                    $part[0] = $part[1];
                    $part[1] = $tmp;
                    // Appliquer le filtre avec les arguments
                    $filteredResult .= call_user_func_array('apply_filters', $part);
                } else {
                    // si il n'y a pas de filtre a appliquer
                    $filteredResult .= $part[0];
                }

            } else {
                // Sinon, c'est une partie non modifiée
                $filteredResult .= $part;
            }
        }

        return $filteredResult;

    }

}

