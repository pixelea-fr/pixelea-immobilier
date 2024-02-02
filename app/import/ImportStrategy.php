<?php
// Interface de la stratégie d'import
interface ImportStrategy {
    public function import($file);
}