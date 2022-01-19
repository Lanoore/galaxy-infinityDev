<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGIMissions extends ManagerBDD{

    public function getAllMissions(){
        $sql = 'SELECT * FROM missions';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function getAllRecompensesMissions(){
        $sql = 'SELECT * FROM recompenses_missions
                LEFT JOIN missions as missionsId ON missionsId.id = recompenses_missions.id_mission 
                LEFT JOIN items as itemsId ON itemsId.id = recompenses_missions.id_items
                LEFT JOIN ressource as ressourceId ON ressourceId.id = recompenses_missions.id_ressource
                LEFT JOIN craft as craftId ON craftId.id = recompenses_missions.id_craft';
    }

    public function getRecMissionX(){
        $sql = 'SELECT * FROM recompenses_missions 
                LEFT JOIN items as itemsId ON itemsId.id = recompenses_missions.id_items
                LEFT JOIN ressource as ressourceId ON ressourceId.id = recompenses_missions.id_ressource
                LEFT JOIN craft as craftId ON craftId.id = recompenses_missions.id_craft
                WHERE id_mission = ?';
        $result = $this->createQuery($sql,[$this->idMission]);
        return $result->fetchAll();
    }

    public function getPrMissionX(){
        $sql = 'SELECT * FROM pre_requis_missions 
                LEFT JOIN missions as missionsId ON missionsId.id = pre_requis_missions.id_mission 
                LEFT JOIN batiment as batimentId ON batimentId.id = pre_requis_missions.id_bat
                LEFT JOIN population as populationId ON populationId.id = pre_requis_missions.id_pop
        WHERE id_mission = ?';
        $result = $this->createQuery($sql,[$this->idMission]);
        return $result->fetchAll();
    }
}