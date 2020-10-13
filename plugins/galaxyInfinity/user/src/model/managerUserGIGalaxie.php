<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGIGalaxie extends ManagerBDD
{
    
    /**
     * getSysteme
     *
     * Récupère les planetes de la galaxie
     * 
     * @return array
     */
    public function getSysteme(){
        $sql = 'SELECT * FROM planete
                LEFT JOIN user ON planete.user_id = user.id
                LEFT JOIN guilde ON guilde.idGuilde = user.idGuilde
         WHERE systeme = ? ORDER BY position ASC';
        $result = $this->createQuery($sql,[$this->idSysteme]);
        return $result->fetchAll();
    }
    
    /**
     * verifSystemeExist
     * 
     * Vérifie si le systeme existe
     *
     * @return int
     */
    public function verifSystemeExist(){
        $sql = 'SELECT * FROM planete WHERE systeme = ?';
        $result = $this->createQuery($sql,[$this->idSysteme]);
        return $result->rowCount();
    }

    
    /**
     * changeLastActivitePlanete
     * 
     * Change la situation de la planete
     *
     * @return bool
     */
    public function changeLastActivitePlanete(){
        $sql = 'UPDATE planete SET last_activite = ? WHERE id = ?';
        return $result = $this->createQuery($sql,[$this->lastActivite, $this->idPlanete]);
        
    }
}