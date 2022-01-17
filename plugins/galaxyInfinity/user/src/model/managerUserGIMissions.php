<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGIMissions extends ManagerBDD{

    public function getAllMissions(){
        $sql = 'SELECT * FROM missions';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
}