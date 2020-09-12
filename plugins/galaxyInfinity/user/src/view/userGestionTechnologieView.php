


<div class='mainDiv'>
    <nav class='navTier'>
        <ul>
            <li><a href="index.php?galaxyInfinity=afficheTechnologieUser&tier=1">Tier 1</a></li>
            <li><a href="index.php?galaxyInfinity=afficheTechnologieUser&tier=2">Tier 2</a></li>

        </ul>
    </nav>

    <div class='divTechno'>
        <?php

            foreach($technologie as $techno){?>
                <div class='divTechnoX'>
                    <div class='divTechnoXInfo'>
                        <p><?=$techno['nomTechno']?></p>
                        <p><?=$techno['niveauTechnoPlanete']?></p>
                    </div>
                    
                    <img src="../plugins/galaxyInfinity/admin/public/img/technologie/<?=$techno['imageTechno']?>" alt=""  width="94%">
                    <?php
                        if($techno['prValide'] == true && $techno['craftValide'] == true){?>
                            <p style='color: blue'><a href="#">Construire</a></p>    
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