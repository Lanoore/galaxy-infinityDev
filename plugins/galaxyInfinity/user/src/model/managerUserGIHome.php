<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGIHome extends ManagerBDD
{

    
    /**
     * getConstruCraftEnCours
     * 
     * Récupère la construction craft en cours
     *
     * @return array
     */
    public function getConstruCraftEnCours(){
        $sql = 'SELECT * FROM construction_craft_planete
                LEFT JOIN craft ON construction_craft_planete.craft_id = craft.id
        WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetch();
    }
    
    /**
     * getConstruBatEnCours
     * 
     * Récupère la construction du batiment en cours
     *
     * @return void
     */
    public function getConstruBatEnCours(){
        $sql = 'SELECT * FROM construction_batiment_planete 
                LEFT JOIN batiment ON construction_batiment_planete.batiment_id = batiment.id
        WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetch();
    }
    
    /**
     * getConstruTechnoEnCours
     * 
     * Récupère la construction de la technologie en cours
     *
     * @return void
     */
    public function getConstruTechnoEnCours(){
        $sql ='SELECT * FROM construction_technologie_planete
                LEFT JOIN technologie ON construction_technologie_planete.technologie_id = technologie.id
            WHERE planete_id = ?';
            $result = $this->createQuery($sql,[$this->idPlanete]);
            return $result->fetch();   
    }
    
    /**
     * getAllRessources
     * 
     * Récupères toutes les ressources
     *
     * @return void
     */
    public function getAllRessources(){
        $sql ='SELECT * FROM ressource_planete
               LEFT JOIN ressource ON ressource.id = ressource_planete.ressource_id
        WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetchAll();
    }

    
    /**
     * getAllBatPlaneteX
     * 
     * Récupère les batiments de la planete
     *
     * @return void
     */
    public function getAllBatPlaneteX(){
        $sql ='SELECT * FROM batiment_planete
               LEFT JOIN batiment ON batiment.id = batiment_planete.batiment_id
            WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetchAll();
    }
    
    /**
     * getAllCraftPlaneteX
     * 
     * Récupère les craft de la planete
     *
     * @return void
     */
    public function getAllCraftPlaneteX(){
        $sql='SELECT * FROM craft_planete
              LEFT JOIN craft ON craft.id = craft_planete.craft_id
            WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetchAll();
    }
    
    /**
     * getAllTechnoPlaneteX
     * 
     * Récupère les technologies de la planete
     *
     * @return void
     */
    public function getAllTechnoPlaneteX(){
        $sql ='SELECT * FROM technologie_planete
               LEFT JOIN technologie ON technologie.id = technologie_planete.technologie_id
            WHERE planete_id =?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetchAll();
    }

}