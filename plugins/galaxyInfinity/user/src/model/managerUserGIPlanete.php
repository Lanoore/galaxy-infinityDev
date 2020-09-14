<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGIPlanete extends ManagerBDD
{

    public function getPlanete(){
        $sql ='SELECT * FROM planete WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        $result = $result->fetch();
        $this->systeme = $result['systeme'];
        $this->position = $result['position'];
        $this->lastActivite = $result['last_activite'];
    }


    public function changeLastActivitePlanete(){
        $sql = 'UPDATE planete SET last_activite = ? WHERE id = ?';
        return $result = $this->createQuery($sql,[$this->lastActivite, $this->idPlanete]);
    }

    public function getBatimentProd(){
        $sql ='SELECT * FROM batiment_prod_ressource';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function getNiveauBatiment(){
        $sql = 'SELECT * FROM batiment_planete WHERE planete_id = ? AND batiment_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idBat]);
        return $result->fetch();
    }

    public function getProdRessource(){
        $sql = 'SELECT * FROM prod_ressources WHERE batiment_id = ? AND niveau_id = ?';
        $result = $this->createQuery($sql,[$this->idBat, $this->niveauBat]);
        return $result->fetch();
    }

    public function getRessourcePlanete(){
        $sql = 'SELECT * FROM ressource_planete WHERE planete_id = ? AND ressource_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete, $this->idRessource]);
        return $result->fetch();
    }

    public function changeNombreRessource(){
        $sql ='UPDATE ressource_planete SET nombre_ressource = ? WHERE planete_id = ? AND ressource_id = ?';
        return $result = $this->createQuery($sql,[$this->totalRessource,$this->idPlanete, $this->idRessource]);
        
    }


    
    
}