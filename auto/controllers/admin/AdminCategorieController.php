<?php
// require_once('../../models/Driver.php');
// require_once('../../models/Categorie.php');
// require_once('../../models/admin/AdminCategorieModel.php');

class AdminCategorieController{

    private $adCat;
    public function __construct()
    {
        $this->adCat = new AdminCategorieModel();
    }

    public function listCategories(){
         $allCat = $this->adCat->getCategories();
         require_once('./views/admin/adminCategoriesItems.php');
         //return $allCat;
    }
}
// $adminCat = new AdminCategorieController();
// var_dump($adminCat->listCategories()) ;