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
            if( isset($_POST['soumis']) && !empty($_POST['search'])){
                $search = trim(htmlspecialchars(addslashes($_POST['search'])));
                $tabCat = $this->pubcm->getCategories();
                $cars = $this->pubvm->getVoitures($search);
                require_once('./views/public/accueil.php');
            }
            $id = trim(htmlentities(addslashes($_GET['id'])));
            $v = new Voiture();
            $v->getCategorie()->setId_cat($id);
            $tabCat = $this->pubcm->getCategories();
            $voitures = $this->pubm->findCarsByCat($v);
            require_once('./views/public/voituresCat.php');
      
        }else{
            if( isset($_POST['soumis']) && !empty($_POST['search'])){
                $search = trim(htmlspecialchars(addslashes($_POST['search'])));
                $tabCat = $this->pubcm->getCategories();
                $cars = $this->pubvm->getVoitures($search);
                require_once('./views/public/accueil.php');
            }
            $tabCat = $this->pubcm->getCategories();
            $cars = $this->pubvm->getVoitures();

        require_once('./views/public/accueil.php');
        }
    }

    public function recap(){

        if(isset($_POST['envoi']) && !empty($_POST['marque']) && !empty($_POST['prix'])){
            $marque = htmlspecialchars(addslashes($_POST['marque']));
            $modele = htmlspecialchars(addslashes($_POST['modele']));
            $image = htmlspecialchars(addslashes($_POST['image']));
            $prix = htmlspecialchars(addslashes($_POST['prix']));

            require_once('./views/public/voitureItem.php');
        }
    }
    public function orderCar(){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = addslashes(htmlspecialchars($_GET['id']));
            require_once('./views/public/orderForm.php');
        }
    }

}