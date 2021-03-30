<?php


class AdminUtilisateurController{

    private $adUser;

    public function __construct()
    {
        $this->adUser = new AdminUtilisateurModel();
    }

    public function listUsers(){
        $allUsers = $this->adUser->getUsers();
        require_once('./views/admin/utilisateurs/adminUsersItems.php');

    }
}