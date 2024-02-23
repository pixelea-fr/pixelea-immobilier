<?php
// Classe de l'implémentation de la maison
class Terrain extends BienImmobilierBase{
    protected $type = 'terrain';
    public function getType() {
        return "Terrain";
    }
}