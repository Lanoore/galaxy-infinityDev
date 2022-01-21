<div>
    <p><a href="index.php?galaxyInfinity=afficheAdminGalaxyInfinityGestion">Revenir à l'administration</a></p>

    <div class="createMission">
        <div>
            <h4>Création Mission Base</h4>
            <form action="index.php?galaxyInfinity=createMissionBase" method="post" enctype="multipart/form-data">
                <div>
                    <label for = "nom"> Nom mission</label><br/>
                    <input type="text" id="nom" name="nom"> 
                </div>
                <div>
                    <label for="descr">Description mission</label><br/>
                    <input type="text" id="descr" name="descr" >
                </div>
                <div>
                    <label for="type">Type de mission</label><br/>
                    <input type="number" id="type" name="type" min="1" max="3" >
                </div>
                <div>
                    <label for="genre">Genre mission</label><br/>
                    <input type="number" name ="genre" min="1" max="2">
                </div>
                <div>
                    <label for="niveau">Niveau de la mission</label><br/>
                    <input type="number" name="niveau" min="1" max="10">
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>
        <div>
            <h4>Création Récompenses Mission Base</h4>
            <form action="index.php?galaxyInfinity=createRecompensesMissionBase" method="post" enctype="multipart/form-data">
                <div>
                    <label for = "idMission"> Nom mission</label><br/>
                    <select name="idMission" id="idMission">
                        <option value="null"></option>
                        <?php
                            foreach($adminMissionsBase as $mission){?>
                                <option value="<?=$mission['id']?>"><?=$mission['nom']?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="idItem">Nom items</label><br/>
                    <select name="idItem" id="idItem">
                        <option value="null"></option>
                        <?php
                            foreach($adminItems as $item){?>
                                <option value="<?=$item['id']?>"><?=$item['nom']?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="nombreItems">Nombre items</label><br/>
                    <input type="number" id="nombreItems" name="nombreItems" >
                </div>
                <div>
                    <label for="idRessource">Nom ressource</label><br/>
                    <select name="idRessource" id="idRessource">
                        <option value="null"></option>
                        <?php
                            foreach($adminRessource as $ressource){?>
                                <option value="<?=$ressource['id']?>"><?=$ressource['nom']?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="nombreRessource">Nombre ressource</label><br/>
                    <input type="number" id='nombreRessource' name="nombreRessource">
                </div>
                <div>
                    <label for="idCraft">Nom craft</label><br/>
                    <select name="idCraft" id="idCraft">
                        <option value="null"></option>
                        <?php
                            foreach($adminCraft as $craft){?>
                                <option value="<?=$craft['id']?>"><?=$craft['nom']?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="nombreCraft">Nombre craft</label><br/>
                    <input type="number" id="nombreCraft" name="nombreCraft">
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>
        <div>
            <h4>Création Pré requis Mission Base</h4>
            <form action="index.php?galaxyInfinity=createPreRequisMissionBase" method="post" enctype="multipart/form-data">
                <div>
                    <label for = "idMission"> Nom mission</label><br/>
                    <select name="idMission" id="idMission">
                        <option value="null"></option>
                        <?php
                            foreach($adminMissionsBase as $mission){?>
                                <option value="<?=$mission['id']?>"><?=$mission['nom']?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for = "idBat"> Nom batiment</label><br/>
                    <select name="idBat" id="idBat">
                        <option value="null"></option>
                        <?php
                            foreach($adminBat as $bat){?>
                                <option value="<?=$bat['id']?>"><?=$bat['nom']?></option>
                            <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="niveauBat">Niveau Bat</label><br/>
                    <input type="number" id="niveauBat" name="niveauBat">
                </div>
                <div>
                    <label for = "idPop"> Nom population</label><br/>
                    <select name="idPop" id="idPop">
                        <option value="null"></option>
                        <?php
                            foreach($adminPop as $pop){?>
                                <option value="<?=$pop['id']?>"><?=$pop['nom']?></option>
                            <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="nombrePop">Nombre population</label><br/>
                    <input type="number" id="nombrePop" name="nombrePop">
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>
    </div>
    <div class="modifMissions">
        <div>
            <h4>Modif Mission Base</h4>
            <form action="index.php?galaxyInfinity=modifMissionBase" method="post">
            <div>
                <label for="idMission">Nom de la mission a modifié</label>
                <select name="idMission" id="idMission">
                    <option value="null"></option>
                    <?php
                        foreach($adminMissionsBase as $mission){?>
                            <option value="<?=$mission['id']?>"><?=$mission['nom']?></option>
                        <?php }
                    ?>
                </select>
            </div>
                <div>
                    <label for = "nomMission"> Nouveau nom de la mission</label><br/>
                    <input type="text" id="nomMission" name="nomMission" > 
                </div>
                <div>
                    <label for="descr">Nouvelle description</label><br/>
                    <input type="text" id="descr" name="descr" >
                </div>
                <div>
                    <label for="type">Type de mission</label><br/>
                    <input type="number" id="type" name="type" min="1" max="3" >
                </div>
                <div>
                    <label for="genre">Genre mission</label><br/>
                    <input type="number" name ="genre" min="1" max="2">
                </div>
                <div>
                    <label for="niveau">Niveau de la mission</label><br/>
                    <input type="number" name="niveau" min="1" max="10">
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>
        <div>
            <h4>Modif Recompense Mission</h4>
            <form action="index.php?galaxyInfinity=modifRecompenseMissionBase" method="post">
                <div>
                    <label for="idLigne">Id de la ligne cible</label>
                    <select name="idLigne" id="idLigne">
                        <option value="null"></option>
                        <?php
                            foreach($adminRecompensesMissionBase as $recompenseMission){?>

                                <option value="<?=$recompenseMission[0]?>"><?=$recompenseMission[0]?></option>
                            <?php }
                        ?>
                    </select>
                </div> 
                <div>
                    <label for = "idMission"> Nom de la mission</label><br/>
                    <select name="idMission" id="idMission">
                        <option value="null"></option>
                        <?php
                            foreach ($adminMissionsBase as $mission) {?>
                                <option value="<?=$mission['id']?>"><?=$mission['nom']?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="idItem">Nom item</label><br/>
                    <select name="idItem" id="idItem">
                        <option value="null"></option>
                        <?php
                        foreach($adminItems as $item){?>
                            <option value="<?=$item['id']?>"><?=$item['nom']?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="nombreItem">Nombre item</label><br/>
                    <input type="number" id="nombreItem" name="nombreItem">
                </div>
                <div>
                    <label for="idRessource">Nom ressource</label><br/>
                    <select name="idRessource" id="idRessource">
                        <option value="null"></option>
                        <?php 
                        
                        foreach($adminRessource as $ressource){?>
                            <option value="<?=$ressource['id']?>"><?=$ressource['nom']?></option>
                       <?php }
                    ?>
                    </select>
                </div>
                <div>
                    <label for="nombreRessource">Nombre ressource</label><br/>
                    <input type="number" id="nombreRessource" name="nombreRessource">
                </div>
                <div>
                    <label for="idCraft">Nom craft</label><br/>
                    <select name="idCraft" id="idCraft">
                        <option value="null"></option>
                        <?php 
                        
                        foreach($adminCraft as $craft){?>
                            <option value="<?=$craft['id']?>"><?=$craft['nom']?></option>
                       <?php }
                    ?>
                    </select>
                </div>
                <div>
                    <label for="nombreCraft">Nombre craft</label><br/>
                    <input type="number" id="nombreCraft" name="nombreCraft">
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>
        <div>
            <h4>Modif Pre-requis Mission</h4>
            <form action="index.php?galaxyInfinity=modifPRMissionBase" method="post">
                <div>
                    <label for="idLigne">Id de la ligne cible</label>
                    <select name="idLigne" id="idLigne">
                        <option value="null"></option>
                        <?php
                            foreach($adminPreRequisMissionBase as $prMission){?>

                                <option value="<?=$prMission[0]?>"><?=$prMission[0]?></option>
                            <?php }
                        ?>
                    </select>
                </div> 
                <div>
                    <label for = "idMission"> Nom de la mission</label><br/>
                    <select name="idMission" id="idMission">
                        <option value="null"></option>
                        <?php
                            foreach ($adminMissionsBase as $mission) {?>
                                <option value="<?=$mission['id']?>"><?=$mission['nom']?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="idBat">Nom item</label><br/>
                    <select name="idBat" id="idBat">
                        <option value="null"></option>
                        <?php
                        foreach($adminBat as $bat){?>
                            <option value="<?=$bat['id']?>"><?=$bat['nom']?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="niveauBat">Niveau bat</label><br/>
                    <input type="number" id="niveauBat" name="niveauBat">
                </div>
                <div>
                    <label for="idPop">Nom population</label><br/>
                    <select name="idPop" id="idPop">
                        <option value="null"></option>
                        <?php 
                        
                        foreach($adminPop as $pop){?>
                            <option value="<?=$pop['id']?>"><?=$pop['nom']?></option>
                       <?php }
                    ?>
                    </select>
                </div>
                <div>
                    <label for="nombrePop">Nombre popuation</label><br/>
                    <input type="number" id="nombrePop" name="nombrePop">
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>
    </div>
    <div class="missionCMQuestion">
        <div>
            <h4>Création mission question</h4>
            <form action="index.php?galaxyInfinity=createMissionQuestion" method="post">
                <div>
                    <label for="idMission">Nom mission</label>
                    <select name="idMission" id="idMission">
                        <option value="null"></option>
                        <?php
                            foreach ($adminMissionsBase as $mission) {?>
                                <option value="<?=$mission['id']?>"><?=$mission['nom']?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="texteQuestionM">Question:</label>
                    <textarea name="texteQuestionM" id="" cols="30" rows="10"></textarea>
                </div>
                <div>
                    <label for="lastQuestion">Fin de la mission?</label>
                    <input type="checkbox" id="lastQuestion" name="lastQuestion">
                </div>
                <div>
                    <label for="firstQuestion">Première question?</label>
                    <input type="checkbox" id="firstQuestion" name="firstQuestion">
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>
        <div>
            <h4>Modif mission question</h4>
            <form action="index.php?galaxyInfinity=modifMissionQuestion" method="post">
                <div>
                    <label for="idLigne">Id de la ligne cible</label>
                    <select name="idLigne" id="idLigne">
                        <option value="null"></option>
                        <?php
                            foreach($adminQuestionMission as $question){?>

                                <option value="<?=$question[0]?>"><?=$question[0]?></option>
                            <?php }
                        ?>
                    </select>
                </div> 
                <div>
                    <label for="idMission">Nom mission</label>
                    <select name="idMission" id="idMission">
                        <option value="null"></option>
                        <?php
                            foreach ($adminMissionsBase as $mission) {?>
                                <option value="<?=$mission['id']?>"><?=$mission['nom']?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="texteQuestionM">Question:</label>
                    <textarea name="texteQuestionM" id="" cols="30" rows="10"></textarea>
                </div>
                <div>
                    <label for="lastQuestion">Fin de la mission?</label>
                    <input type="checkbox" id="lastQuestion" name="lastQuestion">
                </div>
                <div>
                    <label for="firstQuestion">Première question?</label>
                    <input type="checkbox" id="firstQuestion" name="firstQuestion">
                </div>
                <div>
                    <input type="submit">
                </div>
                </form>
        </div>
    </div>
    <div class="missionCMReponse">
        <div>
            <h4>Création mission reponse</h4>
            <form action="index.php?galaxyInfinity=createMissionReponse" method="post">
                <div>
                    <label for="idMission">Nom mission</label>
                    <select name="idMission" id="idMission">
                        <option value="null"></option>
                        <?php
                            foreach ($adminMissionsBase as $mission) {?>
                                <option value="<?=$mission['id']?>"><?=$mission['nom']?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="texteReponseM">reponse:</label>
                    <textarea name="texteReponseM" id="" cols="30" rows="10"></textarea>
                </div>
                <div>
                    <label for="idTexteQLien">Liaison Question</label>
                    <select name="idTexteQLien" id="idTexteQLien">
                        <option value="null"></option>
                        <?php
                            foreach ($adminQuestionMission as $question) {?>
                                <option value="<?=$question[0]?>"><?=$question[0]?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="idTexteQCible">Question cible</label>
                    <select name="idTexteQCible" id="idTexteQCible">
                        <option value="null"></option>
                        <?php
                            foreach ($adminQuestionMission as $question) {?>
                                <option value="<?=$question[0]?>"><?=$question[0]?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>
        <div>
            <h4>modif mission reponse</h4>
            <form action="index.php?galaxyInfinity=modifMissionReponse" method="post">
                <div>
                    <label for="idLigne">Id ligne</label>
                    <select name="idLigne" id="idLigne">
                        <option value="null"></option>
                        <?php
                            foreach ($adminReponseMission as $reponse) {?>
                                <option value="<?=$reponse[0]?>"><?=$reponse[0]?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="idMission">Nom mission</label>
                    <select name="idMission" id="idMission">
                        <option value="null"></option>
                        <?php
                            foreach ($adminMissionsBase as $mission) {?>
                                <option value="<?=$mission['id']?>"><?=$mission['nom']?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="texteReponseM">reponse:</label>
                    <textarea name="texteReponseM" id="" cols="30" rows="10"></textarea>
                </div>
                <div>
                    <label for="idTexteQLien">Liaison Question</label>
                    <select name="idTexteQLien" id="idTexteQLien">
                        <option value="null"></option>
                        <?php
                            foreach ($adminQuestionMission as $question) {?>
                                <option value="<?=$question[0]?>"><?=$question[0]?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="idTexteQCible">Question cible</label>
                    <select name="idTexteQCible" id="idTexteQCible">
                        <option value="null"></option>
                        <?php
                            foreach ($adminQuestionMission as $question) {?>
                                <option value="<?=$question[0]?>"><?=$question[0]?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>
    </div>
    <div class='tableGITAdmin'>
        <div>
            <table class="dataTable">
            <h4>Missions de base</h4>
                <thead>
                    <tr>
                        <th>Id de la Mission</th>
                        <th>Nom de la Mission</th>
                        <th>Description Mission</th>
                        <th>Type Mission</th>
                        <th>Genre Misssion</th>
                        <th>Niveau Mission</th>
                        <th>Action ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($adminMissionsBase as $missionBase) {?>
                            <tr>
                                <td><?=$missionBase['id']?></td>
                                <td><?=$missionBase['nom']?></td>
                                <td><?=$missionBase['description']?></td>
                                <td><?=$missionBase['type']?></td>
                                <td><?=$missionBase['genre']?></td>
                                <td><?=$missionBase['niveau']?></td>
                                <td><form action="index.php?galaxyInfinity=supprMissionBase&idMission=<?=$missionBase['id']?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                            </tr>
                        <?php   
                        }

                    ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="dataTable">
            <h4>Récompenses Missions de base</h4>
                <thead>
                    <tr>
                        <th>Id de la ligne</th>
                        <th>Nom de la Mission</th>
                        <th>Nom Items</th>
                        <th>Nombre Items</th>
                        <th>Nom Ressource</th>
                        <th>Nombre Ressource</th>
                        <th>Nom Craft</th>
                        <th>Nombre Craft</th>
                        <th>Action ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($adminRecompensesMissionBase as $recompensesMissionBase) {?>
                            <tr>
                                <td><?=$recompensesMissionBase[0]?></td>
                                <td><?=$recompensesMissionBase[9]?></td>
                                <td><?=$recompensesMissionBase[15]?></td>
                                <td><?=$recompensesMissionBase['nombre_items']?></td>
                                <td><?=$recompensesMissionBase[17]?></td>
                                <td><?=$recompensesMissionBase['nombre_ressource']?></td>
                                <td><?=$recompensesMissionBase[21]?></td>
                                <td><?=$recompensesMissionBase['nombre_craft']?></td>
                                <td><form action="index.php?galaxyInfinity=supprRecompensesMissionBase&idLigne=<?=$recompensesMissionBase[0]?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                            </tr>
                        <?php   
                        }

                    ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="dataTable">
                <h4>Pré-requis Mission de base</h4>
                    <thead>
                        <tr>
                            <th>Id de la ligne</th>
                            <th>Nom de la mission</th>
                            <th>Nom du batiment</th>
                            <th>Niveau du batiment</th>
                            <th>Nom de la population</th>
                            <th>Nombre population</th>
                            <th>Action ?</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($adminPreRequisMissionBase as $prMissionBase) {?>
                            <tr>
                                <td><?=$prMissionBase[0]?></td>
                                <td><?=$prMissionBase[7]?></td>
                                <td><?=$prMissionBase[13]?></td>
                                <td><?=$prMissionBase['niveau_bat']?></td>
                                <td><?=$prMissionBase[19]?></td>
                                <td><?=$prMissionBase['nombre_pop']?></td>
                                <td><form action="index.php?galaxyInfinity=supprPrMissionBase&idLigne=<?=$prMissionBase[0]?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                            </tr>
                        <?php   
                        }

                    ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="dataTable">
                <h4>Questions Mission</h4>
                    <thead>
                        <tr>
                            <th>Id de la ligne</th>
                            <th>Nom de la mission</th>
                            <th>Texte Question</th>
                            <th>Fin Mission?</th>
                            <th>Début Mission?</th>
                            <th>Action ?</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($adminQuestionMission as $questionMission) {?>
                            <tr>
                                <td><?=$questionMission[0]?></td>
                                <td><?=$questionMission[6]?></td>
                                <td><?=$questionMission[2]?></td>
                                <td><?=$questionMission[3]?></td>
                                <td><?=$questionMission[4]?></td>
                                <td><form action="index.php?galaxyInfinity=supprMissionQuestion&idLigne=<?=$questionMission[0]?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                            </tr>
                        <?php   
                        }

                    ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="dataTable">
                <h4>Reponses Mission</h4>
                    <thead>
                        <tr>
                            <th>Id de la ligne</th>
                            <th>Nom de la mission</th>
                            <th>Id Question</th>
                            <th>Texte Reponse</th>
                            <th>Cible Question</th>
                            <th>Action ?</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($adminReponseMission as $reponse) {?>
                            <tr>
                                <td><?=$reponse[0]?></td>
                                <td><?=$reponse[6]?></td>
                                <td><?=$reponse[2]?></td>
                                <td><?=$reponse[4]?></td>
                                <td><?=$reponse[3]?></td>
                                <td><form action="index.php?galaxyInfinity=supprMissionReponse&idLigne=<?=$reponse[0]?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                            </tr>
                        <?php   
                        }

                    ?>
                </tbody>
            </table>
        </div>
</div>



<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">




<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="plugins/galaxyInfinity/admin/public/js/adminGestionGalaxyInfinity.js"></script>