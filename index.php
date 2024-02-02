<?php
/**
 * Plugin Name: Ng1 Immobilier
 * Description: Plugin de gestion imobilière
 * Version: 1.0
 * Author: Nicolas GEHIN
 */
define('NG1_IMMO_PATH', plugin_dir_path(__FILE__));

include_once(NG1_IMMO_PATH . 'app/helpers/format.php');
include_once(NG1_IMMO_PATH . 'app/helpers/images.php');
include_once(NG1_IMMO_PATH . 'app/helpers/get_post.php');
include_once(NG1_IMMO_PATH . 'app/helpers/shortcodes.php');
include_once(NG1_IMMO_PATH . 'app/helpers/ng1_twiggy_like_parser.php');

include_once(NG1_IMMO_PATH . 'app/helpers/parse-csv.php');
include_once(NG1_IMMO_PATH . 'app/helpers/unzip.php');
include_once(NG1_IMMO_PATH . 'app/helpers/auto-delete-bien-on-delete.php');


include_once(NG1_IMMO_PATH . 'includes/cpt/bien.php');
include_once(NG1_IMMO_PATH . 'includes/cpt_add_data/bien.php');
include_once(NG1_IMMO_PATH . 'includes/taxonomies/type_de_bien.php');
include_once(NG1_IMMO_PATH . 'includes/taxonomies/ville.php');
include_once(NG1_IMMO_PATH . 'includes/rewrite_rules/bien.php');

// Instanciation des classes
new Ng1ImmobilierCptBien();
new Ng1ImmobilierTaxonomyTypeDeBien();
new Ng1ImmobilierTaxonomyVille();
new Ng1BienRewriteRules();

//FILTERS

include_once(NG1_IMMO_PATH . 'app/filters/renderData.php');
include_once(NG1_IMMO_PATH . 'app/filters/filterManager.php');
$filter_manager = Ng1ImmobilierFilterManager::get_instance();

include_once(NG1_IMMO_PATH . 'app/shortcodes/shortcodesManager.php');
$shortcode_manager = Ng1ImmobilierShortcodeManager::get_instance();

// ADMIN PAGES
include_once(NG1_IMMO_PATH . 'app/admin/index.php');


// immobilier-plugin.php
include_once(NG1_IMMO_PATH . 'app/models/BienImmobilier.php');
include_once(NG1_IMMO_PATH . 'app/factories/BienFactory.php');
include_once(NG1_IMMO_PATH . 'app/models/Bien.php');
include_once(NG1_IMMO_PATH . 'app/models/Appartement.php');
include_once(NG1_IMMO_PATH . 'app/models/Maison.php');

include_once(NG1_IMMO_PATH . 'app/controllers/AfficherBien.php');

//include_once(NG1_IMMO_PATH . 'includes/rest_api/meta-manager.php');
include_once(NG1_IMMO_PATH . 'app/rest_api/registerMeta.php');
//new Meta_Manager();
// // Exemple d'utilisation de la factory
// $appartement = BienFactory::createBien('appartement');
// echo $appartement->getDescription(); // Affiche "Appartement"
// 
// $maison = BienFactory::createBien('maison');
// echo $maison->getDescription(); // Affiche "Maison"
// 
// $autreBien = BienFactory::createBien('autre');
// echo $autreBien->getDescription(); // Affiche "Bien générique"

//IMPORT
include_once(NG1_IMMO_PATH . 'app/import/ImportStrategy.php');
include_once(NG1_IMMO_PATH . 'app/import/CSVImport.php');
include_once(NG1_IMMO_PATH . 'app/import/XMLImport.php');
include_once(NG1_IMMO_PATH . 'app/import/JSONImport.php');
include_once(NG1_IMMO_PATH . 'app/import/ImportContext.php');



//AFFICHAGE
//include_once(NG1_IMMO_PATH . 'app/helpers/the_content.php');

include_once(NG1_IMMO_PATH . 'app/shortcodes/bien.php');


//exemple utilisation$importContext = new ImportContext();

// / Pour un fichier CSV
// importContext->setImportStrategy(new CSVImport());
// importContext->importFile('chemin/vers/fichier.csv');
// / Pour un fichier XML
// importContext->setImportStrategy(new XMLImport());
// importContext->importFile('chemin/vers/fichier.xml');
// / Pour un fichier JSON
// importContext->setImportStrategy(new JSONImport());
// importContext->importFile('chemin/vers/fichier.json');