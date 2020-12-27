

<div>
    <h2>Catégories</h2>
    <div class='categories'>  
    <?php
      
        foreach ($categories as $categorie) {?>

            <div class='categorie'>
                <h4><a href="index.php?forum=afficheCategorie&idCategorie=<?=$categorie['id']?>&page=1"><?=$categorie['nom']?></a></h4>
                <div>
                    

                    <?php if($lastTopics[$categorie['id']] != null){?>
                        <p>Dernier topic :<?=$lastTopics[$categorie['id']]['nom'];?></p>
                       <?php }
                       else{?>
                        <p>Aucun topic</p>
                     <?php  } ?>

                </div>
            </div>
       <?php }
    
    ?>
    </div>
</div>

