<div>
    <p><a href="index.php?galaxyInfinity=afficheAdminGalaxyInfinityGestion">Revenir à l'administration</a></p>

    <div class="createMission">
        <div>
            <h4>Création Mission Base</h4>
            <form action="index.php?galaxyInfinity=createMissionBase" method="post" enctype="multipart/form-data">
                <div>
                    <label for = "nom"> Nom mission</label><br/>
                    <input type="text" id="nom" name="nom"> 
                </div>
                <div>
                    <label for="descr">Description mission</label><br/>
                    <input type="text" id="descr" name="descr" >
                </div>
                <div>
                    <label for="type">Type de mission</label><br/>
                    <input type="number" id="type" name="type" min="1" max="3" >
                </div>
                <div>
                    <label for="genre">Genre mission</label><br/>
                    <input type="number" name ="genre" min="1" max="2">
                </div>
                <div>
                    <label for="niveau">Niveau de la mission</label><br/>
                    <input type="number" name="niveau" min="1" max="10">
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>


        </div>
    </div>
    <div class="modifMissions">
        <div>
            <h4>Modif Mission Base</h4>
            <form action="index.php?galaxyInfinity=modifMissionBase" method="post">
            <div>
                <label for="idMission">Nom de la mission a modifié</label>
                <select name="idMission" id="idMission">
                    <option value="null"></option>
                    <?php
                        foreach($adminMissionsBase as $mission){?>
                            <option value="<?=$mission['id']?>"><?=$mission['nom']?></option>
                        <?php }
                    ?>
                </select>
            </div>
                <div>
                    <label for = "nomMission"> Nouveau nom de la mission</label><br/>
                    <input type="text" id="nomMission" name="nomMission" > 
                </div>
                <div>
                    <label for="descr">Nouvelle description</label><br/>
                    <input type="text" id="descr" name="descr" >
                </div>
                <div>
                    <label for="type">Type de mission</label><br/>
                    <input type="number" id="type" name="type" min="1" max="3" >
                </div>
                <div>
                    <label for="genre">Genre mission</label><br/>
                    <input type="number" name ="genre" min="1" max="2">
                </div>
                <div>
                    <label for="niveau">Niveau de la mission</label><br/>
                    <input type="number" name="niveau" min="1" max="10">
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
            <h4>Missions de base</h4>
                <thead>
                    <tr>
                        <th>Id de la Mission</th>
                        <th>Nom de la Mission</th>
                        <th>Description Mission</th>
                        <th>Type Mission</th>
                        <th>Genre Misssion</th>
                        <th>Niveau Mission</th>
                        <th>Action ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($adminMissionsBase as $missionBase) {?>
                            <tr>
                                <td><?=$missionBase['id']?></td>
                                <td><?=$missionBase['nom']?></td>
                                <td><?=$missionBase['description']?></td>
                                <td><?=$missionBase['type']?></td>
                                <td><?=$missionBase['genre']?></td>
                                <td><?=$missionBase['niveau']?></td>
                                <td><form action="index.php?galaxyInfinity=supprMissionBase&idMission=<?=$missionBase['id']?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
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
<script src="plugins/galaxyInfinity/admin/public/js/adminGestionGalaxyInfinity.js"></script>