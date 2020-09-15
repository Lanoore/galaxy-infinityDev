


<div class='mainDiv'>
    <nav class='navTier'>
        <ul>
            <li><a href="index.php?galaxyInfinity=afficheBatimentUser&tier=1">Tier 1</a></li>
            <li><a href="index.php?galaxyInfinity=afficheBatimentUser&tier=2">Tier 2</a></li>

        </ul>
    </nav>

    <div class='divBat'>
        <?php

            foreach($batiment as $bat){?>
                <div class='divBatX'>
                    <div class='divBatXInfo'>
                        <p><?=$bat['nomBat']?></p>
                        <p><?=$bat['niveauBatPlanete']?></p>
                    </div>
                    
                    <img src="../plugins/galaxyInfinity/admin/public/img/batiment/<?=$bat['imageBat']?>" alt=""  width="94%">
                    <?php
                        if($bat['prValide'] == 0 && $bat['craftValide'] == 0 && $bat['verifBatEnCours'] == 0){?>
                            <p style='color: blue'><a href="index.php?galaxyInfinity=addConstructionBat&idBat=<?=$bat['idBat']?>" method='post'>Construire</a></p>    
                       <?php }
                        else{?>
                            <p style='color: red'>Construire</p>
                       <?php }
                    ?>
                </div>
           <?php }

        ?>
    
    </div>
</div>