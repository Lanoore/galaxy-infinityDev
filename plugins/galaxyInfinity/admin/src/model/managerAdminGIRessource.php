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

    public function getProdRessources(){
        $sql = 'SELECT * FROM prod_ressources ORDER BY batiment_id ASC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function verifProdExist(){
        $sql ='SELECT prod_ressource_niveau FROM prod_ressources WHERE batiment_id = ? AND niveau_id = ? AND ressource_id = ?';
        $result = $this->createQuery($sql,[$this->idBat,$this->idNiveau,$this->idRessource]);
        return $result->rowCount();
    }

    public function createProdRessourceBat(){
        $sql = 'INSERT INTO prod_ressources(batiment_id,niveau_id,ressource_id,prod_ressource_niveau)VALUES(?,?,?,?)';
        $result = $this->createQuery($sql,[$this->idBat,$this->idNiveau,$this->idRessource, $this->prodRessource]);
        return $result;

    }

    public function supprProdRessourceBat(){
        $sql ='DELETE FROM prod_ressources WHERE batiment_id = ? AND niveau_id = ? AND ressource_id = ?';
        $result = $this->createQuery($sql,[$this->idBat,$this->idNiveau,$this->idRessource]);
        return $result;
    }
    
    public function modifProdRessourceBat(){
        $sql = 'UPDATE prod_ressources SET batiment_id = ?, niveau_id = ?, ressource_id = ?, prod_ressource_niveau = ? WHERE batiment_id = ? AND niveau_id = ? AND ressource_id = ?';
        $result = $this->createQuery($sql,[$this->idBat,$this->idNiveau,$this->idRessource, $this->prodRessource,$this->idBat,$this->idNiveau,$this->idRessource]);
        return $result;
    }
    
}