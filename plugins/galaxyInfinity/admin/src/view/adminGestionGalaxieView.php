


<div>
    <p><a href="index.php?galaxyInfinity=afficheAdminGalaxyInfinityGestion">Revenir à l'administration</a></p>




    <div class='createSyteme'>
        <h4>Création Systeme planete</h4>
        <form action="index.php?galaxyInfinity=createSystemePlanete" method='post'>
            <div>
                <label for="nombreSysteme">Nombre de systeme</label>
                <input type="number" id='nombreSysteme' name ='nombreSysteme'>
            </div>
            <div>
                <label for="nombrePlanete">Nombre planete dans le systeme</label>
                <input type="number" id="nombrePlanete" name='nombrePlanete'>
            </div>
            <div>
                <input type="submit">
            </div>
        </form>
    </div>
    <div class='modifPlanete'>
        <h4>Modification Situation planete</h4>
        <form action="index.php?galaxyInfinity=modifSituationPlanete" method='post'>
            <div>
                <label for="idPlanete">Id de la planete</label>
                <input type="number" id='idPlanete' name ='idPlanete'>
            </div>
            <div>
                <label for="situation">Situation a donné</label>
                <input type="number" id="situation" name='situation'>
            </div>
            <div>
                <input type="submit">
            </div>
        </form>
    </div>








    <table class="dataTable">
            <thead>
                <tr>
                    <th>Id Planete</th>
                    <th>Numéro du systeme</th>
                    <th>Position dans le systeme</th>
                    <th>Situation de la planete</th>
                    <th>Nom du joueur ayant la planete</th>
                    <th>Action ?</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($planetes as $planete) {?>
                        <tr>
                            <td><?=$planete[0]?></td>
                            <td><?=$planete['systeme']?></td>
                            <td><?=$planete['position']?></td>
                            <td><?=$planete['situation']?></td>
                            <td><?=$planete['pseudo']?></td>
                            <td><form action="index.php?galaxyInfinity=supprPlanete&idPlanete=<?=$planete['id']?>" method="post"><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                        </tr>
                     <?php   
                    }
                
                ?>
            </tbody>
        </table>
</div>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">




<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="plugins/galaxyInfinity/admin/public/js/adminGestionGalaxyInfinity.js"></script>