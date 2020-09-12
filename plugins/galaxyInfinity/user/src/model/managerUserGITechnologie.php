<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGITechnologie extends ManagerBDD
{

    public function getTechnoBase(){
        $sql = 'SELECT * FROM technologie LEFT JOIN technologie_planete ON technologie.id = technologie_planete.technologie_id 
                                       /*LEFT JOIN technologie_niveau ON technologie_planete.niveau = technologie_niveau.niveau_id*/
                WHERE planete_id =? AND tier = ? ORDER BY technologie.id';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->tier]);
        return $result->fetchAll();
    }

    public function getTechnoBaseCraft(){
        $sql = 'SELECT * FROM technologie_craft';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function getCraftTechnoX(){
        $sql = 'SELECT * FROM technologie_craft WHERE technologie_id = ? AND niveau_id = ?';
        $result = $this->createQuery($sql,[$this->idTechno, $this->idNiveau]);
        return $result->fetchAll();
    }

    public function getPrTechnoX(){
        $sql = 'SELECT * FROM pre_requis_technologie WHERE technologie_id = ?';
        $result = $this->createQuery($sql,[$this->idTechno]);
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