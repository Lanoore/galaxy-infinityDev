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
    <div class='afficheAll'>
        <div class='afficheAllRessources'>
            <h4>Ressources</h4>
            <?php foreach($allRessources as $ressource){?>
                <p id='<?=$ressource['id']?>'><?=$ressource['nom']?> : <?=$ressource['nombre_ressource']?></p>
        <?php }?>

        </div>
        <div class='afficheAllCraft'>
            <h4>Crafts</h4>
            <?php foreach($allCraft as $craft){?>
                <p id='<?=$craft['id']?>'><?=$craft['nom']?> : <?=$craft['nombre_craft']?></p>
            <?php }?>
        </div>
        <div class='afficheAllBatiment'>
            <h4>Batiments</h4>
            <?php foreach($allBat as $bat){?>
                <p id='<?=$bat['id']?>'><?=$bat['nom']?> : <?=$bat['niveau']?></p>
            <?php }?>
        </div>
        <div class='afficheAllTechnologie'>
            <h4>Technologies</h4>
            <?php foreach($allTechno as $techno){?>
                <p id='<?=$techno['id']?>'><?=$techno['nom']?> : <?=$techno['niveau']?></p>
            <?php }?>
        </div>
    </div>
    
</div>



<script type='text/javascript' src='../plugins/galaxyInfinity/user/public/js/jsHome/gestionCraft.js'></script>
<script type='text/javascript' src='../plugins/galaxyInfinity/user/public/js/jsHome/gestionBat.js'></script>
<script type='text/javascript' src='../plugins/galaxyInfinity/user/public/js/jsHome/gestionRessources.js'></script>
<script type='text/javascript' src='../plugins/galaxyInfinity/user/public/js/jsHome/gestionTechno.js'></script>
<script type='text/javascript' src='../plugins/galaxyInfinity/user/public/js/jsHome/mainHome.js'></script>