


<div>
    <p><a href="index.php?galaxyInfinity=afficheAdminGalaxyInfinityGestion">Revenir à l'administration</a></p>

    <div class="createCraft">
        <div>
            <h4>Création Craft Base</h4>
            <form action="index.php?galaxyInfinity=createCraftBase" method="post" enctype="multipart/form-data">
                <div>
                    <label for = "nomCraft"> Nom du craft</label><br/>
                    <input type="text" id="nomCraft" name="nomCraft"> 
                </div>
                <div>
                    <label for="descr">Description</label><br/>
                    <input type="text" id="descr" name="descr">
                </div>
                <div>
                    <label for="tier">Tier du craft</label><br/>
                    <input type="number" id="tier" name="tier" min="1" max="10">
                </div>
                <div>
                <label for="tempsCraft">Temps du craft</label><br/>
                    <input type="number" id='tempsCraft' name='tempsCraft'>
                </div>
                <div>
                    <label for="image">Image du craft</label><br/>
                    <input type="file" name ="image">
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
    </div>
    <div>
        <h4>Création Craft Craft</h4>
        <form action="index.php?galaxyInfinity=createCraftCraft" method='post'>
            <div>
                <label for="idCraft">Nom du craft</label><br/>
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
                <label for="idRessource">Nom ressource</label><br/>
                <select name="idRessource" id="idRessource">
                <option value="null"></option>
                <?php
                    foreach($ressources as $ressource){?>
                        <option value="<?=$ressource['id']?>"><?=$ressource['nom']?></option>
                <?php }
                ?>
                </select>
            </div>
            <div>
                <label for="nombreRessource">Nombre ressource</label><br/>
                <input type="number" id='nombreRessource' name='nombreRessource'>
            </div>
            <div>
                <label for="craftTravail">Nom du craft de travail</label><br/>
                <select name="craftTravail" id="craftTravail">
                <option value="null"></option>
                <?php
                    foreach($crafts as $craft){?>
                        <option value="<?=$craft['id']?>"><?=$craft['nom']?></option>
                <?php }
                ?>
                </select>
            </div>
            <div>
                <label for="nombreCraftTravail">Nombre Craft Travail</label><br/>
                <input type="number"  id='nombreCraftTravail' name='nombreCraftTravail'>
            </div>
            <div>
                <input type="submit">
            </div>
        </form>
    </div>
    <div>
            <h4>Pré requis Craft</h4>
                <form action="index.php?galaxyInfinity=createCraftPR" method="post">
                    <div>
                        <label for = "idCraft"> Nom Craft</label><br/>
                        <select name="idCraft" id="idCraft">
                        <option value=""></option>
                            <?php
                                foreach($crafts as $craft){?>
                                    <option value="<?=$craft['id']?>"><?=$craft['nom']?></option>
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
        </div>
        <div class="modifCraft">
            <div>
            <h4>Modification Craft</h4>
            <form action="index.php?galaxyInfinity=modifCraftBase" method='POST'>
                <div>
                    <label for="idCraft">Nom du craft a modifié</label><br/>
                    <select name="idCraft" id="idCraft">
                        <?php
                            foreach($crafts as $craft){?>
                                <option value="<?=$craft['id']?>"><?=$craft['nom']?></option>
                            <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="nomCraft">Nouveau nom du craft</label><br/>
                    <input type="text" id="nomCraft" name="nomCraft">
                </div>
                <div>
                    <label for="descr">Nouvelle description</label><br/>
                    <input type="text" id="descr" name="descr">
                </div>
                <div>
                    <label for="tier">Tier du craft</label><br/>
                    <input type="number" id="tier" name="tier" min="1" max="10">
                </div>
                <div>
                    <label for="tempsCraft">Temps du craft</label><br/>
                    <input type="number" id='tempsCraft' name='tempsCraft'>
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>
        <div>
            <h4>Modification Craft Craft</h4>
            <form action="index.php?galaxyInfinity=modifCraftCraft" method='post'>
                <div>
                    <label for="idLigne">Id de la ligne cible</label><br/>
                    <select name="idLigne" id="idLigne">
                    <option value="null"></option>
                    <?php
                        foreach($craftCrafts as $craft){?>
                            <option value="<?=$craft['id']?>"><?=$craft['id']?></option>
                    <?php }
                    ?>
                    </select>
                </div>
                <div>
                    <label for="idCraft">Nom du craft</label><br/>
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
                    <label for="idRessource">Nom ressource</label><br/>
                    <select name="idRessource" id="idRessource">
                    <option value="null"></option>
                    <?php
                        foreach($ressources as $ressource){?>
                            <option value="<?=$ressource['id']?>"><?=$ressource['nom']?></option>
                    <?php }
                    ?>
                    </select>
                </div>
                <div>
                    <label for="nombreRessource">Nombre ressource</label><br/>
                    <input type="number" id='nombreRessource' name='nombreRessource'>
                </div>
                <div>
                    <label for="craftTravail">Nom du craft de travail</label><br/>
                    <select name="craftTravail" id="craftTravail">
                    <option value="null"></option>
                    <?php
                        foreach($crafts as $craft){?>
                            <option value="<?=$craft['id']?>"><?=$craft['nom']?></option>
                    <?php }
                    ?>
                    </select>
                </div>
                <div>
                    <label for="nombreCraftTravail">Nombre Craft Travail</label><br/>
                    <input type="number"  id='nombreCraftTravail' name='nombreCraftTravail'>
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>
        <div>
                <h4>Modification Pré requis Craft</h4>
                    <form action="index.php?galaxyInfinity=modifCraftPR" method="post">
                        <div>
                            <label for="idLigne">Id de la ligne cible</label><br/>
                            <select name="idLigne" id="idLigne">
                                <option value=""></option>
                                <?php
                                    foreach($craftsPR as $craftPR){?>
                                        <option value="<?=$craftPR['id']?>"><?=$craftPR['id']?></option>
                                    <?php }
                                ?>
                            </select>
                        </div> 
                        <div>
                            <label for = "idCraft"> Nom Craft</label><br/>
                            <select name="idCraft" id="idCraft">
                            <option value=""></option>
                                <?php
                                    foreach($crafts as $craft){?>
                                        <option value="<?=$craft['id']?>"><?=$craft['nom']?></option>
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
         </div> 
    <div>
        <table class="dataTable">
        <h4>Craft de base</h4>
            <thead>
                <tr>
                    <th>Id du craft</th>
                    <th>Nom du craft</th>
                    <th>Description du craft</th>
                    <th>Tier du craft</th>
                    <th>Temps du craft</th>
                    <th>Image craft</th>
                    <th>Action ?</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($crafts as $craft) {?>
                        <tr>
                            <td><?=$craft['id']?></td>
                            <td><?=$craft['nom']?></td>
                            <td><?=$craft['description']?></td>
                            <td><?=$craft['tier']?></td>
                            <td><?=$craft['temps_base']?></td>
                            <td><?=$craft['image']?></td>
                            <td><form action="index.php?galaxyInfinity=supprCraftBase&idCraft=<?=$craft['id']?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                        </tr>
                     <?php   
                    }
                
                ?>
            </tbody>
        </table>
        
        <table class="dataTable">
            <thead>
                <tr>
                    <th>Id de la ligne</th>
                    <th>Nom du craft</th>
                    <th>Nom ressource</th>
                    <th>Nombre Ressource</th>
                    <th>Nom Craft Travail</th>
                    <th>Nombre craft travail</th>
                    <th>Action ?</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($craftCrafts as $craftCraft) {?>
                        <tr>
                            <td><?=$craftCraft[0]?></td>
                            <td><?=$craftCraft[7]?></td>
                            <td><?=$craftCraft[19]?></td>
                            <td><?=$craftCraft['nombre_ressource']?></td>
                            <td><?=$craftCraft[13]?></td>
                            <td><?=$craftCraft['nombre_craft_travail']?></td>
                            <td><form action="index.php?galaxyInfinity=supprCraftCraft&idLigne=<?=$craftCraft['id']?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                        </tr>
                     <?php   
                    }
                
                ?>
            </tbody>
        </table>
            <table class="dataTable">
            <h4>Craft pré-requis</h4>
                <thead>
                    <tr>
                        <th>Id de la ligne</th>
                        <th>Nom Craft</th>
                        <th>Nom Batiment PR</th>
                        <th>Niveau Batiment PR</th>
                        <th>Nom Technologie PR</th>
                        <th>Niveau Technologie PR</th>
                        <th>Action ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($craftsPR as $craftPR){?>
                        <tr>
                            <td><?=$craftPR[0]?></td>
                            <td><?=$craftPR[7]?></td>
                            <td><?=$craftPR[13]?></td>
                            <td><?=$craftPR['niveau_id_batiment']?></td>
                            <td><?=$craftPR[18]?></td>
                            <td><?=$craftPR['niveau_id_technologie']?></td>
                            <td><form action="index.php?galaxyInfinity=supprCraftPR&idLigne=<?=$craftPR['id']?>" method='post'><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                        </tr>
                  <?php  } ?>
                    
                </tbody>
            </table>
        </div>




<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">




<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="../plugins/galaxyInfinity/admin/public/js/adminGestionGalaxyInfinity.js"></script>