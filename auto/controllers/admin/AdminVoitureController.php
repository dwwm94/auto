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

        if(isset($_POST['soumis']) && !empty($_POST['marque']) && !empty($_POST['prix'])){
            $marque = trim(htmlentities(addslashes($_POST['marque'])));
            $modele = trim(htmlentities(addslashes($_POST['modele'])));
            $prix = trim(htmlentities(addslashes($_POST['prix'])));
            $quantite = trim(htmlentities(addslashes($_POST['quantite'])));
            $annee = trim(htmlentities(addslashes($_POST['annee'])));
            $id_cat = trim(htmlentities(addslashes($_POST['cat'])));
            $description = trim(htmlentities(addslashes($_POST['desc'])));
            $image = $_FILES['image']['name'];

            $newV = new Voiture();
            $newV->setMarque($marque);
            $newV->setModele($modele);
            $newV->setPrix($prix);
            $newV->setQuantite($quantite);
            $newV->setAnnee($annee);
            $newV->getCategorie()->setId_cat($id_cat);
            $newV->setDescription($description);
            $newV->setImage($image);

            $destination = './assets/images/';
            move_uploaded_file($_FILES['image']['tmp_name'],$destination.$image);
            $ok = $this->advm->insertVoiture($newV); 
            if($ok){
                header('location:index.php?action=list_v');
            }
        }
        //affichage du formulaire
        $tabCat = $this->adcat->getCategories();
        require_once('./views/admin/voitures/adminAddV.php');
    }
}