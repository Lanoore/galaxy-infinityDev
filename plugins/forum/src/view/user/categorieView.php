
        <link href="../plugins/forum/public/css/user/categorieView.css" rel="stylesheet">
<div>

    
        <h2><?=$categorie['nom'];?></h2>
        <div class='topics'>
        <?php

    
        foreach($topics as $topic){?>
            <div class ='topic'>
                <div class='tNomTAuteur'>
                    <p><a href="index.php?forum=afficheTopic&idTopic=<?=$topic['id']?>&page=1"><?=$topic['nom']?></a></p>
                    <p><?=$topic['auteur']?></p>
                </div>
                <div class='tDateCAuteur'>
                    <p>Dernier message:<?=$lastCommentaires[$topic['id']]['dateCreation']?></p>
                    <p>Auteur: <?=$lastCommentaires[$topic['id']]['auteur']?></p>
                </div>
            </div>
        <?php }
    ?>
    </div>
    <a href="index.php?forum=afficheCreateTopic&idCategorie=<?=$categorie['id']?>"><input type="button" value="Nouveau Topic"></a>

    <div class="paginationTopic">
        <?php


        for($i=1;$i<=$pagination['topicsTotaux']; $i++){
            if($i == $pagination['pageCourante']){
                echo '<span>'.$i.'</span>';
            }
            else{
                echo '<span><a href="index.php?forum=afficheCategorie&idCategorie='.$categorie['id'].'&page='.$i.'">'.$i.'</a></span>';
            }
        }
        
        ?>
    </div>

</div>




