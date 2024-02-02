<?php
// Classe de l'implémentation du bien
class Bien extends BienImmobilierBase {
    private $type = 'autres';

    public function getType() {
        return "autres";
    }

}