

<div class='mainDiv'>
    <div class='deplacementSysteme'>
        <p><a href="index.php?galaxyInfinity=afficheGalaxieUser&systeme=<?php if($_GET['systeme'] == 1){echo $_GET['systeme'];}else{echo($_GET['systeme'] - 1);}?>">Précédent</a></p>
       
        <p><a href="index.php?galaxyInfinity=afficheGalaxieUser&systeme=<?php if($_GET['systeme'] == 10){echo $_GET['systeme'];}else{echo($_GET['systeme'] + 1);}?>">Suivant</a></p>
    </div>
    <div class='divPlanetes'>
        <?php
            foreach($galaxie as $planete){?>

                <div class='divPlaneteX'>
                    <?php if(empty($planete['user_id'])){?> <p>Planete Libre</p> <?php }else{?> <p>Pseudo: <?= ucwords($planete['pseudo'])?></p> <?php }?>
                    <p>Position: <?=$planete['position']?></p>

                     
                </div>

        <?php  }

        ?>
    </div>
    

</div>