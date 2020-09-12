


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
                        <?php if($craft['prValide'] == true && $craft['craftValide'] == true){?>
                            <form action="#"><input type="number" min="1" max='100'><input type="submit"value="Craft"></form>
                    <?php }
                        else{?>
                            <p style='color: red'>Manque de ressource</p>
                    <?php } ?>
                    </div>
                    
                    
                </div>
                
           <?php }

        ?>
    
    </div>
</div>