<?php

namespace App\plugins\galaxyInfinity\admin\src\model;

use App\config\ManagerBDD;

class ManagerAdminGITechnologie extends ManagerBDD
{
    function __construct($idTechnologie = null){
        $this->idTechno = null;
        $this->nomTechno = null;
        $this->descrTechno = null;
        $this->tierTechno = null;

        if($idTechnologie != null){
            $this->idTechno = $idTechnologie;

            $this->getTechnologieBaseById();
        }
   }
   
   /**
    * getTechnologieBaseById
    *
    *   Récupère les information de la technologie via son id
    *
    * @return void
    */
   public function getTechnologieBaseById(){
       $sql ='SELECT * FROM technologie WHERE id = ?';
       $result = $this->createQuery($sql,[$this->idTechno]);
       $result = $result->fetch();

       $this->nomTechno = $result['nom'];
       $this->descrTechno = $result['description'];
       $this->tierTechno = $result['tier'];
       $this->imageTechno = $result['image'];
   }
    
    /**
     * verifTechnologieExist
     * 
     * Vérifie si la technologie existe
     *
     * @return int
     */
    public function verifTechnologieExist(){
    
    $sql = 'SELECT id FROM technologie WHERE id = ?';
    $result = $this->createQuery($sql,[$this->idTechno]);
    return $result->rowCount();
    
    }
    
    /**
     * insertTechnologieBase
     * 
     * Ajoute la technologie de base
     *
     * @return bool
     */
    public function insertTechnologieBase(){
    
    $sql ='INSERT INTO technologie(nom,description,tier,image) VALUES(?,?,?,?)';
    return $this->createQuery($sql,[$this->nomTechno,$this->descrTechno,$this->tierTechno,$this->imageTechno]);
    
    }
    
    /**
     * getTechnologieBaseAdmin
     * 
     * Récupère toutes les technologies de base
     *
     * @return array
     */
    public function getTechnologieBaseAdmin(){

    $sql ='SELECT * FROM technologie ORDER BY tier DESC';
    $result = $this->createQuery($sql);
    return $result->fetchAll();
    
    }
    
    /**
     * supprTechnologieBase
     * 
     * Supprime la technologie de base
     *
     * @return bool
     */
    public function supprTechnologieBase(){

        $sql='DELETE FROM technologie WHERE id = ?';
        return $this->createQuery($sql,[$this->idTechno]);

    }
    
    /**
     * modifTechnologieBase
     * 
     * Modifie la technologie de base
     *
     * @return bool
     */
    public function modifTechnologieBase(){

        $sql='UPDATE technologie SET nom = ?, description = ?, tier = ? WHERE id = ?';
        return $this->createQuery($sql,[$this->nomTechno,$this->descrTechno,$this->tierTechno,$this->idTechno]);
        
    }

    
    /**
     * getTechnologieNiveauAdmin
     * 
     * Récupère tout les craft des technologies
     *
     * @return array
     */
    public function getTechnologieNiveauAdmin(){

        $sql = 'SELECT * FROM technologie_craft
                LEFT JOIN technologie ON technologie.id = technologie_craft.technologie_id
                LEFT JOIN craft ON craft.id = technologie_craft.craft_id
                LEFT JOIN items ON items.id = technologie_craft.items_id
         ORDER BY technologie_id DESC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * verifTechnologieCraftNiveauExist
     * 
     * Vérifie le craft existe pour la technologie
     *
     * @return int
     */
    public function verifTechnologieCraftNiveauExist(){
        $sql = 'SELECT craft_id, items_id FROM technologie_craft WHERE technologie_id = ? AND niveau_id = ? AND craft_id =? OR items_id =?';
        $result = $this->createQuery($sql,[$this->idTechno, $this->niveauTechno,$this->idCraft, $this->idItem]);
        return $result->rowCount();
    }
    
    /**
     * createTechnologieCraftNiveau
     * 
     * Ajoute le craft pour la technologie
     *
     * @return bool
     */
    public function createTechnologieCraftNiveau(){
        $sql = 'INSERT INTO technologie_craft(technologie_id,niveau_id,craft_id,nombre_craft,items_id,nombre_items) VALUES(?,?,?,?,?,?)';
        return $this->createQuery($sql,[$this->idTechno,$this->niveauTechno,$this->idCraft,$this->nombreCraft,$this->idItem,$this->nombreItem]);
        
    }
    
    /**
     * verifTechnologieCraftNiveauExistById
     *
     * Vérifie si le craft pour la technologie existe sous cet id
     * 
     * @return bool
     */
    public function verifTechnologieCraftNiveauExistById(){
        $sql = 'SELECT id FROM technologie_craft WHERE id= ?';
        return $this->createQuery($sql,[$this->idLigne]);
        
    }
    
    /**
     * supprTechnologieCraftNiveau
     * 
     * Supprime le craft pour la technologie
     *
     * @return bool
     */
    public function supprTechnologieCraftNiveau(){
        $sql = 'DELETE FROM technologie_craft WHERE id = ?';
        return $this->createQuery($sql,[$this->idLigne]);
       
    }
    
    /**
     * modifTechnologieCraftNiveau
     * 
     * Modifie le craft pour la technologie
     *
     * @return bool
     */
    public function modifTechnologieCraftNiveau(){
        
        $sql = 'UPDATE technologie_craft SET technologie_id = ?, niveau_id = ?, craft_id = ?,nombre_craft = ?,items_id = ?, nombre_items = ? WHERE id =?';
        return $this->createQuery($sql,[$this->idTechno, $this->niveauTechno,$this->idCraft,$this->nombreCraft,$this->idItem,$this->nombreItem,$this->idLigne]);
    }
    
    /**
     * getTechnologieTempsNiveauAdmin
     *
     * Récupère le temps de construction pour toutes les technologies/niveau
     * 
     * @return array
     */
    public function getTechnologieTempsNiveauAdmin(){
        $sql = 'SELECT * FROM technologie_niveau
                LEFT JOIN technologie ON technologie.id = technologie_niveau.technologie_id
         ORDER BY technologie_id ASC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }
    
    /**
     * verifTechnologieTempsNiveauExist
     *
     * Vérifie si une technologie a deja un temps de construction pour son niveau
     * 
     * @return int
     */
    public function verifTechnologieTempsNiveauExist(){
        $sql = 'SELECT technologie_id,niveau_id FROM technologie_niveau WHERE technologie_id = ? AND niveau_id = ?';
        $result = $this->createQuery($sql,[$this->idTechno,$this->niveauTechno]);
        return $result->rowCount();
    }
    
    /**
     * createTechnologieTempsNiveau
     * 
     * Créer le temps de construction pour la technologie/niveau
     *
     * @return bool
     */
    public function createTechnologieTempsNiveau(){
        $sql = 'INSERT INTO technologie_niveau(technologie_id,niveau_id,temps_construction)VALUES (?,?,?)';
        return $this->createQuery($sql,[$this->idTechno,$this->niveauTechno,$this->tempsConstruction]);
        
    }
    
    /**
     * supprTechnologieTempsNiveau
     * 
     * Supprime le temps de construction pour la technologie/niveau
     *
     * @return bool
     */
    public function supprTechnologieTempsNiveau(){
        $sql = 'DELETE FROM technologie_niveau WHERE technologie_id = ? AND niveau_id = ?';
        return $this->createQuery($sql,[$this->idTechno,$this->niveauTechno]);
        
    }
    
    /**
     * modifTechnologieTempsNiveau
     * 
     * Modifie le temps de construction pour la technologie/niveau
     *
     * @return bool
     */
    public function modifTechnologieTempsNiveau(){
        $sql ='UPDATE technologie_niveau SET technologie_id = ?, niveau_id = ?, temps_construction = ? WHERE technologie_id = ? AND niveau_id = ?';
        return $this->createQuery($sql,[$this->idTechno,$this->niveauTechno,$this->tempsConstruction,$this->idTechno,$this->niveauTechno]);
        
    }
    
    /**
     * getTechnologiePRAdmin
     *
     * Récupère les pré-requis des technologies
     * 
     * @return array
     */
    public function getTechnologiePRAdmin(){
        $sql = 'SELECT * FROM pre_requis_technologie
                LEFT JOIN technologie as technologieId ON technologieId.id = pre_requis_technologie.technologie_id
                LEFT JOIN batiment ON batiment.id = pre_requis_technologie.batiment_id_requis
                LEFT JOIN technologie as technologiePR ON technologiePR.id = pre_requis_technologie.technologie_id_requis
         ORDER BY technologie_id ASC';
        $result = $this->createQuery($sql);
        return $result->fetchAll();
    }

    
    /**
     * createTechnologiePR
     *
     * Ajoute le pré-requis de la technologie
     * 
     * @return bool
     */
    public function createTechnologiePR(){
       
        $sql = 'INSERT INTO pre_requis_technologie(technologie_id,batiment_id_requis,niveau_id_batiment,technologie_id_requis,niveau_id_technologie)VALUES (?,?,?,?,?)';
        return $this->createQuery($sql,[$this->idTechno,$this->idBatPR,$this->niveauBatPR,$this->idTechnoPR,$this->niveauTechnoPR]);
       
    }
    
    /**
     * verifTechnologiePRExistById
     * 
     * Vérifie si un pré-requis pour la technologie existe sous cet id
     *
     * @return int
     */
    public function verifTechnologiePRExistById(){
        
        $sql = 'SELECT id FROM pre_requis_technologie WHERE id = ?';
        
        $result = $this->createQuery($sql,[$this->idLigne]);
       
        return $result->rowCount();
    }
    
    /**
     * supprTechnologiePR
     * 
     * Supprime le pré-requis de la technologie
     *
     * @return void
     */
    public function supprTechnologiePR(){
        $sql= 'DELETE FROM pre_requis_technologie WHERE id = ?';
        return $this->createQuery($sql,[$this->idLigne]);
    
    }
    
    /**
     * modifTechnologiePR
     * 
     * Modifie le pré-requis de la technologie
     *
     * @return void
     */
    public function modifTechnologiePR(){
        
        $sql='UPDATE pre_requis_technologie SET technologie_id = ?, batiment_id_requis = ?, niveau_id_batiment = ?, technologie_id_requis = ?, niveau_id_technologie = ? WHERE id = ?';
        return $this->createQuery($sql,[$this->idTechno,$this->idBatPR,$this->niveauBatPR,$this->idTechnoPR,$this->niveauTechnoPR,$this->idLigne]);
        
    }


    
    public function getAllPlaneteActive(){
        $sql = 'SELECT * FROM planete WHERE situation != 0';
        $result =  $this->createQuery($sql);
        return $result->fetchAll();
    }

    public function getTechnoBaseByName(){
        $sql = 'SELECT * FROM technologie WHERE nom = ?';
        $result = $this->createQuery($sql,[$this->nomTechno]);
        return $result->fetch();
    }

    public function insertTechnoBasePlaneteX(){
        $sql = 'INSERT INTO batiment_technologie(niveau,planete_id,technologie_id) VALUES(0,?,?)';
        return $this->createQuery($sql,[$this->idPlanete,$this->idTechno]);
    }
}