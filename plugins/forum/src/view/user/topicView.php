

<link rel="stylesheet" href="../plugins/forum/public/css/user/topicView.css" >

<div class='topic'>
    <h3><?= $topic['nom']?></h3>

    <div class='divTopic'>   
        <p><?=$topic['auteur']?></p>
        <div>
            <p class='pDateTopic'><?= $topic['dateCreation']?></p>
            <p><?=html_entity_decode($topic['message'])?></p>

            <?php if($topic['auteur'] = $_SESSION['pseudo']){?> <a href="index.php?forum=afficheModifTopic&idTopic=<?=$topic['id']?>"><input type="button" value="Modifier le topic"></a><?php }?>
        </div>
        
    </div>
    
    <div class='divCommentaireCreate'>
        <form action="index.php?forum=createCommentaire&idTopic=<?=$topic['id']?>" method='POST'>

            <div>
                <label for="commentaire">Commentaire</label>
                <textarea name="commentaire" id="commentaire" ></textarea>
            </div>
            <div>
                <input type="submit">
            </div>

        </form>

    </div>

    <div class='divCommentaires'>
        <?php
            foreach($commentaires as $commentaire){?>
                <div class='commentaire'>
                    <p><?=$commentaire['auteur']?></p>
                    <div>
                        <p class='dateCommentaire'><?=$commentaire['dateCreation']?></p>
                        <p><?=$commentaire['message']?></p>
                    </div>
                </div>
            <?php }

        ?>
    </div>

    <div class="paginationTopic">
        <?php


        for($i=1;$i<=$pagination['commentairesTotaux']; $i++){
            if($i == $pagination['pageCourante']){
                echo '<span>'.$i.'</span>';
            }
            else{
                echo '<span><a href="index.php?forum=afficheTopic&idTopic='.$topic['id'].'&page='.$i.'">'.$i.'</a></span>';
            }
        }
        
        ?>
    </div>
</div>


<script src="https://cdn.tiny.cloud/1/amz2qjsjr01macp4mb7y8pp67yd2hezik8v80zu2a2v8rww6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script><script>tinymce.init({selector: '#commentaire'});</script>
