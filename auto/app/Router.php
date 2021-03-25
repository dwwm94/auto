<?php

require_once('./models/Driver.php');
require_once('./models/Categorie.php');
require_once('./models/admin/AdminCategorieModel.php');
require_once('./controllers/admin/AdminCategorieController.php');

class Router{
    private $ctrca;

    public function __construct()
    {
        $this->ctrca = new AdminCategorieController();
    }

    public function getPath(){

        if(isset($_GET['action'])){

            switch($_GET['action']){
                case 'list_cat':
                    $this->ctrca->listCategories();
                    break;

            }
        }
    }
}