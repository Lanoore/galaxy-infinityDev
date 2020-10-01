<?php

namespace App\plugins\admin\src\model;

use App\config\managerBDD;

class ManagerAdmin extends managerBDD
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
    
    /**
     * getAdmin
     *  
     *  Récupère les informations de l'administrateur
     * 
     * @return bool
     */
    public function getAdmin(){
        $sql = 'SELECT id, identifiant, password FROM admin WHERE identifiant = ?';
        $result = $this->createQuery($sql, [$this->identifiantAdmin]);
        $admin = $result->fetch();
        $this->idAdmin = $admin['id'];
        $this->identifiantAdmin = $admin['identifiant'];
        $this->passwordAdmin = $admin['password'];
        return $admin;
    }
    
    /**
     * insertAdmin
     *
     *  Permet d'ajouter un admin par défaut si aucun existe
     * 
     * @return bool
     */
    public function insertAdmin(){
        $sql = 'INSERT INTO admin(identifiant,password) VALUES(?,?)';
        $result = $this->createQuery($sql,[$this->identifiantAdmin,$this->passwordAdmin]);
        return $result;
    }

    
    /**
     * changePassword
     *  
     *  Permet de changer le mot de passe de l'administrateur dans la bdd
     * 
     * @return bool
     */
    public function changePassword(){
        $sql = 'UPDATE admin SET password = ? WHERE identifiant = ?';
        $result = $this->createQuery($sql,[$this->password_hache, $this->identifiantAdmin]);
        return $result;
    }
}