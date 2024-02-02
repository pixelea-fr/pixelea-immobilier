<?php
// Classe de l'implémentation de l'appartement
class Appartement extends BienImmobilierBase {
    protected $type = 'appartement';
    public function getType() {
        return "Appartement";
    }
}