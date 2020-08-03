<?php

namespace App\plugins\admin\src\model;

use App\config\ManagerBDD;

class ManagerAdmin extends ManagerBDD
{
    public function __construct(){

        $this->identifiantAdmin = 'admin';
        $getAdmin = $this->getAdmin();

        if(empty($getAdmin)){
            $password = password_hash('1234', PASSWORD_DEFAULT);
            $this->identifiantAdmin = 'admin';
            $this->passwordAdmin = $password;
            $this->insertAdmin();

        }


    }

    public function getAdmin(){
        $sql = 'SELECT id, identifiant, password FROM admin WHERE identifiant = ?';
        $result = $this->createQuery($sql, [$this->identifiantAdmin]);
        $admin = $result->fetch();
        $this->idAdmin = $admin['id'];
        $this->identifiantAdmin = $admin['identifiant'];
        $this->passwordAdmin = $admin['password'];
        return $admin;
    }

    public function insertAdmin(){
        $sql = 'INSERT INTO admin(identifiant,password) VALUES(?,?)';
        $result = $this->createQuery($sql,[$this->identifiantAdmin,$this->passwordAdmin]);
        return $result;
    }


    public function changePassword(){
        $sql = 'UPDATE admin SET password = ? WHERE identifiant = ?';
        $result = $this->createQuery($sql,[$this->password_hache, $this->identifiantAdmin]);
        return $result;
    }
}