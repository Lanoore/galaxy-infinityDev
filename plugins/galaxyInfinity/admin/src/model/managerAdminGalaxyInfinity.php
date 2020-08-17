<?php

namespace App\plugins\galaxyInfinity\admin\src\model;

use App\config\ManagerBDD;

class ManagerAdminGalaxyInfinity extends ManagerBDD
{

    public function getNiveaux(){
        $sql = 'SELECT * FROM niveau ORDER BY niveau ASC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function getDernierNiveau(){
        $sql ='SELECT * FROM niveau ORDER BY niveau DESC LIMIT 1';
        $result = $this->createQuery($sql);
        $niveau = $result->fetch();
        $result->closeCursor();
        $this->idNiveau = $niveau['id'];
        $this->niveau = $niveau['niveau'];
    }

    public function addNiveau(){
        $sql = 'INSERT INTO niveau(niveau) VALUES (?)';
        $result = $this->createQuery($sql, [$this->niveau]);
        return $result;
    }

}