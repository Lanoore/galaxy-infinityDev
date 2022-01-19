

<div class="mainDiv">   
    <div>
        <p>Missions Principales (A venir avec la feature "Histoire")</p>
        <?php
            foreach($missions as $mission){
                if($mission['typeMission'] == 3){?>
                    <p><?=$mission['nomMission']?></p>
                <?php }
            }
        ?>
    </div>
    <div>
        <p>Missions Militaires</p>
        <?php
            foreach($missions as $mission){
                if($mission['typeMission'] == 2){?>
                    <p><?=$mission['nomMission']?></p>
                <?php }
            }
        ?>
    </div>
    <div>
        <p>Missions Diplomaties</p>
        <?php
            foreach($missions as $mission){
                if($mission['typeMission'] == 1){?>
                    <div class="missionDiplo">
                        <div class="missionDiploGeneral">
                            <p>Mission de niveau:<?=$mission['niveauMission']?></p>
                            <p><?=$mission['nomMission']?></p>
                            <button class="buttonMissionDiplo">Lancer</button>
                        </div>
                        <div class="missionDiploInfo">
                            <div class="boxContentMissionDiplo">
                                <span class="closeMissionDiplo">&times;</span>
                                <h3 class="titreMissionBoxInfo"><?=$mission['descrMission']?></h3>
                                <p class="descrMissionBoxInfo">Synopsis:<br/><?=$mission['descrMission']?></p>
                                <hr>
                                <div class="recompensePréRequis">
                                    <div class="Récompenses">
                                        <p>Récompenses :</p>
                                        <?php foreach($mission['recMission'] as $recMission){
                                        if($recMission['id_ressource'] != null){?>
                                            <p class="recX"><?=$recMission[11]?> : <?=$recMission['nombre_ressource']?></p>
                                        <?php }
                                        if($recMission['id_items'] != null){?>
                                            <p class="recX"><?=$recMission[9]?> : <?=$recMission['nombre_items']?></p>
                                        <?php }
                                        if($recMission['id_craft'] != null){?>
                                            <p class="recX"><?=$recMission[15]?> : <?=$recMission['nombre_craft']?></p>
                                        <?php }
                                        }?>
                                    </div>
                                    <div class="preRequis">
                                        <p>Pré requis : </p>
                                        <?php foreach($mission['preRequisMission'] as $prMission){
                                        if($prMission['id_bat'] != null){?>
                                            <p class="prX"><?=$prMission[13]?> : <?=$prMission['niveau_bat']?></p>
                                        <?php }
                                        if($prMission['id_pop'] != null){?>
                                            <p class="prX"><?=$prMission[19]?> : <?=$prMission['nombre_pop']?></p>
                                        <?php }
                                        }?>
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