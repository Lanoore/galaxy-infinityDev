<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGIGalaxie extends ManagerBDD
{

    public function getSysteme(){
        $sql = 'SELECT * FROM planete
                LEFT JOIN user ON planete.user_id = user.id
         WHERE systeme = ? ORDER BY position ASC';
        $result = $this->createQuery($sql,[$this->idSysteme]);
        return $result->fetchAll();
    }

    public function verifSystemeExist(){
        $sql = 'SELECT * FROM planete WHERE systeme = ?';
        $result = $this->createQuery($sql,[$this->idSysteme]);
        return $result->rowCount();
    }
}