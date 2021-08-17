
<div class='mainDiv' id='mainDiv'>
<?php if($tempsRestantForm != null){?>
        <div class='tempsRestantForm' id='tempsRestantForm'>
        <p><?=$tempsRestantForm['nomPop']?>:</p>
        <p id='tempsRestantFormEnCours'><?=$tempsRestantForm['tempsDecompte']?>(<?=$tempsRestantForm['nombrePopForm']?>)</p>

    </div>
    <?php }?>

<div class="divPop">
<div class="divCivil">





    <h3>Civils</h3>
    <?php
        foreach($populations as $pop){

            if($pop['typeUnite'] == 0){?>
                <div class="divPopX">
                    <div class="divPopInfo">
                        <img class='imgPopX' src="plugins/galaxyInfinity/admin/public/img/population/<?=$pop['imagePop']?>" alt="">
                        <p><?=$pop['nomPop']?></p>
                    </div>
                    
                    
                    <div class="divPopProd">
                    <p><?=$pop['nombre_pop']?></p>
                    <?php
                        if($pop['prValide'] == 0 && $pop['verifPopEnCours'] == 0 && $pop['verifFormPop'] == 0){?>
                            <form action="index.php?galaxyInfinity=addProdPopulation&idPop=<?=$pop['idPop']?>" method="post"><input type="number" min="1" max='100' name='nombreForm'><input type="submit"value="Former"></form>
                       <?php }
                       else{?>
                            <p>Formation impossbile</p>
                       <?php }
                    ?>
                    </div>
                    <div class='divPopDescrX' id='divPopDescrX'>
                        <p>Description: <?=$pop['descrPop']?></p>
                        <p>Temps construction : <?php if($pop['nomPop'] == 'Civil'){echo($pop['tempsForm'] * 5);}else{echo($pop['tempsForm']);} ?></p>
                        <div>
                        <?php foreach($pop['popForm'] as $popForm){
                                if($popForm['craft_id'] != null){?>
                                    <p><?=$popForm[7]?> : <?=$popForm['nombre_craft']?></p>
                               <?php }
                               if($popForm['pop_id_formation'] != null){?>
                                <p><?=$popForm[14]?> : <?=$popForm['nombre_pop_formation']?></p>
                           <?php }
                            }?>
                        </div>
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
                <div class="divPopX">
                    <div class="divPopInfo">
                        <img class='imgPopX' src="plugins/galaxyInfinity/admin/public/img/population/<?=$pop['imagePop']?>" alt="">
                        <p><?=$pop['nomPop']?></p>
                    </div>
                    <div class="divPopProd">
                        <p><?=$pop['nombre_pop']?></p>
                        <?php
                        if($pop['prValide'] == 0 && $pop['verifPopEnCours'] == 0 && $pop['verifFormPop'] == 0){?>
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
</div>
</div>



<script type='text/javascript' src='plugins/galaxyInfinity/user/public/js/jsPopulation/gestionPop.js'></script>
<script type='text/javascript' src='plugins/galaxyInfinity/user/public/js/jsPopulation/mainPop.js'></script>