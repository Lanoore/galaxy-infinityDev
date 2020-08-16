<?php

namespace App\plugins\galaxyInfinity\admin\src\model;

use App\config\ManagerBDD;

class ManagerAdminGIItems extends ManagerBDD
{
    function __construct(){
        $this->idCraft = null;
        $this->nomCraft = null;

    }

    public function getItems(){

        $sql = 'SELECT * FROM items ORDER BY id';
        $result = $this->createQuery($sql);
        return $result->fetchAll();

    }

    public function itemExist(){
        $sql = 'SELECT * FROM items WHERE nom = ?';
        $result = $this->createQuery($sql,[$this->nomItems]);
        return $result->rowCount();
    }

    public function addItem(){
        $sql = 'INSERT INTO items(nom) VALUES(?)';
        $result = $this->createQuery($sql,[$this->nomItems]);
        return $result;
    }

    public function supprItemBase(){
        $sql = 'DELETE FROM items WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idItem]);
        return $result;
    }

    public function getItemById(){
        $sql = 'SELECT * FROM items WHERE id= ?';
        $result = $this->createQuery($sql,[$this->idItem]);
        
        $this->nomItem = $result['nom'];
    }

    public function modifItemBase(){
        $sql = 'UPDATE items SET nom = ? WHERE id = ?';
        $result = $this->createQuery($sql,[$this->nomItem,$this->idItem]);
        return $result;
    }
}