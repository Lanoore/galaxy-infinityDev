<div>

    <nav class='navPr'>
        <ul>
            <li><a href="index.php?galaxyInfinity=affichePreRequisUser&page=batiment">Batiment</a></li>
            <li><a href="index.php?galaxyInfinity=affichePreRequisUser&page=technologie">Technologie</a></li>
            <li><a href="index.php?galaxyInfinity=affichePreRequisUser&page=craft">Craft</a></li>
            <li><a href="index.php?galaxyInfinity=affichePreRequisUser&page=population">Population</a></li>
        </ul>

    </nav>


    <div>
    <?php
        
    
        foreach($preRequisBaseX as $pRBase){?>
        <div class='divPrX'>
            <h4><?=$pRBase['nom']?></h4>
            <div>
                <?php 
                $count = 0;
                    foreach ($preRequisX as $pRX) {
                        if($pRX['pRTypeX'] == $pRBase['id']){
                            if(!empty($pRX['batiment_id_requis']) ){
                                $count++;
                                ?><p><?=$pRX['nom_batiment']?>(<?=$pRX['niveau_id_batiment']?>)</p>
                        <?php }
                            if(!empty($pRX['technologie_id_requis'])){
                                $count++;
                                ?><p><?=$pRX['nom_technologie']?>(<?=$pRX['niveau_id_technologie']?>)</p>
                        <?php } 
                        }
                    }
                    if($count <= 0){?>
                        <p>Aucun pré-requis</p>
                    <?php } 
                ?>
            </div>
        </div>
<?php }?>

    </div>
</div>