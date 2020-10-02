

<div>
    <div class='divActionForum'>
        <div>
            <h4>Création catégorie</h4>
            <form action="index.php?forum=createCategorie" method='POST'>
                <div>
                    <label for="nom">Nom de la catégorie</label>
                    <input type="text" id="nom" name="nom">
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>


        <div>
            <h4>Modification catégorie</h4>
            <form action="index.php?forum=modifCategorie" method='POST'>
                <div>
                    <label for="nomCategorie">Nouveau nom de la catégorie</label>
                    <input type="text" id="nomCategorie" name="nomCategorie">
                </div>

                <div>
                    <label for="idCategorie">Id de la catégorie</label>
                    <select name="idCategorie" id="idCategorie">
                        <?php
                            foreach($categories as $categorie){?>
                                <option value="<?=$categorie['id']?>"><?=$categorie['nom']?></option>
                            <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>

        <div>
            <h4>Move Topic</h4>
            <form action="index.php?forum=moveTopic" method='POST'>
                <div>
                    <label for="idTopic">Id du topic</label>

                    <select name="idTopic" id="idTopic">
                        <?php
                            foreach($topics as $topic){?>
                                <option value="<?=$topic['id']?>"><?=$topic['nom']?></option>
                            <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="idCategorie">Id de la catégorie cible</label>
                    <select name="idCategorie" id="idCategorie">
                        <?php
                            foreach($categories as $categorie){?>
                                <option value="<?=$categorie['id']?>"><?=$categorie['nom']?></option>
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

    <div class="tableForumAdmin">
        <table id='table_1'>
            <thead>
                <tr>
                    <th>Id de la catégorie</th>
                    <th>Nom de la catégorie</th>
                    <th>Action ?</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($categories as $categorie) {?>
                        <tr>
                            <td><?=$categorie['id']?></td>
                            <td><?=$categorie['nom']?></td>
                            <td><form action="index.php?forum=supprCategorie&idCategorie=<?=$categorie['id']?>" method='POST'><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                        </tr>       
                    <?php }
                ?>
            </tbody>
        </table>
    </div>
    <br><br><br>
    <div class="tableForumAdmin">
        <table id='table_2'>
            <thead>
                <tr>
                    <th>Id du topic</th>
                    <th>Nom du topic</th>
                    <th>Auteur</th>
                    <th>Message</th>
                    <th>Date de création</th>
                    <th>date de modification</th>
                    <th>Id de la catégorie</th>
                    <th>Nom de la catégorie</th>
                    <th>Action ?</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($topics as $topic) {?>
                        <tr>
                            <td><?=$topic['id']?></td>
                            <td><?=$topic['nom']?></td>
                            <td><?=$topic['auteur']?></td>
                            <td><?=$topic['message']?></td>
                            <td><?=$topic['dateCreation']?></td>
                            <td><?=$topic['dateModif']?></td>
                            <td><?=$topic['idCategorie']?></td>
                            <td><?=$topic['nomCategorie']?></td>
                            <td><form action="index.php?forum=supprTopic&idTopic=<?=$topic['id']?>" method='POST'><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                        </tr>
                   <?php }
                        
                ?>
            </tbody>
        </table>
    </div>
    <br><br><br>
    <div class="tableForumAdmin">
        <table id='table_3'>
            <thead>
                <tr>
                    <th>Id commentaire</th>
                    <th>Auteur</th>
                    <th>Message</th>
                    <th>Date de Creation</th>
                    <th>Date de mofification</th>
                    <th>Id du topic</th>
                    <th>Nom du topic</th>
                    <th>Action ?</th>
                </tr>
            </thead>
            <tbody>
            
                <?php   
                        
                foreach ($commentaires as $commentaire) {?>
                    <tr>
                        <td><?= $commentaire['id']?></td>
                        <td><?= $commentaire['auteur']?></td>
                        <td><?= $commentaire['message']?></td>
                        <td><?= $commentaire['dateCreation']?></td>
                        <td><?= $commentaire['dateModif']?></td>
                        <td><?= $commentaire['idTopic']?></td>
                        <td><?= $commentaire['nomTopic']?></td>
                        <td><form action="index.php?forum=supprCommentaire&idCommentaire=<?=$commentaire['id']?>" method='POST'><input type="submit" name="Supprimer" value="Supprimer"></form></td>
                    </tr>    
                <?php }
                        
                ?>
            </tbody>
        </table>
    </div>

</div>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">




<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="plugins/forum/public/js/adminGestionForum.js"></script>




