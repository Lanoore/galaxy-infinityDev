<?php

namespace App\plugins\galaxyInfinity\admin\src\model;


use App\config\managerBdd;

class ManagerAdminGIGalaxie extends managerBdd
{
    public function getPlanetes(){

        // $sql = 'SELECT planete.id ,planete.systeme , planete.position , planete.situation , planete.user_id, user.pseudo pseudoJoueur FROM planete INNER JOIN user ON planete.user_id = user.id  ORDER BY systeme ASC';

        $sql = 'SELECT id ,systeme , position , situation , user_id FROM planete  ORDER BY systeme ASC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function getLastSysteme(){
        $sql ='SELECT systeme FROM planete ORDER BY id DESC LIMIT 1';
        $result = $this->createQuery($sql);
        return $result->fetch();
    }

    public function createSystemePlanete(){
        $sql = 'INSERT INTO planete(systeme,position,situation)VALUES(?,?,0)';
        return $this->createQuery($sql,[$this->numeroSysteme,$this->numeroPlanete]);
        
    }

    public function verifPlaneteExist(){
        $sql= 'SELECT id FROM planete WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->rowCount();
    }

    public function supprPlanete(){
        $sql = 'DELETE FROM planete WHERE id = ?';
        return $this->createQuery($sql,[$this->idPlanete]);
        
    }

    public function modifSituationPlanete(){
        $sql = 'UPDATE planete SET situation = ? WHERE id = ?';
        return $this->createQuery($sql,[$this->situationPlanete, $this->idPlanete]);
        
    }
}