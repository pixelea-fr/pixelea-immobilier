<?php
function ng1UnzipFile($zipFilePath) {
    // Vérifie si le fichier ZIP existe
    if (!file_exists($zipFilePath)) {
        return false;
    }

    // Crée un dossier temporaire au même niveau que le fichier ZIP
    $tempDir = dirname($zipFilePath) . '/tmp' . uniqid();
    mkdir($tempDir);

    // Initialise la classe ZipArchive
    $zip = new ZipArchive();

    // Ouvre le fichier ZIP
    if ($zip->open($zipFilePath) === true) {
        // Extrait le contenu du fichier ZIP dans le dossier temporaire
        $zip->extractTo($tempDir);

        // Ferme le fichier ZIP
        $zip->close();

        // Retourne le chemin du dossier temporaire
        return $tempDir;
    } else {
        // En cas d'erreur lors de l'ouverture du fichier ZIP
        return false;
    }
}