

<div>

        <div>
            <h4>Création Ressource Base</h4>
            <form action="index.php?galaxyInfinity=createRessourceBase" method="post">
                <div>
                    <label for = "nom"> Nom Ressource</label><br/>
                    <input type="text" id="nom" name="nom"> 
                </div>
                <div>
                    <label for="descr">Description</label><br/>
                    <input type="text" id="descr" name="descr" >
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>

        <div>
            <h4>Modif Ressource Base</h4>
            <form action="index.php?galaxyInfinity=modifRessourceBase" method="post">
            <div>
                <label for="idRessource">Nom de la ressource a modifié</label>
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
                    <label for = "nom"> Nouveau nom de la ressource</label><br/>
                    <input type="text" id="nom" name="nom" > 
                </div>
                <div>
                    <label for="descr">Nouvelle description</label><br/>
                    <input type="text" id="descr" name="descr" >
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
                        <th>Id de la ressource</th>
                        <th>Nom de la ressource</th>
                        <th>Description batiment</th>
                        <th>Action ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($ressources as $ressource) {?>
                            <tr>
                                <td><?=$ressource['id']?></td>
                                <td><?=$ressource['nom']?></td>
                                <td><?=$ressource['description']?></td>
                                <td><form action="index.php?galaxyInfinity=supprRessourceBase&idRessource=<?=$ressource['id']?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
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