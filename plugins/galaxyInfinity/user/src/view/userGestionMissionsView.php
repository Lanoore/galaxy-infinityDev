

<div class="mainDiv">   
    <div>
        <p>Missions Principales (A venir avec la feature "Histoire")</p>
        <?php
            foreach($missions as $mission){
                if($mission['type'] == 3){?>
                    <p><?=$mission['nom']?></p>
                <?php }
            }
        ?>
    </div>
    <div>
        <p>Missions Militaires</p>
        <?php
            foreach($missions as $mission){
                if($mission['type'] == 2){?>
                    <p><?=$mission['nom']?></p>
                <?php }
            }
        ?>
    </div>
    <div>
        <p>Missions Diplomaties</p>
        <?php
            foreach($missions as $mission){
                if($mission['type'] == 1){?>
                    <div class="missionDiplo">
                        <div class="missionDiploGeneral">
                            <p>Mission de niveau:<?=$mission['niveau']?></p>
                            <p><?=$mission['nom']?></p>
                            <button class="buttonMissionDiplo">Lancer</button>
                        </div>
                        <div class="missionDiploInfo">
                            <div class="boxContentMissionDiplo">
                                <span class="closeMissionDiplo">&times;</span>
                                <h3 class="titreMissionBoxInfo"><?=$mission['nom']?></h3>
                                <p class="descrMissionBoxInfo">Synopsis:<br/><?=$mission['description']?></p>
                                <hr>
                                <div class="recompensePréRequis">
                                    <div class="Récompenses">
                                        Récompenses :
                                    </div>
                                    <div class="preRequis">
                                        Pré requis :
                                    </div>
                                </div>
                                <hr>
                                <button class="lancerMissionDiplo">Lancer</button>
                            </div>
                        </div>
                        
                    </div>
                    
                <?php }
            }
        ?>
    </div>

</div>





<script type='text/javascript' src='plugins/galaxyInfinity/user/public/js/jsMissions/gestionMissions.js'></script>
<script type='text/javascript' src='plugins/galaxyInfinity/user/public/js/jsMissions/mainMissions.js'></script>