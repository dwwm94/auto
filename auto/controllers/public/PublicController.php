<?php

class PublicController{

    private $pubvm;
    private $pubcm;
    private $pubm;

    public function __construct()
    {
        $this->pubvm = new AdminVoitureModel();
        $this->pubcm = new AdminCategorieModel();
        $this->pubm = new PublicModel();

    }

    public function getPubVoitures(){
        
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = trim(htmlentities(addslashes($_GET['id'])));
            $v = new Voiture();
            $v->getCategorie()->setId_cat($id);
            $tabCat = $this->pubcm->getCategories();
            $voitures = $this->pubm->findCarsByCat($v);
            require_once('./views/public/voituresCat.php');
        }
        $tabCat = $this->pubcm->getCategories();
        $cars = $this->pubvm->getVoitures();
        require_once('./views/public/accueil.php');
    }

}