


<div class='mainDiv' id='mainDiv'>

    <?php if($tempsRestantTechno['nomTechno'] != null){?>
        <div class='tempsRestantTechno' id='tempsRestantTechno'>
        <p><?=$tempsRestantTechno['nomTechno']?>:</p>
        <p><?=$tempsRestantTechno['tempsDecompte']?>(<?=$tempsRestantTechno['niveauTechno']?>)</p>

    </div>
    <?php }?>

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
                        if($techno['prValide'] == 0 && $techno['craftValide'] == 0 && $techno['verifTechnoEnCours'] == 0){?>
                            <p style='color: blue'><a href="index.php?galaxyInfinity=addConstructionTechno&idTechno=<?=$techno['idTechno']?>" method='post'>Construire</a></p>    
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




<script type='text/javascript' src='../plugins/galaxyInfinity/user/public/js/jsTechnologie/gestionTechno.js'></script>
<script type='text/javascript' src='../plugins/galaxyInfinity/user/public/js/jsTechnologie/mainTechno.js'></script>