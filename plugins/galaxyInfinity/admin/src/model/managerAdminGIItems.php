<?php

namespace App\plugins\galaxyInfinity\admin\src\model;

use App\config\ManagerBDD;

class ManagerAdminGIItems extends ManagerBDD
{
    function __construct(){
        $this->idCraft = null;
        $this->nomCraft = null;

    }
    
    /**
     * getItems
     * 
     * Récupère tout les items
     *
     * @return array
     */
    public function getItems(){

        $sql = 'SELECT * FROM items ORDER BY id';
        $result = $this->createQuery($sql);
        return $result->fetchAll();

    }
    
    /**
     * itemExist
     * 
     * Vérifie si l'item existe
     *
     * @return int
     */
    public function itemExist(){
        $sql = 'SELECT * FROM items WHERE nom = ?';
        $result = $this->createQuery($sql,[$this->nomItems]);
        return $result->rowCount();
    }
    
    /**
     * addItem
     * 
     * Ajoute l'item de base
     *
     * @return void
     */
    public function addItem(){
        $sql = 'INSERT INTO items(nom) VALUES(?)';
        return $this->createQuery($sql,[$this->nomItems]);
        
    }
    
    /**
     * supprItemBase
     * 
     * Supprime l'item de base
     *
     * @return void
     */
    public function supprItemBase(){
        $sql = 'DELETE FROM items WHERE id = ?';
        return $this->createQuery($sql,[$this->idItem]);
        
    }
    
    /**
     * getItemById
     * 
     * Récupère un item par rapport a son id
     *
     * @return void
     */
    public function getItemById(){
        $sql = 'SELECT * FROM items WHERE id= ?';
        $result = $this->createQuery($sql,[$this->idItem]);
        
        $this->nomItem = $result['nom'];
    }
    
    /**
     * modifItemBase
     *
     * Modifie l'item de base
     * 
     * @return void
     */
    public function modifItemBase(){
        $sql = 'UPDATE items SET nom = ? WHERE id = ?';
        return $this->createQuery($sql,[$this->nomItem,$this->idItem]);
        
    }

    public function getAllPlaneteActive(){
        $sql = 'SELECT * FROM planete WHERE situation != 0';
        $result =  $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function getItemsBaseByName(){
        $sql = 'SELECT * FROM items WHERE nom = ?';
        $result = $this->createQuery($sql,[$this->nomItems]);
        return $result->fetch();
    }

    public function insertItemsBasePlaneteX(){
        $sql = 'INSERT INTO items_planete(niveau,planete_id,items_id) VALUES(0,?,?)';
        return $this->createQuery($sql,[$this->idPlanete,$this->idItems]);
    }
}