<div class='mainDiv' id='mainDiv'>


    <div class='afficheAllConstruEnCours'>
        <div class='afficheXEnCours'>
                <?php if($tempsRestantCraft['nomCraft'] != null){?>
                    <p><?=$tempsRestantCraft['nomCraft']?>:</p>
                    <p id='tempsRestantCraftEnCours'><?=$tempsRestantCraft['tempsDecompteCraft']?>(<?=$tempsRestantCraft['nombreCraft']?>)</p>
                <?php }else{?>
                    <p>Aucune construction en cours</p>
                <?php }?>
            
        </div>
        <div class='afficheXEnCours'>
                <?php if($tempsRestantBat['nomBat'] != null){?>
                    <p><?=$tempsRestantBat['nomBat']?>:</p>
                    <p id='tempsRestantBatEnCours'><?=$tempsRestantBat['tempsDecompteBat']?>(<?=$tempsRestantBat['niveauBat']?>)</p>
                <?php }else{?>
                    <p>Aucune construction en cours</p>
                <?php }?>
        </div>
        <div class='afficheXEnCours'>

                <?php if($tempsRestantTechno['nomTechno'] != null){?>
                    <p><?=$tempsRestantTechno['nomTechno']?>:</p>
                    <p id='tempsRestantTechnoEnCours'><?=$tempsRestantTechno['tempsDecompteTechno']?>(<?=$tempsRestantTechno['niveauTechno']?>)</p>
                <?php }else{?>
                    <p>Aucune construction en cours</p>
                <?php }?>
        </div>
    </div>
</div>



<script type='text/javascript' src='../plugins/galaxyInfinity/user/public/js/jsHome/gestionCraft.js'></script>
<script type='text/javascript' src='../plugins/galaxyInfinity/user/public/js/jsHome/gestionBat.js'></script>
<script type='text/javascript' src='../plugins/galaxyInfinity/user/public/js/jsHome/gestionTechno.js'></script>
<script type='text/javascript' src='../plugins/galaxyInfinity/user/public/js/jsHome/mainHome.js'></script>