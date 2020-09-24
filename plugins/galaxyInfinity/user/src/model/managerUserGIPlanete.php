<?php

namespace App\plugins\galaxyInfinity\user\src\model;

use App\config\ManagerBDD;

class ManagerUserGIPlanete extends ManagerBDD
{
    
    /**
     * getPlanete
     * 
     * Récupère les informations de la planete via son id
     *
     * @return void
     */
    public function getPlanete(){
        $sql ='SELECT * FROM planete WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        $result = $result->fetch();
        $this->systeme = $result['systeme'];
        $this->position = $result['position'];
        $this->lastActivite = $result['last_activite'];
    }

    
    /**
     * changeLastActivitePlanete
     * 
     * Change la dernière activite de la planete
     *
     * @return bool
     */
    public function changeLastActivitePlanete(){
        $sql = 'UPDATE planete SET last_activite = ? WHERE id = ?';
        return $result = $this->createQuery($sql,[$this->lastActivite, $this->idPlanete]);
    }
    
    /**
     * getBatimentProd
     * 
     *  Récupère les batiments de production
     *
     * @return array
     */
    public function getBatimentProd(){
        $sql ='SELECT * FROM batiment_prod_ressource';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * getNiveauBatiment
     * 
     * Récupère le batiment sélectionner 
     *
     * @return array
     */
    public function getNiveauBatiment(){
        $sql = 'SELECT * FROM batiment_planete WHERE planete_id = ? AND batiment_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete,$this->idBat]);
        return $result->fetch();
    }
    
    /**
     * getProdRessource
     * 
     * Récupère les prod des ressources 
     *
     * @return array
     */
    public function getProdRessource(){
        $sql = 'SELECT * FROM prod_ressources WHERE batiment_id = ? AND niveau_id = ?';
        $result = $this->createQuery($sql,[$this->idBat, $this->niveauBat]);
        return $result->fetch();
    }
    
    /**
     * getRessourcePlanete
     * 
     * Récupère les ressources de la planete
     *
     * @return array
     */
    public function getRessourcePlanete(){
        $sql = 'SELECT * FROM ressource_planete WHERE planete_id = ? AND ressource_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete, $this->idRessource]);
        return $result->fetch();
    }
    
    /**
     * changeNombreRessource
     * 
     * Change le nombre de ressource de la planete
     *
     * @return bool
     */
    public function changeNombreRessource(){
        $sql ='UPDATE ressource_planete SET nombre_ressource = ? WHERE planete_id = ? AND ressource_id = ?';
        return $result = $this->createQuery($sql,[$this->totalRessource,$this->idPlanete, $this->idRessource]);
        
    }
    
    /**
     * getConstruCraftEnCours
     * 
     * Récupère le craft en cours sur la planete
     *
     * @return array
     */
    public function getConstruCraftEnCours(){
        $sql = 'SELECT * FROM construction_craft_planete WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetch();
    }
    
    /**
     * addNombreCraftInPlanete
     * 
     * Met a jour le nombre de craft sur la planete
     *
     * @return bool
     */
    public function addNombreCraftInPlanete(){
        $sql = 'UPDATE craft_planete SET nombre_craft = ? WHERE planete_id = ? AND craft_id = ?';
        return $result =$this->createQuery($sql,[$this->nombreCraftTotal,$this->idPlanete, $this->idCraft]);
    }
        
    /**
     * getNbCraftActuel
     * 
     * Récupère le nombre de craft actuel sur la planete
     *
     * @return array
     */
    public function getNbCraftActuel(){
        $sql = 'SELECT * FROM craft_planete WHERE planete_id = ? AND craft_id = ?';
        $result =$this->createQuery($sql,[$this->idPlanete, $this->idCraft]);
        return $result->fetch();
    }
    
    /**
     * supprLigneCraftEnCoursPlanete
     * 
     * Supprime la ligne de craft en cours sur la planete
     *
     * @return bool
     */
    public function supprLigneCraftEnCoursPlanete(){
        $sql = 'DELETE FROM construction_craft_planete WHERE planete_id = ?';
        return $result = $this->createQuery($sql,[$this->idPlanete]);
    }
    
    /**
     * getConstruBatEnCours
     *
     * Récupère le batiment en cours de construction sur la planete
     * 
     * @return array
     */
    public function getConstruBatEnCours(){
        $sql = 'SELECT * FROM construction_batiment_planete WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetch();
    }
    
    /**
     * modifNiveauBatPlanete
     * 
     * Modifie le niveau du batiment sur la planete
     *
     * @return void
     */
    public function modifNiveauBatPlanete(){
        $sql ='UPDATE batiment_planete SET niveau = ? WHERE planete_id = ? AND batiment_id = ?';
        return $result = $this->createQuery($sql,[$this->niveauBatFinal,$this->idPlanete,$this->idBat]);    
    }
    
    /**
     * supprLigneBatEnCoursPlanete
     * 
     * Supprime la ligne de construction du batiment sur la planete
     *
     * @return void
     */
    public function supprLigneBatEnCoursPlanete(){
        $sql ='DELETE FROM construction_batiment_planete WHERE planete_id = ?';
        return $result = $this->createQuery($sql,[$this->idPlanete]);
    }
    
    /**
     * getConstruTechnoEnCours
     * 
     * Récupère la technologie en cours de construction sur la planete
     *
     * @return void
     */
    public function getConstruTechnoEnCours(){
        $sql = 'SELECT * FROM construction_technologie_planete WHERE planete_id = ?';
        $result = $this->createQuery($sql,[$this->idPlanete]);
        return $result->fetch();
    }
    
    /**
     * modifNiveauTechnoPlanete
     * 
     * Modifie le niveau de la tehcnologie sur la planete
     *
     * @return void
     */
    public function modifNiveauTechnoPlanete(){
        $sql ='UPDATE technologie_planete SET niveau = ? WHERE planete_id = ? AND technologie_id = ?';
        return $result = $this->createQuery($sql,[$this->niveauTechnoFinal,$this->idPlanete,$this->idTechno]);    
    }
    
    /**
     * supprLigneTechnoEnCoursPlanete
     * 
     * Supprime la ligne de construction de la technologie sur la planete
     *
     * @return void
     */
    public function supprLigneTechnoEnCoursPlanete(){
        $sql ='DELETE FROM construction_technologie_planete WHERE planete_id = ?';
        return $result = $this->createQuery($sql,[$this->idPlanete]);
    }

}