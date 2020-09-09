


<div class='mainDiv'>
    <nav class='navTier'>
        <ul>
            <li><a href="index.php?galaxyInfinity=afficheBatimentUser&tier=1">Tier 1</a></li>
            <li><a href="index.php?galaxyInfinity=afficheBatimentUser&tier=2">Tier 2</a></li>

        </ul>
    </nav>

    <div class='divBat'>
        <?php

        foreach($batPlanete as $batPlanete){ ?>
            <div>
                <h4><?=$batPlanete['nom']?></h4>
                <img src="../plugins/galaxyInfinity/admin/public/img/batiment/<?=$batPlanete['image']?>">
                
            </div>
      <?php } ?>
    
    </div>
</div>