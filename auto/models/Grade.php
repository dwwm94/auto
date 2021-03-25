<?php

class Grade{

    private $id_g;
    private $nom_g;
    

    /**
     * Get the value of id_g
     */ 
    public function getId_g()
    {
        return $this->id_g;
    }

    /**
     * Set the value of id_g
     *
     * @return  self
     */ 
    public function setId_g($id_g)
    {
        $this->id_g = $id_g;

        return $this;
    }

    /**
     * Get the value of nom_g
     */ 
    public function getNom_g()
    {
        return $this->nom_g;
    }

    /**
     * Set the value of nom_g
     *
     * @return  self
     */ 
    public function setNom_g($nom_g)
    {
        $this->nom_g = $nom_g;

        return $this;
    }
}