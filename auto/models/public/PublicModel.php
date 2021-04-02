<?php

class PublicModel extends Driver{

    public function findCarsByCat(Voiture $car){

        $sql = "SELECT * FROM voiture v
        INNER JOIN categorie c
        ON v.id_cat = c.id_cat
         WHERE v.id_cat=:id";
        $result = $this->getRequest($sql, ["id"=>$car->getCategorie()->getId_cat()]);

        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        $cars = [];
        foreach($rows as $row){

            $newCar = new Voiture();

            $newCar->setId_v($row->id_v);
            $newCar->setMarque($row->marque);
            $newCar->setModele($row->modele);
            $newCar->setPrix($row->prix);
            $newCar->setAnnee($row->annee);
            $newCar->setQuantite($row->quantite);
            $newCar->setImage($row->image);
            $newCar->setDescription($row->description);
            $newCar->getCategorie()->setId_cat($row->id_cat);
            $newCar->getCategorie()->setNom_cat($row->nom_cat);

            array_push($cars, $newCar);

        }
        return $cars;
    }
}