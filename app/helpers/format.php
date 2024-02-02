<?php
/**
 * Classe Ng1ImmoFormat pour formater les données immobilières.
 */
class Ng1ImmoFormat {

    /**
     * Formate le prix donné avec deux décimales et un séparateur de milliers.
     *
     * @param float $price Le prix à formater.
     * @return string Le prix formaté avec le symbole de la devise.
     */
    public static function formatPrice($price) {
        // Vérifiez si $price est un nombre
        if (!is_numeric($price)) {
            // Si ce n'est pas un nombre, vous pouvez choisir de renvoyer une valeur par défaut ou de générer une erreur
            // Dans cet exemple, renvoyons une chaîne vide
            return '';
        }

        // Utilisez la fonction number_format pour formater le prix avec deux décimales et un séparateur de milliers
        $formatted_price = number_format($price, 0, '.', ' ');

        // Ajoutez le symbole de la devise ou tout autre format que vous souhaitez
        $formatted_price = $formatted_price.' €';

        return $formatted_price;
    }
    public static function formatDescription($text) {
        // Vérifiez si $price est un nombre
        if (!is_string($text)) {
            return $text;
        }

        // Ajoute un espace après chaque point ou virgule s'il n'y en a pas déjà un
        $text = preg_replace('/([.,])([^\s])/', '$1 $2', $text);
    
        // Remplace "m2" par "mètres carrés"
        $text = str_replace('m2', 'm²', $text);
    
        return $text;
    }

    /**
     * Formate une chaîne de caractères en utilisant le tiret bas comme séparateur de mots.
     *
     * @param string $str La chaîne de caractères d'entrée à formater.
     * @return string La chaîne de caractères formatée.
     */
    public static function formatToUnderscore($str) {
        // Vérifiez si c'est un string
        if (!is_string($str)) {
            return $str;
        }

        $formattedStr = preg_replace_callback('/_?([A-Z])/', function($matches) {
            return '_' . strtolower($matches[1]);
        }, $str);
    
        // Supprime le premier underscore s'il existe (pour éviter un underscore au début de la chaîne)
       return $formattedStr = ltrim($formattedStr, '_');
    }
    /**
     * Formate une chaîne de caractères en camel case.
     *
     * @param string $str La chaîne de caractères à formater.
     * @return string La chaîne de caractères formatée en camel case.
     */
    public static function formatToCamelCase($str) {
        // Vérifiez si c'est un string
        if (!is_string($str)) {
            return $str;
        }
        $formattedStr = ucwords(str_replace('_', ' ', $str));
        $formattedStr = str_replace(' ', '', $formattedStr);
    
        return $formattedStr;
    }
    /**
     * Retourne le nom d'une variable à partir du nom d'une méthode.
     *
     * @param mixed $method Le nom de méthode à convertir.
     * @return string La variable convertie.
     */
    public static function getVariableNameFromMethod($method) {
        // Vérifiez si c'est un string
        if (!is_string($method)) {
            return $method;
        }
        return lcFirst(str_replace(array('(',')','get'),array('','',''), $method));
        
    }
    public static function getPropertyFromMethod($method) {
        // Vérifiez si c'est un string
        if (!is_string($method)) {
            return $method;
        }
        return  Ng1ImmoFormat::formatToUnderscore(Ng1ImmoFormat::getVariableNameFromMethod($method));
       
    }
    public static function getPropertyNameFromMetadata($metadataKey) {
        // Vérifiez si c'est un string
        if (!is_string($metadataKey)) {
            return $metadataKey;
        }
        $prefix = substr($metadataKey, 0, 3);
        $propertyKey =  Ng1ImmoFormat::formatToUnderscore(lcfirst(substr($metadataKey, 3)));

        return $propertyKey;
    }
    public static function formatShortcodeIdentifer($shortcodeName) {
        return str_replace(array("_shorcode", "_"),array("","-"), $shortcodeName);
    }
    /**
     * Génère le nom de la méthode get à partir d'un nom de propriété donné.
     *
     * @param string $property Le nom de la propriété.
     * @throws Exception Si le nom de la propriété n'est pas valide.
     * @return string Le nom de la méthode généré.
     */
    public static function getMethodFromProperty($property) {
         return "get".Ng1ImmoFormat::formatToCamelCase($property);
    }
    /**
     * Met à jour les clés d'un tableau associatif en utilisant une méthode spécifique.
     * Il transformr les clés reprensentant des propriétés en clés repreésentant les methodes get associées
     * exemple : 'price' => 'getPrice'
     *
     * @param array $tableau Le tableau d'origine avec les clés à mettre à jour.
     * @throws Some_Exception_Class Exception levée si une certaine condition est remplie.
     * @return array Le tableau mis à jour avec les clés mises à jour en utilisant la méthode spécifiée.
     */
    public static function updateTableKeyPropertyToKeyMethod($tableau) {
        $nouveauTableau = array();
    
        foreach ($tableau as $cle => $valeur) {
            // Vérifier si une clé de changement est définie pour la clé actuelle
            $nouvelleCle =Ng1ImmoFormat::getMethodFromProperty($cle);
    
            // Ajouter l'élément avec la nouvelle clé dans le nouveau tableau
            $nouveauTableau[$nouvelleCle] = $valeur;
        }
    
        return $nouveauTableau;
    }
    /**
     * retourne un tableau propriété => methodes get associées
     * exemple : 'price' => 'getPrice'
     *
     * @param array $tableau Le tableau d'origine avec les clés à mettre à jour.
     * @throws Some_Exception_Class Exception levée si une certaine condition est remplie.
     * @return array Le tableau property / methode.
     */
    public static function getPropertyMethodArray($tableau) {
        $nouveauTableau = array();
    
        foreach ($tableau as $cle => $valeur) {
            // Vérifier si une clé de changement est définie pour la clé actuelle
            $nouvelleCle =Ng1ImmoFormat::getMethodFromProperty($cle);
    
            // Ajouter l'élément avec la nouvelle clé dans le nouveau tableau
            $nouveauTableau[$cle] = $nouvelleCle;
        }
    
        return $nouveauTableau;
    }
    /**
     * Transforme les commentaires PHPDoc en tableau associatif avec une clé 'description'.
     *
     * @param string $doc_comment Commentaire PHPDoc à analyser.
     * @return array Tableau associatif représentant les données du PHPDoc.
     */

        public static function parsePhpDocToArray($doc_comment) {
            $doc_lines = explode("\n", $doc_comment);
        
            $phpdoc_data = array();
            $paragraphs = array();
        
            foreach ($doc_lines as $line) {
                $line = trim($line, " \t\n\r\0\x0B*/");
        
                if (empty($line)) {
                    continue;  // Ignore les lignes vides.
                }
        
                // Vérifie si la ligne commence par une balise PHPDoc.
                if (strpos($line, '@') === 0) {
                    // Divise la ligne en parties basées sur l'espace.
                    $parts = preg_split('/\s+/', $line, -1, PREG_SPLIT_NO_EMPTY);
                    $tag = array_shift($parts);
                    $phpdoc_data[$tag] = implode(' ', $parts);
                } else {
                    // La ligne n'est pas une balise PHPDoc, donc c'est une description.
                    $paragraphs[] = $line;
                }
            }
        
            // Ajoute les paragraphes au tableau, s'il y en a.
            if (!empty($paragraphs)) {
                $phpdoc_data['description'] = implode("\n\n", $paragraphs);
            }
        
            return $phpdoc_data;
        
    }

}