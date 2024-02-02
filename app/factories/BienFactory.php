<?php
// Classe Factory pour créer des biens immobiliers
class BienFactory {
    public static function createBien($type) {
        switch ($type) {
            case 'appartement':
                return new Appartement();
            case 'maison':
                return new Maison();
            case 'terrain':
                    return new Maison();
            default:
                return new Bien();
        }
    }
}


