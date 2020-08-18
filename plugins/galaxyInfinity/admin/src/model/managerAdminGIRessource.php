<?php

namespace App\plugins\galaxyInfinity\admin\src\model;

use App\config\ManagerBDD;

class ManagerAdminGIRessource extends ManagerBDD
{
    public function getRessources(){
        $sql = 'SELECT * FROM ressource ORDER BY id ASC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function verifRessourceExist(){
        $sql = 'SELECT nom FROM ressource WHERE nom = ?';
        $result = $this->createQuery($sql,[$this->nomRessource]);
        return $result->rowCount();
    }

    public function createRessourceBase(){
        $sql = 'INSERT INTO ressource(nom,description) VALUES(?,?)';
        $result = $this->createQuery($sql,[$this->nomRessource,$this->descrRessource]);
        return $result;
    }

    public function verifRessourceExistById(){
        $sql = 'SELECT id FROM ressource WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idRessource]);
        return $result->rowCount();
    }

    public function supprRessourceBase(){
        $sql = 'DELETE FROM ressource WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idRessource]);
        return $result;
    }

    public function modifRessourceBase(){
        $sql = 'UPDATE ressource SET nom = ?, description = ? WHERE id = ?';
        $result = $this->createQuery($sql,[$this->nomRessource,$this->descrRessource,$this->idRessource]);
        return $result;
    }
}