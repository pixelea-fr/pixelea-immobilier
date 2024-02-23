<?php 
include_once(NG1_IMMO_PATH . 'app/admin/page-plugin/admin-page.php');
$ng1BienImmobilierAdminPage = new ng1BienImmobilierAdminPage();
include_once(NG1_IMMO_PATH . 'app/admin/page-import/import-page.php');
$ng1BienImmobilierImportPage = new ng1BienImmobilierImportPage();
//include_once(NG1_IMMO_PATH . 'app/admin/page-import/import-sequentiel.php');
//$ng1BienImmobilierImportPage = new ng1BienImmobilierImportSequencielPage();
include_once(NG1_IMMO_PATH . 'app/admin/list-bien.php');
$ng1AdminListBien = new ng1AdminListBien();
include_once(NG1_IMMO_PATH . 'app/admin/page-template/template-page.php');
$ng1BienImmobilierTemplatePage = new ng1BienImmobilierTemplatePage();