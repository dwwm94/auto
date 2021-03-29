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
                case 'delete_cat':
                    // if(isset($_GET['id']) && $_GET['id'] < 1000 && filter_var($_GET['id'],FILTER_VALIDATE_INT)){
                    //     $id = trim($_GET['id']);
                    //     $this->ctrca->removeCat($id);
                    // }
                    $this->ctrca->removeCat();
                    break;
                case 'edit_cat':
                    $this->ctrca->editCat();
                    break;
                case 'add_cat':
                    $this->ctrca->addCat();
                    break;
            }
        }
    }
}