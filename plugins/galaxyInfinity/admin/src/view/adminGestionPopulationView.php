<div>
    <p><a href="index.php?galaxyInfinity=afficheAdminGalaxyInfinityGestion">Revenir à l'administration</a></p>

    <div class="createPop">
        <div>
            <h4>Création Population Base</h4>
            <form action="index.php?galaxyInfinity=createPopBase" method="post" enctype="multipart/form-data">
                <div>
                    <label for="typeUnite">Type D'unité</label><br/>
                    <input type="number" id='typeUnite' name='typeUnite' min='0' max='1'>
                </div>
                <div>
                    <label for = "nomPop"> Nom de la Population</label><br/>
                    <input type="text" id="nomPop" name="nomPop"> 
                </div>
                <div>
                    <label for="descr">Description</label><br/>
                    <input type="text" id="descr" name="descr">
                </div>
                <div>
                    <label for="tier">Tier de la pop</label><br/>
                    <input type="number" id="tier" name="tier" min="1" max="10">
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
            <h4>Pré requis Population</h4>
                <form action="index.php?galaxyInfinity=createPopPR" method="post">
                    <div>
                        <label for = "idPop"> Nom de la population</label><br/>
                        <select name="idPop" id="idPop">
                        <option value=""></option>
                            <?php
                                foreach($pops as $pop){?>
                                    <option value="<?=$pop['id']?>"><?=$pop['nom']?></option>
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
    <div class="modifPop">
            <div>
            <h4>Modification de la Population</h4>
            <form action="index.php?galaxyInfinity=modifPopBase" method='POST'>
                <div>
                    <label for="idPop">Nom de la pop a modifié</label><br/>
                    <select name="idPop" id="idPop">
                        <?php
                            foreach($pops as $pop){?>
                                <option value="<?=$pop['id']?>"><?=$pop['nom']?></option>
                            <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="typeUnite">Type D'unité</label><br/>
                    <input type="number" id='typeUnite' name='typeUnite' min='0' max='1'>
                </div>
                <div>
                    <label for="nomPop">Nouveau nom de la pop</label><br/>
                    <input type="text" id="nomPop" name="nomPop">
                </div>
                <div>
                    <label for="descr">Nouvelle description</label><br/>
                    <input type="text" id="descr" name="descr">
                </div>
                <div>
                    <label for="tier">Tier de la pop</label><br/>
                    <input type="number" id="tier" name="tier" min="1" max="10">
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>
        <div>
                <h4>Modification Pré requis Craft</h4>
                    <form action="index.php?galaxyInfinity=modifPopPR" method="post">
                        <div>
                            <label for="idLigne">Id de la ligne cible</label><br/>
                            <select name="idLigne" id="idLigne">
                                <option value=""></option>
                                <?php
                                    foreach($popsPR as $popPR){?>
                                        <option value="<?=$popPR[0]?>"><?=$popPR[0]?></option>
                                    <?php }
                                ?>
                            </select>
                        </div> 
                        <div>
                            <label for = "idPop"> Nom de la population</label><br/>
                            <select name="idPop" id="idPop">
                            <option value=""></option>
                                <?php
                                    foreach($pops as $pop){?>
                                        <option value="<?=$pop['id']?>"><?=$pop['nom']?></option>
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

    <div class="tableGICAdmin">
        <table class="dataTable">
        <h4>Craft de base</h4>
            <thead>
                <tr>
                    <th>Id de la population</th>
                    <th>Type d'unité</th>
                    <th>Nom de la population</th>
                    <th>Description de la population</th>
                    <th>Tier de la population</th>
                    <th>Image de la population</th>
                    <th>Action ?</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($pops as $pop) {?>
                        <tr>
                            <td><?=$pop['id']?></td>
                            <td><?=$pop['typeUnite']?></td>
                            <td><?=$pop['nom']?></td>
                            <td><?=$pop['description']?></td>
                            <td><?=$pop['tier']?></td>
                            <td><?=$pop['image']?></td>
                            <td><form action="index.php?galaxyInfinity=supprPopBase&idPop=<?=$pop['id']?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                        </tr>
                     <?php   
                    }
                
                ?>
            </tbody>
        </table>
        </table>
            <table class="dataTable">
            <h4>Population pré-requis</h4>
                <thead>
                    <tr>
                        <th>Id de la ligne</th>
                        <th>Nom de la population</th>
                        <th>Nom Batiment PR</th>
                        <th>Niveau Batiment PR</th>
                        <th>Nom Technologie PR</th>
                        <th>Niveau Technologie PR</th>
                        <th>Action ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($popsPR as $popPR){?>
                        <tr>
                            <td><?=$popPR[0]?></td>
                            <td><?=$popPR[7]?></td>
                            <td><?=$popPR[12]?></td>
                            <td><?=$popPR['niveau_id_batiment']?></td>
                            <td><?=$popPR[17]?></td>
                            <td><?=$popPR['niveau_id_technologie']?></td>
                            <td><form action="index.php?galaxyInfinity=supprPopPR&idLigne=<?=$popPR[0]?>" method='post'><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                        </tr>
                  <?php  } ?>
                    
                </tbody>
            </table>

    </div>

</div>





<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">




<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="plugins/galaxyInfinity/admin/public/js/adminGestionGalaxyInfinity.js"></script>