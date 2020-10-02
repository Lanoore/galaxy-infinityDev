


<div>
    <p><a href="index.php?galaxyInfinity=afficheAdminGalaxyInfinityGestion">Revenir à l'administration</a></p>

    <div class="createTechno">
        <div>
            <h4>Création Technologie Base</h4>
            <form action="index.php?galaxyInfinity=createTechnologieBase" method="post" enctype="multipart/form-data">
                <div>
                    <label for = "nom"> Nom Technologie</label><br/>
                    <input type="text" id="nom" name="nom"> 
                </div>
                <div>
                    <label for="descr">Description</label><br/>
                    <input type="text" id="descr" name="descr" >
                </div>
                <div>
                    <label for="tier">Tier de la technologie</label><br/>
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
            <h4>Création Technologie Craft Niveau</h4>
            <form action="index.php?galaxyInfinity=createTechnologieCraftNiveau" method="post">
                <div>
                    <label for = "idTechno"> Nom du Technologie</label><br/>
                    <select name="idTechno" id="idTechno">
                    <option value="null"></option>
                        <?php
                            foreach ($adminTechnologieBase as $techno) {?>
                                <option value="<?=$techno['id']?>"><?=$techno['nom']?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="niveauTechno">Niveau Technologie</label><br/>
                    <select name="niveauTechno" id="niveauTechno">
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
            <h4>Temps Construction Technologie par niveau</h4>
                <form action="index.php?galaxyInfinity=createTechnologieTempsNiveau" method="post">
                    <div>
                        <label for = "idTechno"> Id Technologie</label><br/>
                        <select name="idTechno" id="idTechno">
                        <option value="null"></option>
                            <?php
                                foreach($adminTechnologieBase as $technoBase){?>
                                    <option value="<?=$technoBase['id']?>"><?=$technoBase['nom']?></option>
                               <?php }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="niveauTechno">Niveau</label><br/>
                        <select name="niveauTechno" id="niveauTechno">
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
            <h4>Pré requis Technologie</h4>
                <form action="index.php?galaxyInfinity=createTechnologiePR" method="post">
                    <div>
                        <label for = "idTechno"> Nom Technologie</label><br/>
                        <select name="idTechno" id="idTechno">
                        <option value=""></option>
                            <?php
                                foreach($adminTechnologieBase as $technoBase){?>
                                    <option value="<?=$technoBase['id']?>"><?=$technoBase['nom']?></option>
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
                                foreach($adminTechnologieBase as $techno){?>
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
    <div class="modifTechno">
        <div>
            <h4>Modif Technologie Base</h4>
            <form action="index.php?galaxyInfinity=modifTechnologieBase" method="post">
            <div>
                <label for="idTechno">Nom de la technologie a modifié</label>
                <select name="idTechno" id="idTechno">
                    <option value="null"></option>
                    <?php
                        foreach($adminTechnologieBase as $techno){?>
                            <option value="<?=$techno['id']?>"><?=$techno['nom']?></option>
                        <?php }
                    ?>
                </select>
            </div>
                <div>
                    <label for = "nomTechno"> Nouveau nom de la technologie</label><br/>
                    <input type="text" id="nomTechno" name="nomTechno" > 
                </div>
                <div>
                    <label for="descr">Nouvelle description</label><br/>
                    <input type="text" id="descr" name="descr" >
                </div>
                <div>
                    <label for="tier">Tier de la technologie</label><br/>
                    <input type="number" id="tier" name="tier" min="1" max="10" >
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>
        <div>
            <h4>Modif Technologie Craft Niveau</h4>
            <form action="index.php?galaxyInfinity=modifTechnologieCraftNiveau" method="post">
                <div>
                    <label for="idLigne">Id de la ligne cible</label>
                    <select name="idLigne" id="idLigne">
                        <option value="null"></option>
                        <?php
                            foreach($adminTechnologieNiveau as $technoNiveau){?>
                                <option value="<?=$technoNiveau['id']?>"><?=$technoNiveau['id']?></option>
                            <?php }
                        ?>
                    </select>
                </div> 
                <div>
                    <label for = "idTechno"> Nom de la technologie</label><br/>
                    <select name="idTechno" id="idTechno">
                        <option value="null"></option>
                        <?php
                            foreach ($adminTechnologieBase as $techno) {?>
                                <option value="<?=$techno['id']?>"><?=$techno['nom']?></option>
                           <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="niveauTechno">Niveau Technologie</label><br/>
                    <select name="niveauTechno" id="niveauTechno">
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
            <h4>Modif Temps Construction Technologie par niveau</h4>
                <form action="index.php?galaxyInfinity=modifTechnologieTempsNiveau" method="post">
                    <div>
                        <label for = "idTechno"> Id Technologie</label><br/>
                        <select name="idTechno" id="idTechno">
                        <option value="null"></option>
                            <?php
                                foreach($adminTechnologieBase as $technoBase){?>
                                    <option value="<?=$technoBase['id']?>"><?=$technoBase['nom']?></option>
                               <?php }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="niveauTechno">Niveau</label><br/>
                        <select name="niveauTechno" id="niveauTechno">
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
            <h4>Modification Pré requis Technologie</h4>
                <form action="index.php?galaxyInfinity=modifTechnologiePR" method="post">
                    <div>
                        <label for="idLigne">Id de la ligne cible</label>
                        <select name="idLigne" id="idLigne">
                            <option value=""></option>
                            <?php
                                foreach($adminTechnologiePR as $technoPR){?>
                                    <option value="<?=$technoPR['id']?>"><?=$technoPR['id']?></option>
                                <?php }
                            ?>
                        </select>
                    </div> 
                    <div>
                        <label for = "idTechno"> Nom Technologie</label><br/>
                        <select name="idTechno" id="idTechno">
                        <option value=""></option>
                            <?php
                                foreach($adminTechnologieBase as $technoBase){?>
                                    <option value="<?=$technoBase['id']?>"><?=$technoBase['nom']?></option>
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
                                foreach($adminTechnologieBase as $techno){?>
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

    <div class='tableGITAdmin'>
        <div>
            <table class="dataTable">
            <h4>Technologie de base</h4>
                <thead>
                    <tr>
                        <th>Id de la technologie</th>
                        <th>Nom de la technologie</th>
                        <th>Description Technologie</th>
                        <th>Tier Tehnologie</th>
                        <th>Image Technologie</th>
                        <th>Action ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($adminTechnologieBase as $technoBase) {?>
                            <tr>
                                <td><?=$technoBase['id']?></td>
                                <td><?=$technoBase['nom']?></td>
                                <td><?=$technoBase['description']?></td>
                                <td><?=$technoBase['tier']?></td>
                                <td><?=$technoBase['image']?></td>
                                <td><form action="index.php?galaxyInfinity=supprTechnologieBase&idTechnologie=<?=$technoBase['id']?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                            </tr>
                        <?php   
                        }

                    ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="dataTable">
            <h4>Technologie craft par niveau</h4>
                <thead>
                    <tr>
                        <th>Id Ligne</th>
                        <th>Nom technologie</th>
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
                        foreach ($adminTechnologieNiveau as $technoNiveau) {?>
                            <tr>
                                <td><?=$technoNiveau[0];?></td>
                                <td><?=$technoNiveau[8];?></td>
                                <td><?=$technoNiveau['niveau_id'];?></td>
                                <td><?=$technoNiveau[13];?></td>
                                <td><?=$technoNiveau['nombre_craft'];?></td>
                                <td><?=$technoNiveau[19];?></td>
                                <td><?=$technoNiveau['nombre_items'];?></td>
                                <td><form action="index.php?galaxyInfinity=supprTechnologieCraftNiveau&idLigne=<?=$technoNiveau['id']?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                            </tr>
                            <?php
                        }
                    
                    ?>
                </tbody>
            </table>
        </div>

        <div>
            <table class="dataTable">
            <h4>Technologie temps construction par niveau</h4>
                <thead>
                    <tr>
                        <th>Nom Technologie</th>
                        <th>Niveau Technologie</th>
                        <th>Temps Construction</th>
                        <th>Action ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($adminTechnologieTempsNiveau as $technoTemps){?>
                        <tr>
                            <td><?=$technoTemps['nom']?></td>
                            <td><?=$technoTemps['niveau_id']?></td>
                            <td><?=$technoTemps['temps_construction']?></td>
                            <td><form action="index.php?galaxyInfinity=supprTechnologieTempsNiveau&idTechnologie=<?=$technoTemps['technologie_id']?>&idNiveau=<?=$technoTemps['niveau_id']?>" method='post'><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                        </tr>
                  <?php  } ?>
                    
                </tbody>
            </table>
        </div>
        <div>
            <table class='dataTable'>
            <h4>Technologie pré-requis</h4>
                <thead>
                    <tr>
                        <th>Id de la ligne</th>
                        <th>Nom Technologie</th>
                        <th>Nom Batiment PR</th>
                        <th>Niveau Batiment PR</th>
                        <th>Nom Technologie PR</th>
                        <th>Niveau Technologie PR</th>
                        <th>Action ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($adminTechnologiePR as $technoPR){?>
                        <tr>
                            <td><?=$technoPR[0]?></td>
                            <td><?=$technoPR[7]?></td>
                            <td><?=$technoPR[12]?></td>
                            <td><?=$technoPR['niveau_id_batiment']?></td>
                            <td><?=$technoPR[17]?></td>
                            <td><?=$technoPR['niveau_id_technologie']?></td>
                            <td><form action="index.php?galaxyInfinity=supprTechnologiePR&idLigne=<?=$technoPR['id']?>" method='post'><input type="submit" name="Supprimer" value="Supprimer"></form></td>
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
