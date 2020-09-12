<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGICraft extends ManagerBDD
{


    public function getCraftBase(){
        $sql = 'SELECT * FROM craft LEFT JOIN craft_planete ON craft.id = craft_planete.craft_id 
                WHERE planete_id =? AND tier = ? ORDER BY craft.id';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->tier]);
        return $result->fetchAll();
    }

    public function getCraftBaseCraft(){
        $sql = 'SELECT * FROM craft_craft';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function getCraftCraftX(){
        $sql = 'SELECT * FROM craft_craft WHERE craft_id = ?';
        $result = $this->createQuery($sql,[$this->idCraft]);
        return $result->fetchAll();
    }

    public function getPrCraftX(){
        $sql = 'SELECT * FROM pre_requis_craft WHERE craft_id = ?';
        $result = $this->createQuery($sql,[$this->idCraft]);
        return $result->fetchAll();
    }

    public function getBatPlaneteX(){
        $sql = 'SELECT * FROM batiment_planete WHERE planete_id = ? AND batiment_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idBatRequis]);
        return $result->fetch();
    }

    public function getTechnoPlaneteX(){
        
        $sql = 'SELECT * FROM technologie_planete WHERE planete_id = ? AND technologie_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idTechnoRequis]);
        return $result->fetch();
    }

    public function getCraftPlaneteX(){
        $sql = 'SELECT * FROM craft_planete WHERE planete_id = ? AND craft_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idCraft]);
        return $result->fetch();
    }

    public function getRessourcePlaneteX(){
        $sql = 'SELECT * FROM ressource_planete WHERE planete_id = ? AND ressource_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idRessource]);
        return $result->fetch();
    }

}