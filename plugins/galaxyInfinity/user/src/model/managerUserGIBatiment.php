<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGIBatiment extends ManagerBDD
{


    public function getBatBase(){
        $sql = 'SELECT * FROM batiment LEFT JOIN batiment_planete ON batiment.id = batiment_planete.batiment_id 
                                       LEFT JOIN batiment_niveau ON batiment_planete.niveau = batiment_niveau.niveau_id
                WHERE planete_id =? AND tier = ? ORDER BY batiment.id';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->tier]);
        return $result->fetchAll();
    }

    public function getBatBaseCraft(){
        $sql = 'SELECT * FROM batiment_craft';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function getCraftBatX(){
        $sql = 'SELECT * FROM batiment_craft WHERE batiment_id = ? AND niveau_id = ?';
        $result = $this->createQuery($sql,[$this->idBat, $this->idNiveau]);
        return $result->fetchAll();
    }

    public function getPrBatX(){
        $sql = 'SELECT * FROM pre_requis_batiment WHERE batiment_id = ?';
        $result = $this->createQuery($sql,[$this->idBat]);
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

    public function getItemsPlaneteX(){
        $sql = 'SELECT * FROM items_planete WHERE planete_id = ? AND items_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idItems]);
        return $result->fetch();
    }

}