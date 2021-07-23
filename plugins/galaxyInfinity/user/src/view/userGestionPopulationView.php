<div class="divCivil">
    <h3>Civils</h3>
    <?php
        foreach($populations as $pop){
            if($pop['typeUnite'] == 0){?>
                <div class="divPop">
                    <div class="divPopInfo">
                        <img class='imgPopX' src="plugins/galaxyInfinity/admin/public/img/population/<?=$pop['imagePop']?>" alt="">
                        <p><?=$pop['nomPop']?></p>
                    </div>
                    <div class="divPopProd">
                    <p><?=$pop['nombre_pop']?></p>
                    <?php
                        if($pop['prValide'] == 0){?>
                            <form action="index.php?galaxyInfinity=addProdPopulation&idPop=<?=$pop['idPop']?>" method="post"><input type="number" min="1" max='100' name='nombreProd'><input type="submit"value="Former"></form>
                       <?php }
                       else{?>
                            <p>Formation impossbile</p>
                       <?php }
                    ?>
                        
                    </div>
                </div>
           <?php }
        }
    ?>
</div>

<div class="divMilitaire">
    <h3>Militaires</h3>
    <?php
        foreach($populations as $pop){
            if($pop['typeUnite'] == 1){?>
                <div class="divPop">
                    <div class="divPopInfo">
                        <img class='imgPopX' src="plugins/galaxyInfinity/admin/public/img/population/<?=$pop['imagePop']?>" alt="">
                        <p><?=$pop['nomPop']?></p>
                    </div>
                    <div class="divPopProd">
                        <p><?=$pop['nombre_pop']?></p>
                        <?php
                        if($pop['prValide'] == 0){?>
                            <form action="index.php?galaxyInfinity=addProdPopulation&idPop=<?=$pop['idPop']?>" method="post"><input type="number" min="1" max='100' name='nombreProd'><input type="submit"value="Former"></form>
                       <?php }
                       else{?>
                            <p>Formation impossbile</p>
                       <?php }
                    ?>
                    </div>
                </div>
           <?php }
        }
    ?>
</div>