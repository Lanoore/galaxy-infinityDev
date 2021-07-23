


<div class='mainDiv' id='mainDiv'>
    <?php if($tempsRestantBat != null){?>
        <div class='tempsRestantBat' id='tempsRestantBat'>
        <p><?=$tempsRestantBat['nomBat']?>:</p>
        <p id='tempsRestantBatEnCours'><?=$tempsRestantBat['tempsDecompte']?>(<?=$tempsRestantBat['niveauBat']?>)</p>

    </div>
    <?php }?>


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
                    
                    <img class='imgBatX' src="plugins/galaxyInfinity/admin/public/img/batiment/<?=$bat['imageBat']?>" alt=""  width="94%">
                    <?php
                        if($bat['prValide'] == 0 && $bat['craftValide'] == 0 && $bat['verifBatEnCours'] == 0){?>
                            <p style='color: blue'><a href="index.php?galaxyInfinity=addConstructionBat&idBat=<?=$bat['idBat']?>" method='post'>Construire</a></p>    
                       <?php }
                        else{?>
                            <p style='color: red'>Construire</p>
                       <?php }
                    ?>
                    <div class='divBatDescrX' id='divBatDescrX'>
                        <p>Description: <?=$bat['descrBat']?></p>
                        <p>Temps construction : <?=$bat['tempsConstru']?></p>
                        <div>
                            <?php foreach($bat['batCraft'] as $batCraft){
                                if($batCraft['craft_id'] != null){?>
                                    <p><?=$batCraft[8]?> : <?=$batCraft['nombre_craft']?></p>
                               <?php }
                               if($batCraft['items_id'] != null){?>
                                <p><?=$batCraft[14]?> : <?=$batCraft['nombre_items']?></p>
                           <?php }
                            }?>
                        </div>
                    </div>
                </div>
                
           <?php }

        ?>
    
    </div>
</div>




<script type='text/javascript' src='plugins/galaxyInfinity/user/public/js/jsBatiment/gestionBat.js'></script>
<script type='text/javascript' src='plugins/galaxyInfinity/user/public/js/jsBatiment/mainBat.js'></script>