<?php

namespace App\plugins\galaxyInfinity\admin\src\model;

use App\config\ManagerBDD;

class ManagerAdminGalaxyInfinity extends ManagerBDD
{
    
    /**
     * getNiveaux
     *
     * Récupère tout les niveaux du jeu
     * 
     * @return void
     */
    public function getNiveaux(){
        $sql = 'SELECT * FROM niveau ORDER BY niveau ASC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * getDernierNiveau
     *
     * Récupère le dernier niveau du jeu
     * 
     * @return void
     */
    public function getDernierNiveau(){
        $sql ='SELECT * FROM niveau ORDER BY niveau DESC LIMIT 1';
        $result = $this->createQuery($sql);
        $niveau = $result->fetch();
        $result->closeCursor();
        $this->idNiveau = $niveau['id'];
        $this->niveau = $niveau['niveau'];
    }
    
    /**
     * addNiveau
     *
     * Ajoute un niveau
     * 
     * @return void
     */
    public function addNiveau(){
        $sql = 'INSERT INTO niveau(niveau) VALUES (?)';
        return $this->createQuery($sql, [$this->niveau]);
        
    }

}