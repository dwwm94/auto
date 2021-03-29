<?php
// require_once('../Categorie.php');
//require_once('../Driver.php');
class AdminCategorieModel extends Driver{

    public function getCategories(){

        $sql = "SELECT * FROM categorie";

        $result = $this->getRequest($sql);

        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        //orm
        $tabCat = [];

        foreach ($rows as $row) {
            $cat = new Categorie();
            $cat->setId_cat($row->id_cat);
            $cat->setNom_cat($row->nom_cat);
            array_push($tabCat, $cat);
        }
        return $tabCat;
    }

    public function deleteCat($id){
        $sql  = "DELETE FROM categorie WHERE id_cat = :id";
        $result = $this->getRequest($sql, ['id'=>$id]);
        $nb = $result->rowCount();
        return $nb;
    }

    public function categorieItem($id){

        $sql = "SELECT * FROM categorie WHERE id_cat = :id";
        $result = $this->getRequest($sql, ['id'=>$id]);
        if($result->rowCount() >0){

            $row = $result->fetch(PDO::FETCH_OBJ);

            $cat = new Categorie();
            $cat->setId_cat($row->id_cat);
            $cat->setNom_cat($row->nom_cat);

            return $cat;
        } 

    }

    public function updateCategorie(Categorie $cat){
        $sql = "UPDATE categorie 
                SET nom_cat = :nom
                WHERE id_cat = :id";
        $result = $this->getRequest($sql,['nom'=>$cat->getNom_cat(),'id'=>$cat->getId_cat()]);

        if($result->rowCount() > 0){
            $nb = $result->rowCount();
            return $nb;
        }
    }

    public function insertCategorie(Categorie $cat){

        $sql = "INSERT INTO categorie(nom_cat)
                VALUES(:nom)";
        $result = $this->getRequest($sql, array('nom'=>$cat->getNom_cat()));

        return $result;
    }
}

//$adminCat = new AdminCategorieModel();
//var_dump($adminCat->getCategories()) ;