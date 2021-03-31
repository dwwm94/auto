<?php


class AdminUtilisateurController{

    private $adUser;

    public function __construct()
    {
        $this->adUser = new AdminUtilisateurModel();
    }

    public function listUsers(){
        
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
   
}