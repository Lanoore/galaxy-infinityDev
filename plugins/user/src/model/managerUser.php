<?php

namespace App\plugins\user\src\model;

use App\config\ManagerBDD;

class ManagerUser extends ManagerBDD
{
    


    public function getUser(){

        $sql = 'SELECT id, pseudo, email, password, lastConnexion, dateInscription FROM user WHERE pseudo = ?';
        $result =  $this->createQuery($sql, [$this->pseudo]);
        $user = $result->fetch();
        $result->closeCursor();
        $this->idUser = $user['id'];
        $this->pseudo = $user['pseudo'];
        $this->email = $user['email'];
        $this->password = $user['password'];
        $this->lastConnexion = $user['lastConnexion'];
        $this->dateInscription = $user['dateInscription'];
    }

    public function verifUserExist(){
        
        $sql = 'SELECT pseudo, email FROM user WHERE pseudo = ? UNION SELECT pseudo,email FROM user WHERE email = ?';
        $result = $this->createQuery($sql,[$this->pseudo,$this->email]);
        
        $existUser = $result->rowCount();
        $result->closeCursor();
        
        $this->existUser = $existUser;
        
    }

    public function addUser(){
        $sql = 'INSERT INTO user(pseudo,email,password,dateInscription) VALUES(?,?,?,NOW())';
        $result = $this->createQuery($sql,[$this->pseudo,$this->email,$this->password]);
        return $result;
        
    }

    public function updateUserConnection(){

        $sql = 'UPDATE user SET lastConnexion = NOW() WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idUser]);

        $sql = 'SELECT lastConnexion FROM user WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idUser]);
        $lastConnexion = $result->fetch();
        $this->lastConnexion = $lastConnexion['lastConnexion'];
    }


}