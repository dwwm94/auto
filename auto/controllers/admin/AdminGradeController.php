<?php

class AdminGradeController{

    private $adG;
    
    public function __construct()
    {
        $this->adG = new AdminGradeModel();
    }

    public function listGrades(){
        AuthController::isLogged();
         $allGrades = $this->adG->getGrades();
         require_once('./views/admin/grades/adminGradesItems.php');
    }

    public function removeGrade(){
        AuthController::isLogged();
        AuthController::accessUser();
        if(isset($_GET['id'])  && filter_var($_GET['id'],FILTER_VALIDATE_INT)){

            $id = trim($_GET['id']);

            $nbLine = $this->adG->deleteGrade($id);

            if($nbLine > 0){
                header('location: index.php?action=list_g');
            }
        }
    }
}