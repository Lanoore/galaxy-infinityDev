


<div>
    <p><a href="index.php?admin=adminGestionView">Revenir à l'administration</a></p>

    <div class="createCraft">
        <div>
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
    </div>
</div>



<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">




<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="../plugins/forum/public/js/adminGestionForum.js"></script>