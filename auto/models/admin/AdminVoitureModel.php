<?php

class AdminVoitureModel extends Driver{

    public function getVoitures($search = null){

        if(!empty($search)){
            $sql = "SELECT * 
                    FROM voiture v
                    INNER JOIN categorie c
                    ON v.id_cat = c.id_cat
                    WHERE marque LIKE :marque OR modele LIKE :modele OR nom_cat LIKE :nom_cat
                    ORDER BY id_v DESC";
            $searchParams = ["marque"=>"$search%", "modele"=>"$search%", "nom_cat"=>"$search%"];
            $result = $this->getRequest($sql, $searchParams);
            //$voitures = $result->fetchAll(PDO::FETCH_OBJ);

        }else{
            $sql = "SELECT * 
                    FROM voiture v
                    INNER JOIN categorie c
                    ON v.id_cat = c.id_cat
                    ORDER BY id_v DESC";
            $result = $this->getRequest($sql);
        }
       
        $voitures = $result->fetchAll(PDO::FETCH_OBJ);

        $datas = [];
        //$cat = new Categorie();

        foreach ($voitures as $voiture) {

            $v = new Voiture();
            $v->setId_v($voiture->id_v);
            $v->setMarque($voiture->marque);
            $v->setModele($voiture->modele);
            $v->setPrix($voiture->prix);
            $v->setImage($voiture->image);
            $v->setQuantite($voiture->quantite);
            $v->setAnnee($voiture->annee);
            $v->setDescription($voiture->description);
            $v->getCategorie()->setId_cat($voiture->id_cat);
            $v->getCategorie()->setNom_cat($voiture->nom_cat);
            array_push($datas, $v);

        }
        if($result->rowCount() > 0){
            return $datas;
        }else{
            return "No record ...";
        }
    }

    public function insertVoiture(Voiture $voiture){

        $sql = "INSERT INTO voiture(marque, modele, prix, annee, quantite, image, description, id_cat)
                VALUES(:marque, :modele, :prix, :annee, :quantite, :image, :descr, :id_cat)";
        
        $tabParams = ["marque"=>$voiture->getMarque(),"modele"=>$voiture->getModele(), "prix"=>$voiture->getPrix(), "annee"=>$voiture->getAnnee(), "quantite"=>$voiture->getQuantite(), "image"=>$voiture->getImage(), "descr"=>$voiture->getDescription(), "id_cat"=>$voiture->getCategorie()->getId_cat()]; 

        $result= $this->getRequest($sql, $tabParams);
        
        return $result;
    }

    public function deleteVoiture(Voiture $voiture){

        $sql = "DELETE FROM voiture WHERE id_v = :id";
        $result = $this->getRequest($sql, ['id'=>$voiture->getId_v()]);
        
        return $result->rowCount();
    }
}