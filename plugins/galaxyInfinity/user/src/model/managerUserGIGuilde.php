<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGIGuilde extends ManagerBDD
{


    public function verifJoueurInGuilde(){

        $sql = 'SELECT idGuilde FROM user WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idUser]);
        return $result->fetch();
    }

    public function createNewGuilde(){
        $sql = 'INSERT INTO guilde (nomGuilde,idChefGuilde) VALUES (?,?)';
        return $result = $this->createQuery($sql,[$this->nomGuilde, $this->idUser]);
        
    }

    public function getGuildeByName(){
        $sql = 'SELECT * FROM guilde WHERE nomGuilde = ? ';
        $result = $this->createQuery($sql,[$this->nomGuilde]);
        $result = $result->fetch();
        $this->idGuilde = $result['idGuilde'];
    }

    public function setUserNewGuilde(){
        $sql ='UPDATE user SET idGuilde = ? WHERE id = ?';
        return $result = $this->createQuery($sql,[$this->idGuilde, $this->idUser    ]);
        
    }

    public function getAllGuilde(){
        $sql = 'SELECT * FROM guilde';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function verifGuildeExist(){
        $sql ='SELECT * FROM guilde WHERE idGuilde = ?';
        $result = $this->createQuery($sql,[$this->idGuilde]);
        return $result->rowCount();
    }

    public function joinGuilde(){
        $sql = 'UPDATE user SET idGuilde = ? WHERE id = ?';
        return $result = $this->createQuery($sql,[$this->idGuilde, $this->idUser]);
        
    }

    public function getAllMembreGuilde(){
        $sql ='SELECT * FROM user WHERE idGuilde = ?';
        $result = $this->createQuery($sql,[$this->idGuilde]);
        return $result->fetchAll();
    }

    public function getGuilde(){
        $sql = 'SELECT * FROM guilde WHERE idGuilde = ?';
        $result = $this->createQuery($sql,[$this->idGuilde]);
        return $result->fetch();
    }

    public function quitterGuilde(){
        $sql = 'UPDATE user SET idGuilde = NULL WHERE id = ?';
        return $result = $this->createQuery($sql, [$this->idUser]);
    }

    public function supprMembreGuilde(){
        $sql ='UPDATE user SET idGuilde = NULL WHERE id = ?';
        return $result =$this->createQuery($sql,[$this->idUser]);
    }

    public function supprGuilde(){
        $sql = 'DELETE FROM guilde WHERE idGuilde = ?';
        return $this->createQuery($sql,[$this->idGuilde]);
    }

}