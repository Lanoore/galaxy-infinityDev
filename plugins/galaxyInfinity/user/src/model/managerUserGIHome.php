<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGIHome extends ManagerBDD
{


    public function getConstruCraftEnCours(){
        $sql = 'SELECT * FROM construction_craft_planete
                LEFT JOIN craft ON construction_craft_planete.craft_id = craft.id
        WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetch();
    }

    public function getConstruBatEnCours(){
        $sql = 'SELECT * FROM construction_batiment_planete 
                LEFT JOIN batiment ON construction_batiment_planete.batiment_id = batiment.id
        WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetch();
    }

    public function getConstruTechnoEnCours(){
        $sql ='SELECT * FROM construction_technologie_planete
                LEFT JOIN technologie ON construction_technologie_planete.technologie_id = technologie.id
            WHERE planete_id = ?';
            $result = $this->createQuery($sql,[$this->idPlanete]);
            return $result->fetch();   
    }

    public function getAllRessources(){
        $sql ='SELECT * FROM ressource_planete
               LEFT JOIN ressource ON ressource.id = ressource_planete.ressource_id
        WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetchAll();
    }


    public function getAllBatPlaneteX(){
        $sql ='SELECT * FROM batiment_planete
               LEFT JOIN batiment ON batiment.id = batiment_planete.batiment_id
            WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetchAll();
    }

    public function getAllCraftPlaneteX(){
        $sql='SELECT * FROM craft_planete
              LEFT JOIN craft ON craft.id = craft_planete.craft_id
            WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetchAll();
    }

    public function getAllTechnoPlaneteX(){
        $sql ='SELECT * FROM technologie_planete
               LEFT JOIN technologie ON technologie.id = technologie_planete.technologie_id
            WHERE planete_id =?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetchAll();
    }

}