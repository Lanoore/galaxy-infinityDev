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

    public function getBatPlaneteX(){
        $sql = 'SELECT * FROM batiment_planete WHERE planete_id = ? AND batiment_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idBatRequis]);
        return $result->fetch();
    }

    public function getPopPlaneteX(){
        $sql = 'SELECT * FROM population_planete WHERE planete_id = ? AND pop_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idPopRequis]);
        return $result->fetch();
    }

    public function verifMissionExistById(){
        $sql = 'SELECT * FROM missions WHERE id= ?';
        $result = $this->createQuery($sql,[$this->idMission]);
        return $result->rowCount();
    }

    public function getMission(){
        $sql = 'SELECT * FROM missions WHERE id=?';
        $result = $this->createQuery($sql,[$this->idMission]);
        return $result->fetchAll();
    }

    public function getAllQMission(){
        $sql = 'SELECT * FROM missions_texte_q WHERE id_mission= ?';
        $result = $this->createQuery($sql,[$this->idMission]);
        return $result->fetchAll();
    }
    public function getAllRMission(){
        $sql = 'SELECT * FROM missions_texte_r WHERE id_mission= ?';
        $result = $this->createQuery($sql,[$this->idMission]);
        return $result->fetchAll();
    }

    public function setMissionEnCours(){
        $sql = 'INSERT INTO missions_en_cours(id_planete,id_mission) VALUES(?,?)';
        return $this->createQuery($sql,[$this->idPlanete,$this->idMission]);

    }

    public function verifMissionEnCours(){
        $sql = 'SELECT * FROM missions_en_cours WHERE id_planete = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->rowCount();
    }

    public function sauvegardeMissionTextuel(){
        $sql = 'INSERT INTO sauvegarde_mission_textuel(id_planete,id_mission,id_question) VALUES (?,?,?)';
        return $this->createQuery($sql,[$this->idPlanete,$this->idMission,$this->idQuestionActive]);
    }

    public function modifSauvegardeMissionTextuel(){
        $sql = 'UPDATE sauvegarde_mission_textuel SET id_question = ? WHERE id = ?';
        return $this->createQuery($sql,[$this->idQuestionActive,$this->idSauvegarde]);
    }

    public function getSauvegardeMissionTextuel(){
        $sql = 'SELECT * FROM sauvegarde_mission_textuel WHERE id_planete = ?';
        $result =  $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetchAll();
    }
}