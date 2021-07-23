


<div>
    <p><a href="index.php?galaxyInfinity=afficheAdminGalaxyInfinityGestion">Revenir à l'administration</a></p>

    <div class="createBat">
        <div>
            <h4>Création Batiment Base</h4>
            <form action="index.php?galaxyInfinity=createBatBase" method="post" enctype="multipart/form-data">
                <div>
                    <label for = "nom"> Nom Batiment</label><br/>
                    <input type="text" id="nom" name="nom"> 
                </div>
                <div>
                    <label for="descr">Description</label><br/>
                    <input type="text" id="descr" name="descr" >
                </div>
                <div>
                    <label for="tier">Tier du batiment</label><br/>
                    <input type="number" id="tier" name="tier" min="1" max="10" >
                </div>
                <div>
                    <label for="image">Image du batiment</label><br/>
                    <input type="file" name ="image">
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>


        </div>
        <div>
            <h4>Création Batiment Craft Niveau</h4>
            <form action="index.php?galaxyInfinity=createBatCraftNiveau" method="post">
                <div>
                    <label for = "idBat"> Nom du batiment</label><br/>
                    <select name="idBat" id="idBat">
                    <option value="null"></option>
                        <?php
                            foreach ($adminBatBase as $batBase) {?>
                                <option value="<?=$batBase['id']?>"><?=$batBase['nom']?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="niveauBat">Niveau Batiment</label><br/>
                    <select name="niveauBat" id="niveauBat">
                    <option value="null"></option>
                        <?php
                            foreach($niveaux as $niveau){?>
                                <option value="<?=$niveau['id']?>"><?=$niveau['niveau']?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="idCraft">Nom Craft</label><br/>
                    <select name="idCraft" id="idCraft">
                    <option value="null"></option>
                    <?php
                        foreach($crafts as $craft){?>
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
                    <label for="idItem">Nom item</label><br/>
                    <select name="idItem" id="idItem">
                    <option value="null"></option>
                    <?php 
                        foreach($items as $item){?>
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
                    <input type="submit">
                </div>
            </form>
        </div>
        <div>
            <h4>Temps Construction Batiment par niveau</h4>
                <form action="index.php?galaxyInfinity=createBatTempsNiveau" method="post">
                    <div>
                        <label for = "idBat"> Id Batiment</label><br/>
                        <select name="idBat" id="idBat">
                        <option value="null"></option>
                            <?php
                                foreach($adminBatBase as $batBase){?>
                                    <option value="<?=$batBase['id']?>"><?=$batBase['nom']?></option>
                               <?php }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="niveauBat">Niveau</label><br/>
                        <select name="niveauBat" id="niveauBat">
                        <option value="null"></option>
                        <?php
                            foreach($niveaux as $niveau){?>
                                <option value="<?=$niveau['id']?>"><?=$niveau['niveau']?></option>
                           <?php }
                        ?>
                    </select>
                    </div>
                    <div>
                        <label for="tempsConstruction">Temps Construction</label><br/>
                        <input type="number" id="tempsConstruction" name="tempsConstruction" min="1">
                    </div>
                    <div>
                        <input type="submit">
                    </div>
                </form>
        </div>
        <div>
            <h4>Pré requis batiment</h4>
                <form action="index.php?galaxyInfinity=createBatPR" method="post">
                    <div>
                        <label for = "idBat"> Nom Batiment</label><br/>
                        <select name="idBat" id="idBat">
                        <option value=""></option>
                            <?php
                                foreach($adminBatBase as $batBase){?>
                                    <option value="<?=$batBase['id']?>"><?=$batBase['nom']?></option>
                               <?php }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for = "idBatPR"> Nom Batiment Pré requis</label><br/>
                        <select name="idBatPR" id="idBatPR">
                        <option value=""></option>
                            <?php
                                foreach($adminBatBase as $batBase){?>
                                    <option value="<?=$batBase['id']?>"><?=$batBase['nom']?></option>
                               <?php }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="niveauBatPR">Niveau Batiment Pré requis</label><br/>
                        <select name="niveauBatPR" id="niveauBatPR">
                        <option value=""></option>
                        <?php
                            foreach($niveaux as $niveau){?>
                                <option value="<?=$niveau['id']?>"><?=$niveau['niveau']?></option>
                           <?php }
                        ?>
                    </select>
                    </div>
                    <div>
                        <label for = "idTechnoPR"> Nom Technologie Pré Requis</label><br/>
                        <select name="idTechnoPR" id="idTechnoPR">
                        <option value=""></option>
                            <?php
                                foreach($technologies as $techno){?>
                                    <option value="<?=$techno['id']?>"><?=$techno['nom']?></option>
                               <?php }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="niveauTechnoPR">Niveau Technologie Pré requis</label><br/>
                        <select name="niveauTechnoPR" id="niveauTechnoPR">
                        <option value=""></option>
                        <?php
                            foreach($niveaux as $niveau){?>
                                <option value="<?=$niveau['id']?>"><?=$niveau['niveau']?></option>
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
            <h4>Création Batiment Start Planete</h4>
            <form action="index.php?galaxyInfinity=createBatStartPlanete" method="post">
                    <div>
                        <label for = "idBat"> Nom Batiment</label><br/>
                        <select name="idBat" id="idBat">
                        <option value=""></option>
                            <?php
                                foreach($adminBatBase as $batBase){?>
                                    <option value="<?=$batBase['id']?>"><?=$batBase['nom']?></option>
                               <?php }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="idNiveau">Niveau Batiment Start</label><br/>
                        <select name="idNiveau" id="idNiveau">
                        <option value=""></option>
                        <?php
                            foreach($niveaux as $niveau){?>
                                <option value="<?=$niveau['id']?>"><?=$niveau['niveau']?></option>
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
    <div class="modifBat">
        <div>
            <h4>Modif Batiment Base</h4>
            <form action="index.php?galaxyInfinity=modifBatBase" method="post">
            <div>
                <label for="idBat">Nom du batiment a modifié</label><br/>
                <select name="idBat" id="idBat">
                    <option value="null"></option>
                    <?php
                        foreach($adminBatBase as $bat){?>
                            <option value="<?=$bat['id']?>"><?=$bat['nom']?></option>
                        <?php }
                    ?>
                </select>
            </div>
                <div>
                    <label for = "nomBat"> Nouveau nom du batiment</label><br/>
                    <input type="text" id="nomBat" name="nomBat" > 
                </div>
                <div>
                    <label for="descr">Nouvelle description</label><br/>
                    <input type="text" id="descr" name="descr" >
                </div>
                <div>
                    <label for="tier">Tier du batiment</label><br/>
                    <input type="number" id="tier" name="tier" min="1" max="10" >
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>
        <div>
            <h4>Modif Batiment Craft Niveau</h4>
            <form action="index.php?galaxyInfinity=modifBatCraftNiveau" method="post">
                <div>
                    <label for="idLigne">Id de la ligne cible</label><br/>
                    <select name="idLigne" id="idLigne">
                        <option value="null"></option>
                        <?php
                            foreach($adminBatNiveau as $batNiveau){?>
                                <option value="<?=$batNiveau['id']?>"><?=$batNiveau['id']?></option>
                            <?php }
                        ?>
                    </select>
                </div> 
                <div>
                    <label for = "idBat"> Nom du batiment</label><br/>
                    <select name="idBat" id="idBat">
                        <option value="null"></option>
                        <?php
                            foreach ($adminBatBase as $bat) {?>
                                <option value="<?=$bat['id']?>"><?=$bat['nom']?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="niveauBat">Niveau Batiment</label><br/>
                    <select name="niveauBat" id="niveauBat">
                        <option value="null"></option>
                        <?php
                            foreach($niveaux as $niveau){?>
                                <option value="<?=$niveau['id']?>"><?=$niveau['niveau']?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="idCraft">Nom Craft</label><br/>
                    <select name="idCraft" id="idCraft">
                        <option value="null"></option>
                        <?php
                        foreach($crafts as $craft){?>
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
                    <label for="idItem">Nom item</label><br/>
                    <select name="idItem" id="idItem">
                        <option value="null"></option>
                        <?php 
                        
                        foreach($items as $item){?>
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
                    <input type="submit">
                </div>
            </form>
        </div>
        <div>
            <h4>Modif Temps Construction Batiment par niveau</h4>
                <form action="index.php?galaxyInfinity=modifBatTempsNiveau" method="post">
                    <div>
                        <label for = "idBat"> Id Batiment</label><br/>
                        <select name="idBat" id="idBat">
                        <option value="null"></option>
                            <?php
                                foreach($adminBatBase as $batBase){?>
                                    <option value="<?=$bat['id']?>"><?=$bat['nom']?></option>
                               <?php }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="niveauBat">Niveau</label><br/>
                        <select name="niveauBat" id="niveauBat">
                        <option value="null"></option>
                        <?php
                            foreach($niveaux as $niveau){?>
                                <option value="<?=$niveau['id']?>"><?=$niveau['niveau']?></option>
                           <?php }
                        ?>
                    </select>
                    </div>
                    <div>
                        <label for="tempsConstruction">Temps Construction</label><br/>
                        <input type="number" id="tempsConstruction" name="tempsConstruction" min="1">
                    </div>
                    <div>
                        <input type="submit">
                    </div>
                </form>
        </div>
        <div>
            <h4>Modification Pré requis batiment</h4>
                <form action="index.php?galaxyInfinity=modifBatPR" method="post">
                    <div>
                        <label for="idLigne">Id de la ligne cible</label><br/>
                        <select name="idLigne" id="idLigne">
                            <option value=""></option>
                            <?php
                                foreach($adminBatPR as $batPR){?>
                                    <option value="<?=$batPR['id']?>"><?=$batPR['id']?></option>
                                <?php }
                            ?>
                        </select>
                    </div> 
                    <div>
                        <label for = "idBat"> Nom Batiment</label><br/>
                        <select name="idBat" id="idBat">
                        <option value=""></option>
                            <?php
                                foreach($adminBatBase as $batBase){?>
                                    <option value="<?=$bat['id']?>"><?=$bat['nom']?></option>
                               <?php }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for = "idBatPR"> Nom Batiment Pré requis</label><br/>
                        <select name="idBatPR" id="idBatPR">
                        <option value=""></option>
                            <?php
                                foreach($adminBatBase as $batBase){?>
                                    <option value="<?=$batBase['id']?>"><?=$batBase['nom']?></option>
                               <?php }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="niveauBatPR">Niveau Batiment Pré requis</label><br/>
                        <select name="niveauBatPR" id="niveauBatPR">
                        <option value=""></option>
                        <?php
                            foreach($niveaux as $niveau){?>
                                <option value="<?=$niveau['id']?>"><?=$niveau['niveau']?></option>
                           <?php }
                        ?>
                    </select>
                    </div>
                    <div>
                        <label for = "idTechnoPR"> Nom Technologie Pré Requis</label><br/>
                        <select name="idTechnoPR" id="idTechnoPR">
                        <option value=""></option>
                            <?php
                                foreach($technologies as $techno){?>
                                    <option value="<?=$techno['id']?>"><?=$techno['nom']?></option>
                               <?php }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="niveauTechnoPR">Niveau Technologie Pré requis</label><br/>
                        <select name="niveauTechnoPR" id="niveauTechnoPR">
                        <option value=""></option>
                        <?php
                            foreach($niveaux as $niveau){?>
                                <option value="<?=$niveau['id']?>"><?=$niveau['niveau']?></option>
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
            <h4>Modification Batiment Start Planete</h4>
            <form action="index.php?galaxyInfinity=modifBatStartPlanete" method="post">
                    <div>
                        <label for = "idBat"> Nom Batiment</label><br/>
                        <select name="idBat" id="idBat">
                        <option value=""></option>
                            <?php
                                foreach($adminBatBase as $batBase){?>
                                    <option value="<?=$batBase['id']?>"><?=$batBase['nom']?></option>
                               <?php }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="idNiveau">Niveau Batiment Pré requis</label><br/>
                        <select name="idNiveau" id="idNiveau">
                        <option value=""></option>
                        <?php
                            foreach($niveaux as $niveau){?>
                                <option value="<?=$niveau['id']?>"><?=$niveau['niveau']?></option>
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

    <div class="tableGIBAdmin">
        <div>
            <table class="dataTable">
            <h4>Batiment de base</h4>
                <thead>
                    <tr>
                        <th>Id du batiment</th>
                        <th>Nom batiment</th>
                        <th>Description batiment</th>
                        <th>Tier batiment</th>
                        <th>Image Batiment</th>
                        <th>Action ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($adminBatBase as $batBase) {?>
                            <tr>
                                <td><?=$batBase['id']?></td>
                                <td><?=$batBase['nom']?></td>
                                <td><?=$batBase['description']?></td>
                                <td><?=$batBase['tier']?></td>
                                <td><?=$batBase['image']?></td>
                                <td><form action="index.php?galaxyInfinity=supprBatimentBase&idBatiment=<?=$batBase['id']?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                            </tr>
                        <?php   
                        }

                    ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="dataTable">
                <h4>Batiment craft par niveau</h4>
                <thead>
                    <tr>
                        <th>Id Ligne</th>
                        <th>Nom batiment</th>
                        <th>Niveau </th>
                        <th>Nom craft</th>
                        <th>Nombre craft</th>
                        <th>Nom items</th>
                        <th>Nombre items</th>
                        <th>Action ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($adminBatNiveau as $batNiveau) {?>
                            <tr>
                                <td><?=$batNiveau[0];?></td>
                                <td><?=$batNiveau[8];?></td>
                                <td><?=$batNiveau['niveau_id'];?></td>
                                <td><?=$batNiveau[13];?></td>
                                <td><?=$batNiveau['nombre_craft'];?></td>
                                <td><?=$batNiveau[19];?></td>
                                <td><?=$batNiveau['nombre_items'];?></td>
                                <td><form action="index.php?galaxyInfinity=supprBatCraftNiveau&idLigne=<?=$batNiveau['id']?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                            </tr>
                            <?php
                        }
                    
                    ?>
                </tbody>
            </table>
        </div>

        <div>
            <table class="dataTable">
                <h4>Batiment temps construction par niveau</h4>
                <thead>
                    <tr>
                        <th>Nom Batiment</th>
                        <th>Niveau Batiment</th>
                        <th>Temps Construction</th>
                        <th>Action ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($adminBatTempsNiveau as $batTemps){?>
                        <tr>
                            <td><?=$batTemps['nom']?></td>
                            <td><?=$batTemps['niveau_id']?></td>
                            <td><?=$batTemps['temps_construction']?></td>
                            <td><form action="index.php?galaxyInfinity=supprBatTempsNiveau&idBatiment=<?=$batTemps['batiment_id']?>&idNiveau=<?=$batTemps['niveau_id']?>" method='post'><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                        </tr>
                  <?php  } ?>
                    
                </tbody>
            </table>
        </div>
        <div>
            <table class="dataTable">
                <h4>Batiment pré_requis</h4>
                <thead>
                    <tr>
                        <th>Id de la ligne</th>
                        <th>Nom Batiment</th>
                        <th>Nom Batiment PR</th>
                        <th>Niveau Batiment PR</th>
                        <th>Nom Technologie PR</th>
                        <th>Niveau Technologie PR</th>
                        <th>Action ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($adminBatPR as $batPR){?>
                        <tr>
                            <td><?=$batPR[0]?></td>
                            <td><?=$batPR[7]?></td>
                            <td><?=$batPR[12]?></td>
                            <td><?=$batPR['niveau_id_batiment']?></td>
                            <td><?=$batPR[17]?></td>
                            <td><?=$batPR['niveau_id_technologie']?></td>
                            <td><form action="index.php?galaxyInfinity=supprBatPR&idLigne=<?=$batPR['id']?>" method='post'><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                        </tr>
                  <?php  } ?>
                    
                </tbody>
            </table>
        </div>
        <div>
            <table class="dataTable">
            <h4>Batiment de base au start de la planete</h4>
                <thead>
                    <tr>
                        <th>Nom Batiment</th>
                        <th>Niveau</th>
                        <th>Action ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($adminBatStartPlanete as $batStartPlanete){?>
                        <tr>
                            <td><?=$batStartPlanete['nom']?></td>
                            <td><?=$batStartPlanete['niveau_start_id']?></td>
                            <td><form action="index.php?galaxyInfinity=supprBatStartPlanete&idBatiment=<?=$batStartPlanete['batiment_id']?>" method='post'><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                        </tr>
                  <?php  } ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">




<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="plugins/galaxyInfinity/admin/public/js/adminGestionGalaxyInfinity.js"></script>
