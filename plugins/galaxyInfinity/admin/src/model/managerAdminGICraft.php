<?php

namespace App\plugins\galaxyInfinity\admin\src\model;

use App\config\ManagerBDD;

class ManagerAdminGICraft extends ManagerBDD
{
    function __construct(){
        $this->idCraft = null;
        $this->nomCraft = null;
        $this->descrCraft = null;
        $this->tierCraft = null;
        $this->tempsBase = null;

    }
    
    /**
     * getCraftBaseById
     *
     * Récupère les informations de base du craft par rapport a son id
     * 
     * @return void
     */
    public function getCraftBaseById(){
        
        $sql = 'SELECT nom,description,tier,temps_base FROM craft WHERE id =?';
        $result = $this->createQuery($sql,[$this->idCraft]);
        $result = $result->fetch();
    
        $this->nomCraft = $result['nom'];
        $this->descrCraft = $result['description'];
        $this->tierCraft = $result['tier'];
        $this->tempsBase = $result['temps_base'];
        $this->imageCraft = $result['image'];
    }
           
       /**
        * verifCraftExist
        *
        * Vérfie si le craft existe deja 
        *
        * @return int
        */
       public function verifCraftExist(){
          
           $sql ='SELECT nom FROM craft WHERE nom = ?';
           $result = $this->createQuery($sql,[$this->nomCraft]);
           $result = $result->rowCount();

           $this->craftExist = $result;
       }
           
       /**
        * insertCraftBase
        *
        * Ajoute le craft de base dans la bdd
        *
        * @return bool
        */
       public function insertCraftBase(){
           $sql ='INSERT INTO craft(nom,description,tier,temps_base,image) VALUES(?,?,?,?,?)';
           return $this->createQuery($sql,[$this->nomCraft,$this->descrCraft,$this->tierCraft,$this->tempsCraft,$this->imageCraft]);
       }
    
              
       /**
        * getCraftBaseAdmin
        *
        * Récupère tout les crafts de base
        *
        * @return array
        */
       public function getCraftBaseAdmin(){
           
           $sql ='SELECT * FROM craft ORDER BY tier DESC';
           $result = $this->createQuery($sql);
           return $result->fetchAll();
       }
    
           
       /**
        * modifCraftBase
        *
        * Modifie le craft de base 
        *
        * @return bool
        */
       public function modifCraftBase(){
            $sql = 'UPDATE craft SET nom = ?, description = ?, tier = ?, temps_base = ? WHERE id = ?';
            return $this->createQuery($sql,[$this->nomCraft, $this->descrCraft,$this->tierCraft,$this->tempsCraft,$this->idCraft]);

        }
            
        /**
         * supprCraftBase
         *
         * Supprime le craft de base
         * 
         * @return bool
         */
        public  function supprCraftBase(){
            $sql = 'DELETE FROM craft WHERE id = ?';
            return $this->createQuery($sql,[$this->idCraft]);
        }
        
        /**
         * getCraftCraftAdmin
         * 
         *  Récupère tout les crafts des crafts
         * 
         * @return array
         */
        public function getCraftCraftAdmin(){
            $sql = 'SELECT * FROM craft_craft
                    LEFT JOIN craft as craftId ON craftId.id = craft_craft.craft_id
                    LEFT JOIN craft as craftIdRequis ON craftIdRequis.id = craft_craft.craft_id_travail
                    LEFT JOIN ressource ON ressource.id = craft_craft.ressource_id';
            $result = $this->createQuery($sql);
            return $result->fetchAll();
        }
        
        /**
         * verifCraftCraftExist
         * 
         * Vérifie si le craft du craft existe deja
         *
         * @return int
         */
        public function verifCraftCraftExist(){
            $sql = 'SELECT ressource_id, craft_id FROM craft_craft WHERE craft_id = ? AND ressource_id =? OR craft_id_travail =?';
            $result = $this->createQuery($sql,[$this->idCraft,$this->idRessource,$this->craftTravail]);
            return $result->rowCount();
        }
                
        /**
         * createCraftCraft
         *
         * Ajoute le craft du craft
         * 
         * @return bool
         */
        public function createCraftCraft(){
            $sql = 'INSERT INTO craft_craft(craft_id,ressource_id,nombre_ressource,craft_id_travail,nombre_craft_travail)VALUES(?,?,?,?,?)';
            return $this->createQuery($sql,[$this->idCraft,$this->idRessource,$this->nombreRessource,$this->craftTravail,$this->nombreCraftTravail]);
            
        }
        
        /**
         * verifExistCraftCraftById
         * 
         * Vérifie si un craft de craft existe sous cet id
         *
         * @return void
         */
        public function verifExistCraftCraftById(){
            $sql = 'SELECT id FROM craft_craft WHERE id = ?';
            $result = $this->createQuery($sql,[$this->idLigne]);
            return $result->rowCount();
        }
        
        /**
         * supprCraftCraft
         * 
         * Supprime le craft du craft
         *
         * @return void
         */
        public function supprCraftCraft(){
            $sql = 'DELETE FROM craft_craft WHERE id = ?';
            return $this->createQuery($sql,[$this->idLigne]);
            
        }
        
        /**
         * modifCraftCraft
         * 
         * Modifie le craft du craft
         *
         * @return void
         */
        public function modifCraftCraft(){
            $sql = 'UPDATE craft_craft SET craft_id = ?, ressource_id = ?, nombre_ressource = ?, craft_id_travail = ?,nombre_craft_travail =? WHERE id =?';
            return $this->createQuery($sql,[$this->idCraft,$this->idRessource,$this->nombreRessource,$this->craftTravail,$this->nombreCraftTravail,$this->idLigne]);
            
        }

        
        /**
         * getCraftPRAdmin
         *
         * Récupère tout les pré-requis des batiments
         * 
         * @return array
         */
        public function getCraftPRAdmin(){
            $sql = 'SELECT * FROM pre_requis_craft
                    LEFT JOIN craft ON craft.id = pre_requis_craft.craft_id
                    LEFT JOIN batiment ON batiment.id = pre_requis_craft.batiment_id_requis
                    LEFT JOIN technologie ON technologie.id = pre_requis_craft.technologie_id_requis
             ORDER BY craft_id ASC';
            $result = $this->createQuery($sql);
            return $result->fetchAll();
        }
            
            
        /**
         * createCraftPR
         * 
         * Créer le pré-requis du craft
         *
         * @return bool
         */
        public function createCraftPR(){
           
            $sql = 'INSERT INTO pre_requis_craft(craft_id,batiment_id_requis,niveau_id_batiment,technologie_id_requis,niveau_id_technologie)VALUES (?,?,?,?,?)';
            return $this->createQuery($sql,[$this->idCraft,$this->idBatPR,$this->niveauBatPR,$this->idTechnoPR,$this->niveauTechnoPR]);
           
            
        }
            
        /**
         * verifCraftPRExistById
         *
         * Vérifie si un pré-requis existe sous cet id
         * 
         * @return int
         */
        public function verifCraftPRExistById(){
            
            $sql = 'SELECT id FROM pre_requis_craft WHERE id = ?';
            
            $result = $this->createQuery($sql,[$this->idLigne]);
           
            return $result->rowCount();
        }
            
        /**
         * supprCraftPR
         * 
         * Supprime le pré-requis du craft
         *
         * @return bool
         */
        public function supprCraftPR(){
            $sql= 'DELETE FROM pre_requis_craft WHERE id = ?';
            return $this->createQuery($sql,[$this->idLigne]);
            
        }
            
        /**
         * modifCraftPR
         *
         * Modifie le pré-requis du craft
         * 
         * @return void
         */
        public function modifCraftPR(){
            
            $sql='UPDATE pre_requis_craft SET craft_id = ?, batiment_id_requis = ?, niveau_id_batiment = ?, technologie_id_requis = ?, niveau_id_technologie = ? WHERE id = ?';
            return $this->createQuery($sql,[$this->idCraft,$this->idBatPR,$this->niveauBatPR,$this->idTechnoPR,$this->niveauTechnoPR,$this->idLigne]);
            
        }


        public function getAllPlaneteActive(){
            $sql = 'SELECT * FROM planete WHERE situation != 0';
            $result =  $this->createQuery($sql);
            return $result->fetchAll();
        }
    
        public function getCraftBaseByName(){
            $sql = 'SELECT * FROM craft WHERE nom = ?';
            $result = $this->createQuery($sql,[$this->nomCraft]);
            return $result->fetch();
        }
    
        public function insertCraftBasePlaneteX(){
            $sql = 'INSERT INTO craft_planete(niveau,planete_id,craft_id) VALUES(0,?,?)';
            return $this->createQuery($sql,[$this->idPlanete,$this->idCraft]);
        }
}