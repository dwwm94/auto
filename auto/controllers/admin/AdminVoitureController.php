<?php

class AdminVoitureController{

    private $advm;

    public function __construct()
    {
        $this->advm = new AdminVoitureModel();
        $this->adcat = new AdminCategorieModel();
    }

    public function listVoitures(){
        //var_dump($_POST);
        if(isset($_POST['soumis']) && !empty($_POST['search'])){
            $search = trim(htmlspecialchars(addslashes($_POST['search'])));
            $cars = $this->advm->getVoitures($search);
            require_once('./views/admin/voitures/adminVoituresItems.php');
  
        }else{
            $cars = $this->advm->getVoitures();
            require_once('./views/admin/voitures/adminVoituresItems.php');
        }
        
    }

    public function addVoitures(){
        $tabCat = $this->adcat->getCategories();
        require_once('./views/admin/voitures/adminAddV.php');
    }
}