<?php

class Categorie{
    
    private $id_cat;
    private $nom_cat;

    /**
     * Get the value of id_cat
     */ 
    public function getId_cat()
    {
        return $this->id_cat;
    }

    /**
     * Set the value of id_cat
     *
     * @return  self
     */ 
    public function setId_cat($id_cat)
    {
        $this->id_cat = $id_cat;

        return $this;
    }

    /**
     * Get the value of nom_cat
     */ 
    public function getNom_cat()
    {
        return $this->nom_cat;
    }

    /**
     * Set the value of nom_cat
     *
     * @return  self
     */ 
    public function setNom_cat($nom_cat)
    {
        $this->nom_cat = $nom_cat;

        return $this;
    }
}