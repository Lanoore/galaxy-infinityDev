


<div>
    <p><a href="index.php?galaxyInfinity=afficheAdminGalaxyInfinityGestion">Revenir à l'administration</a></p>

    <div class="createCraft">
            <h4>Création Craft Base</h4>
            <form action="index.php?galaxyInfinity=createCraftBase" method="post">
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
                <label for="tempsCraft">Temps du craft</label>
                    <input type="number" id='tempsCraft' name='tempsCraft'>
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
                <label for="idCraft">Nom du craft</label>
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
                <label for="idRessource">Nom ressource</label>
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
                <label for="nombreRessource">Nombre ressource</label>
                <input type="number" id='nombreRessource' name='nombreRessource'>
            </div>
            <div>
                <label for="craftTravail">Nom du craft de travail</label>
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
                <label for="nombreCraftTravail">Nombre Craft Travail</label>
                <input type="number"  id='nombreCraftTravail' name='nombreCraftTravail'>
            </div>
            <div>
                <input type="submit">
            </div>
        </form>
    </div>
    <div>
        <h4>Modification Craft</h4>
        <form action="index.php?galaxyInfinity=modifCraftBase" method='POST'>
            <div>
                <label for="idCraft">Nom du craft a modifié</label>
                <select name="idCraft" id="idCraft">
                    <?php
                        foreach($crafts as $craft){?>
                            <option value="<?=$craft['id']?>"><?=$craft['nom']?></option>
                        <?php }
                    ?>
                </select>
            </div>
            <div>
                <label for="nomCraft">Nouveau nom du craft</label>
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
                <label for="tempsCraft">Temps du craft</label>
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
                <label for="idLigne">Id de la ligne cible</label>
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
                <label for="idCraft">Nom du craft</label>
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
                <label for="idRessource">Nom ressource</label>
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
                <label for="nombreRessource">Nombre ressource</label>
                <input type="number" id='nombreRessource' name='nombreRessource'>
            </div>
            <div>
                <label for="craftTravail">Nom du craft de travail</label>
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
                <label for="nombreCraftTravail">Nombre Craft Travail</label>
                <input type="number"  id='nombreCraftTravail' name='nombreCraftTravail'>
            </div>
            <div>
                <input type="submit">
            </div>
        </form>
    </div>
    <div>
        <table id="table_1">
            <thead>
                <tr>
                    <th>Id du craft</th>
                    <th>Nom du craft</th>
                    <th>Description du craft</th>
                    <th>Tier du craft</th>
                    <th>Temps du craft</th>
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
                            <td><form action="index.php?galaxyInfinity=supprCraftBase&idCraft=<?=$craft['id']?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                        </tr>
                     <?php   
                    }
                
                ?>
            </tbody>
        </table>
        <table id="table_2">
            <thead>
                <tr>
                    <th>Id de la ligne</th>
                    <th>Id du craft</th>
                    <th>Id ressource</th>
                    <th>Nombre Ressource</th>
                    <th>Id Craft Travail</th>
                    <th>Nombre craft travail</th>
                    <th>Action ?</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($craftCrafts as $craftCraft) {?>
                        <tr>
                            <td><?=$craftCraft['id']?></td>
                            <td><?=$craftCraft['craft_id']?></td>
                            <td><?=$craftCraft['ressource_id']?></td>
                            <td><?=$craftCraft['nombre_ressource']?></td>
                            <td><?=$craftCraft['craft_id_travail']?></td>
                            <td><?=$craftCraft['nombre_craft_travail']?></td>
                            <td><form action="index.php?galaxyInfinity=supprCraftCraft&idLigne=<?=$craftCraft['id']?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
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
<script src="../plugins/galaxyInfinity/admin/public/js/adminGestionGalaxyInfinity.js"></script>