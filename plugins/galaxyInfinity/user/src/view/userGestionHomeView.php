<div class='mainDiv' id='mainDiv'>



    <div class='afficheAllConstruEnCours'>
        <div class='afficheXEnCours'>
                <?php
                    if($tempsRestantCraft != NULL){?>
                    <p><?=$tempsRestantCraft['nomCraft']?>:</p>
                    <p id='tempsRestantCraftEnCours'><?=$tempsRestantCraft['tempsDecompteCraft']?>(<?=$tempsRestantCraft['nombreCraft']?>)</p>
                <?php }else{?>
                    <p>Aucune production en cours</p>
                <?php }?>
            
        </div>
        <div class='afficheXEnCours'>
                <?php if($tempsRestantBat != null){?>
                    <p><?=$tempsRestantBat['nomBat']?>:</p>
                    <p id='tempsRestantBatEnCours'><?=$tempsRestantBat['tempsDecompteBat']?>(<?=$tempsRestantBat['niveauBat']?>)</p>
                <?php }else{?>
                    <p>Aucune construction en cours</p>
                <?php }?>
        </div>
        <div class='afficheXEnCours'>

                <?php if($tempsRestantTechno != null){?>
                    <p><?=$tempsRestantTechno['nomTechno']?>:</p>
                    <p id='tempsRestantTechnoEnCours'><?=$tempsRestantTechno['tempsDecompteTechno']?>(<?=$tempsRestantTechno['niveauTechno']?>)</p>
                <?php }else{?>
                    <p>Aucune recherche en cours en cours</p>
                <?php }?>
        </div>
        <div class='afficheXEnCours'>
                <?php if($tempsRestantFormation != null){?>
                    <p><?=$tempsRestantFormation['nomPop']?>:</p>
                    <p id='tempsRestantFormationEnCours'><?=$tempsRestantFormation['tempsDecompteFormation']?>(<?=$tempsRestantFormation['nombrePopForm']?>)</p>
                <?php }else{?>
                    <p>Aucune formation en cours</p>
                <?php }?>
        </div>
    </div>

    <div class="divTierSelect">
        <form action="#" method="get">
            <span>Aperçu d'un tier:</span>
            <select name="tierSelect" id="tierSelect">
                <option value="1">Tier 1</option>
                <option value="2">Tier 2</option>
                <option value="3">Tier 3</option>
                <option value="4">Tier 4</option>
                <option value="5">Tier 5</option>
                <option value="6">Tier 6</option>
                <option value="7">Tier 7</option>
                <option value="8">Tier 8</option>
                <option value="9">Tier 9</option>
                <option value="10">Tier 10</option>
            </select>
            <input type="submit">
        </form>
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
    
    <div>
        <?php
        foreach($allPlaneteUser as $planeteUser){?>
        <div>
            <p id="<?=$planeteUser['id']?>">Nom planete: <?=$planeteUser['nomPlanete']?> </p><button class="nomPlanete">Changer nom</button>
        </div>

        <?php }
        ?>

    </div>

</div>


<script type='text/javascript' src='plugins/galaxyInfinity/user/public/js/jsHome/gestionHome.js'></script>
<script type='text/javascript' src='plugins/galaxyInfinity/user/public/js/jsHome/gestionCraft.js'></script>
<script type='text/javascript' src='plugins/galaxyInfinity/user/public/js/jsHome/gestionBat.js'></script>
<script type='text/javascript' src='plugins/galaxyInfinity/user/public/js/jsHome/gestionRessources.js'></script>
<script type='text/javascript' src='plugins/galaxyInfinity/user/public/js/jsHome/gestionTechno.js'></script>
<script type='text/javascript' src='plugins/galaxyInfinity/user/public/js/jsHome/mainHome.js'></script>