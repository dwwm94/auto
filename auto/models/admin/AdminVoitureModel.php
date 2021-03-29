<?php

class AdminVoitureModel extends Driver{

    public function getVoitures(){

        $sql = "SELECT * 
                FROM voiture v
                INNER JOIN categorie c
                ON v.id_cat = c.id_cat
                ORDER BY id_v DESC";
        $result = $this->getRequest($sql);
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
        return $datas;
    }
}