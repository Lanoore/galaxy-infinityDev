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


}