<?php

class PublicController{

    private $pubvm;

    public function __construct()
    {
        $this->pubvm = new AdminVoitureModel();
    }

    public function getPubVoitures(){
        
        $cars = $this->pubvm->getVoitures();
        require_once('./views/public/accueil.php');
    }
}