<?php

class AdminVoitureController{

    private $advm;

    public function __construct()
    {
        $this->advm = new AdminVoitureModel();
    }

    public function listVoitures(){
        $cars = $this->advm->getVoitures();
        require_once('./views/admin/voitures/adminVoituresItems.php');
    }
}