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
        return $this->createQuery($sql,[$this->nomRessource,$this->descrRessource]);
    }

    public function verifRessourceExistById(){
        $sql = 'SELECT id FROM ressource WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idRessource]);
        return $result->rowCount();
    }

    public function supprRessourceBase(){
        $sql = 'DELETE FROM ressource WHERE id = ?';
        return $this->createQuery($sql,[$this->idRessource]);
        
    }

    public function modifRessourceBase(){
        $sql = 'UPDATE ressource SET nom = ?, description = ? WHERE id = ?';
        return $this->createQuery($sql,[$this->nomRessource,$this->descrRessource,$this->idRessource]);
        
    }
    
    /**
     * getProdRessources
     *
     * @return array
     */
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
        return $this->createQuery($sql,[$this->idBat,$this->idNiveau,$this->idRessource, $this->prodRessource]);
        

    }

    public function supprProdRessourceBat(){
        $sql ='DELETE FROM prod_ressources WHERE batiment_id = ? AND niveau_id = ? AND ressource_id = ?';
        return $this->createQuery($sql,[$this->idBat,$this->idNiveau,$this->idRessource]);
        
    }
    
    public function modifProdRessourceBat(){
        $sql = 'UPDATE prod_ressources SET batiment_id = ?, niveau_id = ?, ressource_id = ?, prod_ressource_niveau = ? WHERE batiment_id = ? AND niveau_id = ? AND ressource_id = ?';
        return $this->createQuery($sql,[$this->idBat,$this->idNiveau,$this->idRessource, $this->prodRessource,$this->idBat,$this->idNiveau,$this->idRessource]);
        
    }
    

    public function getLiaisonRessourceBat(){
        $sql = 'SELECT * FROM batiment_prod_ressource';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function verifLiaisonRessourceBatExist(){
        $sql = 'SELECT * FROM batiment_prod_ressource WHERE ressource_id = ?';
        $result = $this->createQuery($sql,[$this->idRessource]);
        return $result->rowCount();
    }

    public function createLiaisonRessourceBat(){
        $sql = 'INSERT INTO batiment_prod_ressource(ressource_id,batiment_id) VALUES(?,?)';
        return $result = $this->createQuery($sql,[$this->idRessource,$this->idBat]);  
    }

    public function supprLiaisonRessourceBat(){
        $sql = 'DELETE FROM batiment_prod_ressource WHERE batiment_id = ? AND ressource_id = ?';
        return $result = $this->createQuery($sql,[$this->idBat,$this->idRessource]);  
    }

    public function modifLiaisonRessourceBat(){
        $sql = 'UPDATE batiment_prod_ressource SET batiment_id = ? WHERE ressource_id = ?';
        return $result = $this->createQuery($sql,[$this->idBat,$this->idRessource]);  
    }

}