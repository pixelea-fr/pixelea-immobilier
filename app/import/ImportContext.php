<?php 
class ImportContext {
    private $importStrategy;

    public function setImportStrategy(ImportStrategy $strategy) {
        $this->importStrategy = $strategy;
    }

    public function importFile($file) {
        $this->importStrategy->import($file);
    }
}
