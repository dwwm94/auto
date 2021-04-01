<?php


class AdminUtilisateurController{

    private $adUser;
    private $adG;

    public function __construct()
    {
        $this->adUser = new AdminUtilisateurModel();
        $this->adG = new AdminGradeModel();
    }

    public function listUsers(){
        AuthController::isLogged();
        if(isset($_GET['id']) && isset($_GET['statut']) && !empty($_GET['id'])){
            $id = $_GET['id'];
            $statut = $_GET['statut'];
            $user = new Utilisateurs();
            if($statut==1){
                $statut = 0;
            }else{
                $statut = 1;
            }
            $user->setId($id);
            $user->setStatut($statut);

            $this->adUser->updateStatut($user);
        }
        $allUsers = $this->adUser->getUsers();
        require_once('./views/admin/utilisateurs/adminUsersItems.php');

    }

    public function login(){

        if(isset($_POST['soumis'])){
            if(strlen($_POST['pass']) >= 4 && !empty($_POST['loginEmail'])){
                $loginEmail = trim(htmlentities(addslashes($_POST['loginEmail'])));
                $pass = md5(trim(htmlentities(addslashes($_POST['pass']))));
                $data_u = $this->adUser->signIn($loginEmail,  $pass);
               if(!empty($data_u)){
                    if($data_u->statut > 0){
                        session_start();
                        $_SESSION['Auth'] =  $data_u;
                        header('location:index.php?action=list_v');
                    }else{
                        $error = "Votre compte a été supprimé";
                    }
                }else{
                    $error = "Votre login/email ou/et mot de passe ne correspondent pas";
                }
            }else{
                $error = "Entrée les données valides";
            }
        }
        
        require_once('./views/admin/utilisateurs/login.php');
    }

    public function addUser(){
        if(isset($_POST['soumis'])){
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && strlen($_POST['pass']) >= 4){
                $nom = trim(htmlentities(addslashes($_POST['nom'])));
                $prenom = trim(htmlentities(addslashes($_POST['prenom'])));
                $email = trim(htmlentities(addslashes($_POST['email'])));
                $pass = md5(trim(htmlentities(addslashes($_POST['pass']))));
                $id_g = trim(htmlentities(addslashes($_POST['grade'])));
                $login = trim(htmlentities(addslashes($_POST['login'])));
                
                $newUser = new Utilisateurs();
                $newUser->setNom($nom);
                $newUser->setPrenom($prenom);
                $newUser->setEmail($email);
                $newUser->setPass($pass);
                $newUser->setLogin($login);
                $newUser->setStatut(1);
                $newUser->getGrade()->setId_g($id_g);

                $ok = $this->adUser->register($newUser);
                if($ok){
                    header('location:index.php?action=login');
                }
            }
        }
        $allGrades = $this->adG->getGrades();
        require_once('./views/admin/utilisateurs/register.php');
    }
   
}