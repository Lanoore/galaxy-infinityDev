


<div class='mainDiv'>
    <nav class='navTier'>
        <ul>
            <li><a href="index.php?galaxyInfinity=afficheCraftUser&tier=1">Tier 1</a></li>
            <li><a href="index.php?galaxyInfinity=afficheCraftUser&tier=2">Tier 2</a></li>

        </ul>
    </nav>

    <div class='divCraft'>
        <?php

            foreach($craft as $craft){?>

                <div class='divCraftX'>
                    <div class="divCraftXInfo">
                        <img src="../plugins/galaxyInfinity/admin/public/img/craft/<?=$craft['imageCraft']?>" alt="">
                        <p><?=$craft['nomCraft']?></p>
                    </div>
                    
                    <div class='divCraftXCraft'>
                        <p><?=$craft['nombreCraft']?></p>
                        <?php if($craft['verifPrCraft'] == 0 && $craft['verifCraftCraft'] == 0 && $craft['verifCraftEnCours'] == 0){?>
                            <form action="index.php?galaxyInfinity=addConstructionCraft&idCraft=<?=$craft['idCraft']?>" method="post"><input type="number" min="1" max='100' name='nombreCraft'><input type="submit"value="Craft"></form>
                    <?php }
                        else{?>
                            <p style='color: red'>Craft Impossible</p>
                    <?php } ?>
                    </div>
                    
                    
                </div>
                
           <?php }

        ?>
    
    </div>
</div>