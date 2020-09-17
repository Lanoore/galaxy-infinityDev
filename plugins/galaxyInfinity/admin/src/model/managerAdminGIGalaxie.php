<?php

namespace App\plugins\galaxyInfinity\admin\src\model;


use App\config\managerBdd;

class ManagerAdminGIGalaxie extends managerBdd
{    
    /**
     * getPlanetes
     * 
     * Récupère les planetes
     *
     * @return array
     */
    public function getPlanetes(){
        $sql = 'SELECT * FROM planete
                LEFT JOIN user ON user.id = planete.user_id
          ORDER BY systeme ASC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * getLastSysteme
     *
     * Récupère l'id du denier systeme
     * 
     * @return array
     */
    public function getLastSysteme(){
        $sql ='SELECT systeme FROM planete ORDER BY id DESC LIMIT 1';
        $result = $this->createQuery($sql);
        return $result->fetch();
    }
    
    /**
     * createSystemePlanete
     * 
     * Créer une planete
     *
     * @return bool
     */
    public function createSystemePlanete(){
        $sql = 'INSERT INTO planete(systeme,position,situation)VALUES(?,?,0)';
        return $this->createQuery($sql,[$this->numeroSysteme,$this->numeroPlanete]);
        
    }
    
    /**
     * verifPlaneteExist
     * 
     * Vérifie si la planete existe
     *
     * @return int
     */
    public function verifPlaneteExist(){
        $sql= 'SELECT id FROM planete WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->rowCount();
    }
    
    /**
     * supprPlanete
     * 
     * Supprime la planete
     *
     * @return void
     */
    public function supprPlanete(){
        $sql = 'DELETE FROM planete WHERE id = ?';
        return $this->createQuery($sql,[$this->idPlanete]);
        
    }
    
    /**
     * modifSituationPlanete
     *
     * Modifie la situation de la planete
     * 
     * @return void
     */
    public function modifSituationPlanete(){
        $sql = 'UPDATE planete SET situation = ? WHERE id = ?';
        return $this->createQuery($sql,[$this->situationPlanete, $this->idPlanete]);
        
    }
}