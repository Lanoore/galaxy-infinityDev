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


    public function verifPopEnCours(){
        $sql ='SELECT * FROM formation_pop_planete WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->rowCount();
    }


    public function getPopFormX(){
        $sql = 'SELECT * FROM population_formation
                LEFT JOIN craft ON population_formation.craft_id = craft.id
                LEFT JOIN population ON population_formation.pop_id_formation = population.id
        WHERE pop_id = ?';
        $result = $this->createQuery($sql,[$this->idPop]);
        return $result->fetchAll();
    }

    public function getCraftPlaneteX(){
        $sql = 'SELECT * FROM craft_planete WHERE planete_id = ? AND craft_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idCraft]);
        return $result->fetch();
    }

    public function getPopulationPlaneteX(){
        $sql = 'SELECT * FROM population_planete WHERE planete_id = ? AND pop_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idPopForm]);
        return $result->fetch();
    }
    
    public function getPop(){
        $sql = 'SELECT * FROM population WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idPop]);
        return $result->fetch();
    }

    public function verifPopExist(){
        $sql = 'SELECT * FROM population WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idPop]);
        return $result->rowCount();
    }

    public function updateCraftXPlaneteX(){
        $sql = 'UPDATE craft_planete SET nombre_craft = ? WHERE planete_id = ? AND craft_id = ?';
        return $result = $this->createQuery($sql,[$this->nbCraftFinal,$this->idPlanete,$this->idCraft]);
    }

    public function getPopPlaneteX(){
        $sql = 'SELECT * FROM population_planete WHERE planete_id = ? AND pop_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idPop]);
        return $result->fetch();
    }

    public function updatePopXPlaneteX(){
        $sql = 'UPDATE population_planete SET nombre_pop = ? WHERE planete_id = ? AND pop_id = ?';
        return $result = $this->createQuery($sql,[$this->nbPopFinal,$this->idPlanete,$this->idPop]);
    }

    public function addFormationPop(){
        $sql = 'INSERT INTO formation_pop_planete(planete_id,population_id,fin_pop_actuel,nombre_pop_formation) VALUES(?,?,?,?)';
        return $result = $this->createQuery($sql,[$this->idPlanete,$this->idPop,$this->finPopActuel,$this->nombrePop]);
    }

    public function getPopFormEnCours(){
        $sql ='SELECT * FROM formation_pop_planete
                LEFT JOIN population ON formation_pop_planete.population_id = population.id
        WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetch();
    }

}