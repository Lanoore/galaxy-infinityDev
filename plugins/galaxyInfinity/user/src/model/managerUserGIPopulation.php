<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGIPopulation extends ManagerBDD
{

    public function getPopBase(){
        $sql= 'SELECT * FROM population';
        $result = $this->createQuery($sql);
        return $result->fetchAll();

    }

    public function getPopulationsPlaneteX(){
        $sql = 'SELECT * FROM population
                    LEFT JOIN population_planete ON population.id = population_planete.pop_id
                WHERE population_planete.planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetchAll();
    }


    public function getPrPopX(){
        $sql = 'SELECT * FROM pre_requis_population WHERE pop_id = ?';
        $result = $this->createQuery($sql,[$this->idPop]);
        return $result->fetchAll();
    }

    /**
     * getBatPlaneteX
     * 
     * Récupère les batiments sur la planete sélectionner
     *
     * @return array
     */
    public function getBatPlaneteX(){
        $sql = 'SELECT * FROM batiment_planete WHERE planete_id = ? AND batiment_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idBatRequis]);
        return $result->fetch();
    }

    /**
     * getTechnoPlaneteX
     * 
     * Récupère les technologies sur la planete sélectionner
     *
     * @return array
     */
    public function getTechnoPlaneteX(){
        
        $sql = 'SELECT * FROM technologie_planete WHERE planete_id = ? AND technologie_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idTechnoRequis]);
        return $result->fetch();
    }



    public function getNombrePopX(){
        $sql ='SELECT * FROM population_planete WHERE planete_id = ? AND pop_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idPop]);
        return $result->fetch();
    }
}