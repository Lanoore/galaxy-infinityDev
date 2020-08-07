

<link rel="stylesheet" href="../plugins/forum/public/css/user/categoriesView.css" type='text/css'>
<div>
    <h2>Catégories</h2>
    <div class='categories'>  
    <?php
      
        foreach ($categories as $categorie) {?>
            <div class='categorie'>
                <h4><a href="index.php?forum=afficheCategorie&idCategorie=<?=$categorie['id']?>&page=1"><?=$categorie['nom']?></a></h4>
                <div>
                    <p>Dernier topic :<?=$lastTopics[$categorie['id']]['nom'];?></p>
                </div>
            </div>
       <?php }
    
    ?>
    </div>
</div>

