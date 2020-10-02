



<div>
    <p><a href="index.php?galaxyInfinity=afficheAdminGalaxyInfinityGestion">Revenir à l'administration</a></p>

    <div class='createItems'>
        <h4>Création Items Base</h4>
        <form action="index.php?galaxyInfinity=createItemBase" method='post'>
            <div>
                <label for="nomItems">Nom de l'items</label>
                <input type="text" id='nomItems' name ='nomItems'>
            </div>
            <div>
                <input type="submit">
            </div>
        </form>
    </div>
    <div>
        <h4>Modification Items Base</h4>
        <form action="index.php?galaxyInfinity=modifItemBase" method='post'>
            <div>
                <label for="idItem">Nom de l'items a modifié</label>
                <select name="idItem" id="idItem">
                    <?php
                        foreach($items as $item){?>
                            <option value="<?=$item['id']?>"><?=$item['nom']?></option>
                        <?php }
                    ?>
                </select>
            </div>
            <div>
                <label for="nomItem">Nouveau nom de l'items</label>
                <input type="text" id='nomItem' name ='nomItem'>
            </div>
            <div>
                <input type="submit"> 
            </div>
        </form>
    </div>

    <div>
        <table class="dataTable">
            <thead>
                <tr>
                    <td>Id de l'item</td>
                    <td>Nom de l'item</td>
                    <th>Action ?</th>
                </tr>
            </thead>               
            <tbody>
                <?php
                    foreach($items as $item){?>
                        <tr>
                            <td><?=$item['id']?></td>
                            <td><?=$item['nom']?></td>
                            <td><form action="index.php?galaxyInfinity=supprItemBase&idItem=<?=$item['id']?>"method='post'><input type="submit" name='Supprimer' value='Supprimer'></form></td>
                        </tr>
                   <?php }
                ?>
            </tbody> 
        </table>
    </div>

</div>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">




<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="plugins/galaxyInfinity/admin/public/js/adminGestionGalaxyInfinity.js"></script>