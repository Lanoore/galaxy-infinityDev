<?php

namespace App\plugins\galaxyInfinity\admin\src\model;

use App\config\ManagerBDD;

class ManagerAdminGIRessource extends ManagerBDD
{    
    /**
     * getRessources
     *
     * Récupère toutes les ressources
     * 
     * @return array
     */
    public function getRessources(){
        $sql = 'SELECT * FROM ressource ORDER BY id ASC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * verifRessourceExist
     *
     * Vérifie si la ressource existe
     * 
     * @return int
     */
    public function verifRessourceExist(){
        $sql = 'SELECT nom FROM ressource WHERE nom = ?';
        $result = $this->createQuery($sql,[$this->nomRessource]);
        return $result->rowCount();
    }
    
    /**
     * createRessourceBase
     * 
     * Créer la ressource de base
     *
     * @return bool
     */
    public function createRessourceBase(){
        $sql = 'INSERT INTO ressource(nom,description) VALUES(?,?)';
        return $this->createQuery($sql,[$this->nomRessource,$this->descrRessource]);
    }
    
    /**
     * verifRessourceExistById
     * 
     * Vérifie si une ressource existe sous cet id
     *
     * @return int
     */
    public function verifRessourceExistById(){
        $sql = 'SELECT id FROM ressource WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idRessource]);
        return $result->rowCount();
    }
    
    /**
     * supprRessourceBase
     * 
     * Supprime la ressource de base
     *
     * @return bool
     */
    public function supprRessourceBase(){
        $sql = 'DELETE FROM ressource WHERE id = ?';
        return $this->createQuery($sql,[$this->idRessource]);
        
    }
    
    /**
     * modifRessourceBase
     * 
     * Modifie la ressource de base
     *
     * @return bool
     */
    public function modifRessourceBase(){
        $sql = 'UPDATE ressource SET nom = ?, description = ? WHERE id = ?';
        return $this->createQuery($sql,[$this->nomRessource,$this->descrRessource,$this->idRessource]);
        
    }
        
    /**
     * getProdRessources
     * 
     * Récupère toutes les prod des ressouces
     *
     * @return array
     */
    public function getProdRessources(){
        $sql = 'SELECT * FROM prod_ressources
                LEFT JOIN batiment ON batiment.id = prod_ressources.batiment_id
                LEFT JOIN ressource ON ressource.id = prod_ressources.ressource_id
         ORDER BY batiment_id ASC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * verifProdExist
     *
     * Vérifie si la prod existe deja
     * 
     * @return int
     */
    public function verifProdExist(){
        $sql ='SELECT prod_ressource_niveau FROM prod_ressources WHERE batiment_id = ? AND niveau_id = ? AND ressource_id = ?';
        $result = $this->createQuery($sql,[$this->idBat,$this->idNiveau,$this->idRessource]);
        return $result->rowCount();
    }
    
    /**
     * createProdRessourceBat
     * 
     * Créer la prod par raport a la ressource et le batiment
     *
     * @return bool
     */
    public function createProdRessourceBat(){
        $sql = 'INSERT INTO prod_ressources(batiment_id,niveau_id,ressource_id,prod_ressource_niveau)VALUES(?,?,?,?)';
        return $this->createQuery($sql,[$this->idBat,$this->idNiveau,$this->idRessource, $this->prodRessource]);
    }
    
    /**
     * supprProdRessourceBat
     * 
     * Supprime la prod par rapport a la ressource et le batiment
     *
     * @return bool
     */
    public function supprProdRessourceBat(){
        $sql ='DELETE FROM prod_ressources WHERE batiment_id = ? AND niveau_id = ? AND ressource_id = ?';
        return $this->createQuery($sql,[$this->idBat,$this->idNiveau,$this->idRessource]);
        
    }
        
    /**
     * modifProdRessourceBat
     * 
     * Modifie la prod par rapport a la ressource et le batiment
     *
     * @return bool
     */
    public function modifProdRessourceBat(){
        $sql = 'UPDATE prod_ressources SET batiment_id = ?, niveau_id = ?, ressource_id = ?, prod_ressource_niveau = ? WHERE batiment_id = ? AND niveau_id = ? AND ressource_id = ?';
        return $this->createQuery($sql,[$this->idBat,$this->idNiveau,$this->idRessource, $this->prodRessource,$this->idBat,$this->idNiveau,$this->idRessource]);
        
    }
    
    
    /**
     * getLiaisonRessourceBat
     * 
     * Récupère toutes les laisons entre les ressources et les batiments
     *
     * @return void
     */
    public function getLiaisonRessourceBat(){
        $sql = 'SELECT * FROM batiment_prod_ressource
                LEFT JOIN batiment ON batiment.id = batiment_prod_ressource.batiment_id
                LEFT JOIN ressource ON ressource.id = batiment_prod_ressource.ressource_id';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * verifLiaisonRessourceBatExist
     *
     *  Vérifie si une liaison existe deja avec cette ressource
     * 
     * @return int
     */
    public function verifLiaisonRessourceBatExist(){
        $sql = 'SELECT * FROM batiment_prod_ressource WHERE ressource_id = ?';
        $result = $this->createQuery($sql,[$this->idRessource]);
        return $result->rowCount();
    }
    
    /**
     * createLiaisonRessourceBat
     * 
     * Ajoute la liaison entre le batiment et la ressource
     *
     * @return bool
     */
    public function createLiaisonRessourceBat(){
        $sql = 'INSERT INTO batiment_prod_ressource(ressource_id,batiment_id) VALUES(?,?)';
        return $result = $this->createQuery($sql,[$this->idRessource,$this->idBat]);  
    }
    
    /**
     * supprLiaisonRessourceBat
     * 
     * Supprime la liaison entre le batiment et la ressource
     *
     *
     * @return bool
     */
    public function supprLiaisonRessourceBat(){
        $sql = 'DELETE FROM batiment_prod_ressource WHERE batiment_id = ? AND ressource_id = ?';
        return $result = $this->createQuery($sql,[$this->idBat,$this->idRessource]);  
    }
    
    /**
     * modifLiaisonRessourceBat
     *
     * Modifie la liaison entre le batiment et la ressource
     *
     * 
     * @return bool
     */
    public function modifLiaisonRessourceBat(){
        $sql = 'UPDATE batiment_prod_ressource SET batiment_id = ? WHERE ressource_id = ?';
        return $result = $this->createQuery($sql,[$this->idBat,$this->idRessource]);  
    }

}