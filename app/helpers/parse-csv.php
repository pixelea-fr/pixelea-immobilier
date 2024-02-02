<?php
function parseImportLine($line) {
    // Définir le délimiteur utilisé dans la ligne
    $delimiter = '!#';

    // Diviser la ligne en utilisant le délimiteur
    $data = explode($delimiter, $line);

    // Retirer les valeurs vides du tableau résultant
    $data = array_filter($data, function($value) {
        return $value !== '';
    });

    // Réindexer le tableau pour avoir des indices numériques
    $data = array_values($data);

    return $data;
}
function parseImportFileCsv($csvFile) {

    $handle = fopen($csvFile, 'r');
    $data=array();
    if ($handle !== false) {
        while (($line = fgets($handle)) !== false) {
            $parsedData = parseImportLine($line);
            // Faire quelque chose avec les données (par exemple, les afficher)
            $data[] = $parsedData;
        }

        fclose($handle);
    }
    return $data;
}