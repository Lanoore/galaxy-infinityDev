


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
            <h4>Création Batiment niveau</h4>
            <form action="index.php?galaxyInfinity=createBatNiveau" method="post">
                <div>
                    <label for = "idBat"> Id Batiment</label><br/>
                    <input type="number" id="idBat" name="idBat"> 
                </div>
                <div>
                    <label for="niveauBat">Niveau Batiment</label><br/>
                    <input type="number" id="niveauBat" name="niveauBat">
                </div>
                <div>
                    <label for="craftId">Craft Id</label><br/>
                    <input type="number" id="craftId" name="craftId">
                </div>
                <div>
                    <label for="nombreCraft">Nombre craft</label><br/>
                    <input type="number" id="nombreCraft" name="nombreCraft">
                </div>
                <div>
                    <label for="itemsId">Items Id</label><br/>
                    <input type="number" id="itemsId" name="itemsId">
                </div>
                <div>
                    <label for="nombreItems">Nombre items</label><br/>
                    <input type="number" id="nombreItems" name="nombreItems">
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>
        <div>
            <h4>Temps Construction Batiment par niveau</h4>
                <form action="index.php?galaxyInfinity=createTempsBatNiveau" method="post">
                    <div>
                        <label for = "idBat"> Id Batiment</label><br/>
                        <input type="number" id="idBat" name="idBat"> 
                    </div>
                    <div>
                        <label for="niveauBat">Niveau</label><br/>
                        <input type="number" id="niveauBat" name="niveauBat" >
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
                    <label for = "nom"> Nouveau nom de la catégorie</label><br/>
                    <input type="text" id="nom" name="nom" value=""> 
                </div>
                <div>
                    <label for="descr">Nouvelle description</label><br/>
                    <input type="text" id="descr" name="descr" value="">
                </div>
                <div>
                    <label for="tier">Tier du batiment</label><br/>
                    <input type="number" id="tier" name="tier" min="1" max="10" value="">
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
                                <td><?=$batNiveau['niveau'];?></td>
                                <td><?=$batNiveau['craft_id'];?></td>
                                <td><?=$batNiveau['nombre_craft'];?></td>
                                <td><?=$batNiveau['items_id'];?></td>
                                <td><?=$batNiveau['nombre_items'];?></td>
                                <td><form action="index.php?galaxyInfinity=supprBatNiveau&idLigne=<?=$batNiveau['id']?>" method="post"></input><input type="submit" name="Supprimer" value="Supprimer"></form></td>
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
                        <th>Nom Batiment</th>
                        <th>Niveau Batiment</th>
                        <th>Temps Construction</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($adminBatTempsNiveau as $batTemps){?>
                        <tr>
                            <td><?=$batTemps['nomBatiment']?></td>
                            <td><?=$batTemps['batiment_niveau']?></td>
                            <td><?=$batTemps['temps_construction']?></td>
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
