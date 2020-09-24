

<div>
<p><a href="index.php?galaxyInfinity=afficheAdminGalaxyInfinityGestion">Revenir à l'administration</a></p>
    <div class="createRessource">
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
            <h4>Création Production Ressource batiment</h4>
            <form action="index.php?galaxyInfinity=createProdRessourceBat" method='post'>
                <div>
                    <label for="idBat">Nom batiment</label></br>
                    <select name="idBat" id="idBat">
                    <option value=""></option>
                      <?php  foreach($adminBatBase as $batBase){?>
                            <option value="<?=$batBase['id']?>"><?=$batBase['nom']?></option>
                      <?php }
                      ?>
                    </select>
                </div>
                <div>
                    <label for="idNiveau">Niveau</label></br>
                    <select name="idNiveau" id="idNiveau">
                        <option value=""></option>
                        <?php foreach ($niveaux as $niveau) {?>
                            <option value="<?=$niveau['id']?>"><?=$niveau['niveau']?></option>   
                       <?php }?>
                    </select>
                </div>
                <div>
                    <label for="idRessource">Nom ressource</label></br>
                    <select name="idRessource" id="idRessource">
                    <option value=""></option>
                    <?php
                        foreach($ressources as $ressource){?>
                            <option value="<?=$ressource['id']?>"><?=$ressource['nom']?></option>
                        <?php }
                    ?>
                </select>
                </div>
                <div>
                    <label for="prodBatNiveau">Production ressource par niveau</label></br>
                    <input type="number" name='prodBatNiveau' id='prodBatNiveau'>
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>
        <div>
            <h4>Création Ressource Liaison batiment</h4>
            <form action="index.php?galaxyInfinity=createLiaisonRessourceBat" method="post">
                <div>
                <label for="idRessource">Nom de la ressource</label></br>
                <select name="idRessource" id="idRessource">
                    <option value=""></option>
                    <?php
                        foreach($ressources as $ressource){?>
                            <option value="<?=$ressource['id']?>"><?=$ressource['nom']?></option>
                        <?php }
                    ?>
                </select>
                </div>
                <div>
                    <label for="idBat">Nom batiment</label></br>
                    <select name="idBat" id="idBat">
                    <option value=""></option>
                      <?php  foreach($adminBatBase as $batBase){?>
                            <option value="<?=$batBase['id']?>"><?=$batBase['nom']?></option>
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
    <div class='modifRessource'>
        <div>
            <h4>Modif Ressource Base</h4>
            <form action="index.php?galaxyInfinity=modifRessourceBase" method="post">
            <div>
                <label for="idRessource">Nom de la ressource a modifié</label></br>
                <select name="idRessource" id="idRessource">
                    <option value=""></option>
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
            <h4>Modification Production Ressource batiment</h4>
            <form action="index.php?galaxyInfinity=modifProdRessourceBat" method='post'>
                <div>
                    <label for="idBat">Nom batiment</label></br>
                    <select name="idBat" id="idBat">
                    <option value=""></option>
                      <?php  foreach($adminBatBase as $batBase){?>
                            <option value="<?=$batBase['id']?>"><?=$batBase['nom']?></option>
                      <?php }
                      ?>
                    </select>
                </div>
                <div>
                    <label for="idNiveau">Niveau</label></br>
                    <select name="idNiveau" id="idNiveau">
                        <option value=""></option>
                        <?php foreach ($niveaux as $niveau) {?>
                            <option value="<?=$niveau['id']?>"><?=$niveau['niveau']?></option>   
                       <?php }?>
                    </select>
                </div>
                <div>
                    <label for="idRessource">Nom ressource</label></br>
                    <select name="idRessource" id="idRessource">
                    <option value=""></option>
                    <?php
                        foreach($ressources as $ressource){?>
                            <option value="<?=$ressource['id']?>"><?=$ressource['nom']?></option>
                        <?php }
                    ?>
                </select>
                </div>
                <div>
                    <label for="prodBatNiveau">Production ressource par niveau</label></br>
                    <input type="number" name='prodBatNiveau' id='prodBatNiveau'>
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>
        <div>
            <h4>Modification Ressource Liaison batiment</h4>
            <form action="index.php?galaxyInfinity=modifLiaisonRessourceBat" method="post">
                <div>
                <label for="idRessource">Nom de la ressource</label></br>
                <select name="idRessource" id="idRessource">
                    <option value=""></option>
                    <?php
                        foreach($ressources as $ressource){?>
                            <option value="<?=$ressource['id']?>"><?=$ressource['nom']?></option>
                        <?php }
                    ?>
                </select>
                </div>
                <div>
                    <label for="idBat">Nom batiment</label></br>
                    <select name="idBat" id="idBat">
                    <option value=""></option>
                      <?php  foreach($adminBatBase as $batBase){?>
                            <option value="<?=$batBase['id']?>"><?=$batBase['nom']?></option>
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
        <div>
            <table class="dataTable">
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
        <div>
            <table class="dataTable">
                <thead>
                    <tr>
                        <th>Nom du batiment</th>
                        <th>Id niveau</th>
                        <th>Nom ressource</th>
                        <th>Prod Ressource par niveau</th>
                        <th>Action ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($prodRessources as $prodRessource) {?>
                            <tr>
                                <td><?=$prodRessource[5]?></td>
                                <td><?=$prodRessource['niveau_id']?></td>
                                <td><?=$prodRessource[10]?></td>
                                <td><?=$prodRessource['prod_ressource_niveau']?></td>
                                <td><form action="index.php?galaxyInfinity=supprProdRessourceBat&idRessource=<?=$prodRessource['ressource_id']?>&idNiveau=<?=$prodRessource['niveau_id']?>&idBatiment=<?=$prodRessource['batiment_id']?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                            </tr>
                        <?php   
                        }

                    ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="dataTable">
                <thead>
                    <tr>
                        <th>Nom de la ressource</th>
                        <th>Nom du batiment</th>
                        <th>Action ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($liaisonRessourceBat as $liaisonRessourceBat) {?>
                            <tr>
                                <td><?=$liaisonRessourceBat[3]?></td>
                                <td><?=$liaisonRessourceBat[8]?></td>

                                <td><form action="index.php?galaxyInfinity=supprLiaisonRessourceBat&idRessource=<?=$liaisonRessourceBat['ressource_id']?>&idBatiment=<?=$liaisonRessourceBat['batiment_id']?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                            </tr>
                        <?php   
                        }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">




<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="../plugins/galaxyInfinity/admin/public/js/adminGestionGalaxyInfinity.js"></script>