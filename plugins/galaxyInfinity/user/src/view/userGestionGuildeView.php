


<div>
    <?php
        
        if(!isset($_SESSION['idGuilde'])){?>
            <div class="divCreateGuilde">
                <p>Créer sa guilde:</p>
                <form action="index.php?galaxyInfinity=createNewGuilde" method="post">
                    <label for="nomGuilde">Nom de la guilde :</label>
                    <input type="text" name="nomGuilde">
                    <br>
                    <input type="submit">
                </form>
            </div>
            <div class="divGuildes">
                <p>Rejoindre une guilde :</p>
                <div class="guildes">
                    <?php
                        foreach($guilde as $guilde){?>
                            <span class="guildeX">
                                <p>Nom de la guilde : <?= $guilde['nomGuilde']?></p>
                                <p><a href="index.php?galaxyInfinity=joinGuilde&idGuilde=<?=$guilde['idGuilde']?>">Rejoindre cette guilde</a></p>
                            </span>
                       <?php }
                    ?>
                </div>
            </div>
        <?php }
        else{?>
            
            <div class="infoGuilde">
                <p><?=$infoGuilde['nomGuilde']?></p>
                <?php
                if($infoGuilde['idChefGuilde'] != $_SESSION['idUser']){?>
                    <p><a href="index.php?galaxyInfinity=quitterGuilde">Quitter la guilde</a></p>
               <?php }elseif($infoGuilde['idChefGuilde'] == $_SESSION['idUser']){?>
                    <p><a href="index.php?galaxyInfinity=dissoudreGuilde">Dissoudre la guilde</a></p>
                  <?php }?>
            </div>
            

            <div>
                <?php

                foreach($guilde as $guilde){?>
                    <span class='infoMembre'>
                        <p>Pseudo: <?=ucwords($guilde['pseudo'])?></p>
                        <p>Planete Mere: <?=ucwords($guilde['nomPlanete'])?></p>
                        <p>Dernière connexion: <?=$guilde['lastConnexion']?></p>
                        <?php if($_SESSION['idUser'] == $infoGuilde['idChefGuilde'] AND $infoGuilde['idChefGuilde'] != $guilde[0]){?><p><a href="index.php?galaxyInfinity=supprMembreGuilde&idMembre=<?=$guilde['id']?>">Renvoyer ce membre</a></p><?php }?>
                    </span>
                <?php }
                ?>
                
            </div>
        <?php }

    ?>
    

</div>