<?php
// Classe de l'implémentation de la maison
class Maison extends BienImmobilierBase {
    protected $type = 'maison';
    public function getType() {
        return "Maison";
    }
}