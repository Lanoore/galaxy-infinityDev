<?php

namespace App\plugins\galaxyInfinity\admin\src\model;

use App\config\ManagerBDD;

class ManagerAdminGIBatiment extends ManagerBDD
{
    function __construct($idBatiment = null){
        $this->idBat = null;
        $this->nomBat = null;
        $this->descrBat = null;
        $this->tierBat = null;

        if($idBatiment != null){
            $this->idBat = $idBatiment;

            $this->getBatBaseById();
        }
   }
   
   /**
    * getBatBaseById
    *
    * Récupère les informations d'un batiment de base par rapport a son id
    *
    * @return void
    */
   public function getBatBaseById(){
       $sql ='SELECT * FROM batiment WHERE id = ?';
       $result = $this->createQuery($sql,[$this->idBat]);
       $result = $result->fetch();

       $this->nomBat = $result['nom'];
       $this->descrBat = $result['description'];
       $this->tierBat = $result['tier'];
       $this->imageBat = $result['image'];
       
   }
    
    /**
     * verifBatExist
     *
     * Vérifie si le batiment existe
     * @return int
     */
    public function verifBatExist(){
        $sql = 'SELECT id FROM batiment WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idBat]);
        return $result->rowCount();
    }
    
    /**
     * insertBatBase
     * 
     * Ajoute le batiment de base dans la bdd
     *
     * @return bool
     */
    public function insertBatBase(){
        $sql ='INSERT INTO batiment(nom,description,tier,image) VALUES(?,?,?,?)';
        return $this->createQuery($sql,[$this->nomBat,$this->descrBat,$this->tierBat, $this->imageBat]);
    }
    
    /**
     * getBatBaseAdmin
     *
     * Récupère tout les batiments de base 
     * 
     * @return array
     */
    public function getBatBaseAdmin(){
        $sql ='SELECT * FROM batiment ORDER BY tier DESC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * supprBatBase
     *
     * Supprime le batiment de base
     * 
     * @return bool
     */
    public function supprBatBase(){
        $sql='DELETE FROM batiment WHERE id = ?';
        return $this->createQuery($sql,[$this->idBat]);
    }
    
    /**
     * modifBatBase
     * 
     * Modifie le batiment de base
     *
     * @return bool
     */
    public function modifBatBase(){
        $sql='UPDATE batiment SET nom = ?, description = ?, tier = ? WHERE id = ?';
        return $this->createQuery($sql,[$this->nomBat,$this->descrBat, $this->tierBat,$this->idBat]);
    }

    
    /**
     * getBatNiveauAdmin
     *  
     * Récupère tout les craft des batiments 
     *
     * @return array
     */
    public function getBatNiveauAdmin(){

        $sql = 'SELECT * FROM batiment_craft
                LEFT JOIN batiment ON batiment_craft.batiment_id = batiment.id
                LEFT JOIN craft ON batiment_craft.craft_id = craft.id
                LEFT JOIN items ON batiment_craft.items_id = items.id
         ORDER BY batiment_id DESC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * verifBatCraftNiveauExist
     *
     * Vérifie si un craft du batiment existe 
     * 
     * @return int
     */
    public function verifBatCraftNiveauExist(){
        $sql = 'SELECT craft_id, items_id FROM batiment_craft WHERE batiment_id = ? AND niveau_id = ? AND craft_id =? OR items_id =?';
        $result = $this->createQuery($sql,[$this->idBat, $this->niveauBat,$this->idCraft, $this->idItem]);
        return $result->rowCount();
    }
    
    /**
     * createBatCraftNiveau
     * 
     * Ajoute le craft du batiment
     *
     * @return bool
     */
    public function createBatCraftNiveau(){
        $sql = 'INSERT INTO batiment_craft(batiment_id,niveau_id,craft_id,nombre_craft,items_id,nombre_items) VALUES(?,?,?,?,?,?)';
        return $this->createQuery($sql,[$this->idBat,$this->niveauBat,$this->idCraft,$this->nombreCraft,$this->idItem,$this->nombreItem]);
    }
    
    /**
     * verifBatCraftNiveauExistById
     *
     *  Vérifie si un craft de batiment existe sous cet id
     * 
     * @return bool
     */
    public function verifBatCraftNiveauExistById(){
        $sql = 'SELECT id FROM batiment_craft WHERE id= ?';
       return $this->createQuery($sql,[$this->idLigne]);
        
    }
    
    /**
     * supprBatCraftNiveau
     *
     * Supprime le craft du batiment
     * 
     * @return bool
     */
    public function supprBatCraftNiveau(){
        $sql = 'DELETE FROM batiment_craft WHERE id = ?';
        return $this->createQuery($sql,[$this->idLigne]);
        
    }
    
    /**
     * modifBatCraftNiveau
     *
     * Modifie le craft du batiment
     * 
     * @return bool
     */
    public function modifBatCraftNiveau(){
        $sql = 'UPDATE batiment_craft SET batiment_id = ?, niveau_id = ?, craft_id = ?,nombre_craft = ?,items_id = ?, nombre_items = ? WHERE id =?';
        return $this->createQuery($sql,[$this->idBat, $this->niveauBat,$this->idCraft,$this->nombreCraft,$this->idItem,$this->nombreItem,$this->idLigne]);
    }
    
    /**
     * getBatTempsNiveauAdmin
     * 
     * Récupère le temps de construction de tout les niveaux des batiments
     *
     * @return array
     */
    public function getBatTempsNiveauAdmin(){
        $sql = 'SELECT * FROM batiment_niveau
                LEFT JOIN batiment ON batiment.id = batiment_niveau.batiment_id
         ORDER BY batiment_id ASC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * verifBatTempsNiveauExist
     *
     * Vérifie si un batiment/niveau est déja lier a un temps de construction
     * 
     * @return int
     */
    public function verifBatTempsNiveauExist(){
        $sql = 'SELECT batiment_id,niveau_id FROM batiment_niveau WHERE batiment_id = ? AND niveau_id = ?';
        $result = $this->createQuery($sql,[$this->idBat,$this->niveauBat]);
        return $result->rowCount();
    }
    
    /**
     * createBatTempsNiveau
     * 
     * Ajoute le temps de construction pour le batiment/niveau
     *
     * @return bool
     */
    public function createBatTempsNiveau(){
        $sql = 'INSERT INTO batiment_niveau(batiment_id,niveau_id,temps_construction)VALUES (?,?,?)';
        return $this->createQuery($sql,[$this->idBat,$this->niveauBat,$this->tempsConstruction]);
        
    }
    
    /**
     * supprBatTempsNiveau
     *
     * Supprime le temps de construction pour le batiment/niveau
     * 
     * @return bool
     */
    public function supprBatTempsNiveau(){
        $sql = 'DELETE FROM batiment_niveau WHERE batiment_id = ? AND niveau_id = ?';
        return $this->createQuery($sql,[$this->idBat,$this->niveauBat]);
    }
    
    /**
     * modifBatTempsNiveau
     *
     * Modifie le temps de construction pour le batiment/niveau
     * 
     * @return bool
     */
    public function modifBatTempsNiveau(){
        $sql ='UPDATE batiment_niveau SET batiment_id = ?, niveau_id = ?, temps_construction = ? WHERE batiment_id = ? AND niveau_id = ?';
        return $this->createQuery($sql,[$this->idBat,$this->niveauBat,$this->tempsConstruction,$this->idBat,$this->niveauBat]);
    }
    
    /**
     * getBatPRAdmin
     *
     * Récupère tout les pré-requis des batiments
     * 
     * @return array
     */
    public function getBatPRAdmin(){
        $sql = 'SELECT * FROM pre_requis_batiment
                LEFT JOIN batiment as batId ON batId.id = pre_requis_batiment.batiment_id
                LEFT JOIN batiment as batIdRequis ON batIdRequis.id = pre_requis_batiment.batiment_id_requis
                LEFT JOIN technologie ON technologie.id = pre_requis_batiment.technologie_id_requis
         ORDER BY batiment_id ASC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    
    /**
     * createBatPR
     *
     * Créer le pré-requis d'un batiment
     * 
     * @return bool
     */
    public function createBatPR(){
       
        $sql = 'INSERT INTO pre_requis_batiment(batiment_id,batiment_id_requis,niveau_id_batiment,technologie_id_requis,niveau_id_technologie)VALUES (?,?,?,?,?)';
        return $this->createQuery($sql,[$this->idBat,$this->idBatPR,$this->niveauBatPR,$this->idTechnoPR,$this->niveauTechnoPR]);
       
        
    }
    
    /**
     * verifBatPRExistById
     *
     * Vérifie si un pré-requis existe sous cet id
     * 
     * @return int
     */
    public function verifBatPRExistById(){
        $sql = 'SELECT id FROM pre_requis_batiment WHERE id = ?';
        $result = $this->createQuery($sql,[$this->idLigne]);
        return $result->rowCount();
    }
    
    /**
     * supprBatPR
     * 
     * Supprimer le pré-requis du batiment
     *
     * @return bool
     */
    public function supprBatPR(){
        $sql= 'DELETE FROM pre_requis_batiment WHERE id = ?';
        return $this->createQuery($sql,[$this->idLigne]);

    }
    
    /**
     * modifBatPR
     * 
     * Modifie le pré-requis du batiment
     *
     * @return bool
     */
    public function modifBatPR(){
        $sql='UPDATE pre_requis_batiment SET batiment_id = ?, batiment_id_requis = ?, niveau_id_batiment = ?, technologie_id_requis = ?, niveau_id_technologie = ? WHERE id = ?';
        return $this->createQuery($sql,[$this->idBat,$this->idBatPR,$this->niveauBatPR,$this->idTechnoPR,$this->niveauTechnoPR,$this->idLigne]);
        
    }
    
    /**
     * getBatStartPlanete
     *
     * Récupère les batiments au start de la planete
     * 
     * @return array
     */
    public function getBatStartPlanete(){
        $sql = 'SELECT * FROM bat_start_planete
                LEFT JOIN batiment ON batiment.id= bat_start_planete.batiment_id';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * verifBatStartPlaneteExist
     *
     * Vérifie si un batiment existe deja dans la liste des batiments au start
     * 
     * @return int
     */
    public function verifBatStartPlaneteExist(){
        $sql = 'SELECT batiment_id FROM bat_start_planete WHERE batiment_id = ?';
        $result = $this->createQuery($sql,[$this->idBat]);
        return $result->rowCount();
    }
    
    /**
     * createBatStartPlanete
     *
     * Ajoute le batiment dans les batiments au start
     * 
     * @return bool
     */
    public function createBatStartPlanete(){
        $sql = 'INSERT INTO bat_start_planete(batiment_id,niveau_start_id) VALUES(?,?)';
        return $this->createQuery($sql,[$this->idBat,$this->idNiveau]);
        
    }
    
    /**
     * supprBatStartPlanete
     * 
     * Supprime le batiment dans les batiments au start
     *
     * @return bool
     */
    public function supprBatStartPlanete(){
        $sql = 'DELETE FROM bat_start_planete WHERE batiment_id = ?';
       return $this->createQuery($sql,[$this->idBat]);
        
    }
    
    /**
     * modifBatStartPlanete
     * 
     * Modifie le batiment dans les batiments au start
     *
     * @return bool
     */
    public function modifBatStartPlanete(){
        $sql = 'UPDATE bat_start_planete SET batiment_id = ?, niveau_start_id = ?';
        return $this->createQuery($sql,[$this->idBat, $this->idNiveau]);
        
    }

    public function getAllPlaneteActive(){
        $sql = 'SELECT * FROM planete WHERE situation != 0';
        $result =  $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function getBatBaseByName(){
        $sql = 'SELECT * FROM batiment WHERE nom = ?';
        $result = $this->createQuery($sql,[$this->nomBat]);
        return $result->fetch();
    }

    public function insertBatBasePlaneteX(){
        $sql = 'INSERT INTO batiment_planete(niveau,planete_id,batiment_id) VALUES(0,?,?)';
        return $this->createQuery($sql,[$this->idPlanete,$this->idBat]);
    }

}