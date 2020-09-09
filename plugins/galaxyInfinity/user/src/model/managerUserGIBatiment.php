<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGIBatiment extends ManagerBDD
{

    public function getBatPlanete(){
        $sql = 'SELECT * FROM batiment_planete LEFT JOIN batiment ON batiment.id = batiment_planete.batiment_id WHERE planete_id = ? AND tier = ? ORDER BY batiment_id';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->tier]);
        return $result->fetchAll();
    }


}