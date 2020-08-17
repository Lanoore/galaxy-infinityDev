


<div>
    <p><a href="index.php?galaxyInfinity=afficheAdminGalaxyInfinityGestion">Revenir à l'administration</a></p>

    <div class="createBat">
        <div>
            <h4>Création Batiment Base</h4>
            <form action="index.php?galaxyInfinity=createBatBase" method="post">
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
            <h4>Temps Construction Batiment par niveau</h4>
                <form action="index.php?galaxyInfinity=createBatTempsNiveau" method="post">
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
    </div>
    <div class="modifBat">
        <div>
            <h4>Modif Batiment Base</h4>
            <form action="index.php?galaxyInfinity=modifBatBase" method="post">
            <div>
                <label for="idBat">Nom du batiment a modifié</label>
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
                    <label for="idLigne">Id de la ligne cible</label>
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
    </div>            

    <div>
        <div>
            <table id="table_1">
                <thead>
                    <tr>
                        <th>Id du batiment</th>
                        <th>Nom batiment</th>
                        <th>Description batiment</th>
                        <th>Tier batiment</th>
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
                                <td><form action="index.php?galaxyInfinity=supprBatimentBase&idBatiment=<?=$batBase['id']?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                            </tr>
                        <?php   
                        }

                    ?>
                </tbody>
            </table>
        </div>
        <div>
            <table id="table_2">
                <thead>
                    <tr>
                        <th>Id Ligne</th>
                        <th>Batiment id</th>
                        <th>Niveau </th>
                        <th>Craft id</th>
                        <th>Nombre craft</th>
                        <th>Items id</th>
                        <th>Nombre items</th>
                        <th>Action ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($adminBatNiveau as $batNiveau) {?>
                            <tr>
                                <td><?=$batNiveau['id'];?></td>
                                <td><?=$batNiveau['batiment_id'];?></td>
                                <td><?=$batNiveau['niveau_id'];?></td>
                                <td><?=$batNiveau['craft_id'];?></td>
                                <td><?=$batNiveau['nombre_craft'];?></td>
                                <td><?=$batNiveau['items_id'];?></td>
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
            <table id="table_3">
                <thead>
                    <tr>
                        <th>id Batiment</th>
                        <th>Niveau Batiment</th>
                        <th>Temps Construction</th>
                        <th>Action ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($adminBatTempsNiveau as $batTemps){?>
                        <tr>
                            <td><?=$batTemps['batiment_id']?></td>
                            <td><?=$batTemps['niveau_id']?></td>
                            <td><?=$batTemps['temps_construction']?></td>
                            <td><form action="index.php?galaxyInfinity=supprBatTempsNiveau&idBatiment=<?=$batTemps['batiment_id']?>&idNiveau=<?=$batTemps['niveau_id']?>" method='post'><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                        </tr>
                  <?php  } ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">




<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="../plugins/forum/public/js/adminGestionForum.js"></script>
