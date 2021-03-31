<?php

class AdminUtilisateurModel extends Driver{

    public function getUsers(){
        $sql ="SELECT * FROM utilisateurs u
            INNER JOIN grade g
            ON u.id_g = g.id_g
            ORDER BY u.id DESC";

        $result = $this->getRequest($sql);

        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        $tabUser = [];

        foreach($rows as $row){
            $user = new Utilisateurs();
            $user->setId($row->id);
            $user->setNom($row->nom);
            $user->setPrenom($row->prenom);
            $user->setLogin($row->login);
            $user->setPass($row->pass);
            $user->getGrade()->setId_g($row->id_g);
            $user->getGrade()->setNom_g($row->nom_g);
            $user->setEmail($row->email);
            $user->setStatut($row->statut);
            array_push($tabUser,$user);
        }
            return $tabUser;
    }

    public function updateStatut(Utilisateurs $user){

        $sql = "UPDATE utilisateurs SET statut=:statut WHERE id=:id";
        $result = $this->getRequest($sql, ['statut'=>$user->getStatut(), 'id'=>$user->getId()]);

        return $result->rowCount();
        
    }

    public function signIn($loginEmail, $pass){

        $sql = "SELECT * FROM utilisateurs 
                WHERE (login = :logEmail OR email =:logEmail ) AND pass = :pass";
        $result = $this->getRequest($sql, ['logEmail'=>$loginEmail, 'pass'=>$pass]);

        $row = $result->fetch(PDO::FETCH_OBJ);

        return $row;
    }
}