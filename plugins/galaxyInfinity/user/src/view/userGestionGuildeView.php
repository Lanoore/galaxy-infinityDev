


<div>
    <?php
        
        if(!isset($_SESSION['idGuilde'])){?>
            <div>
                <p>Créer sa guilde:</p>
                <form action="index.php?galaxyInfinity=createNewGuilde" method="post">
                    <label for="nomGuilde">Nom de la guilde :</label>
                    <input type="text" name="nomGuilde">
                    <br>
                    <input type="submit">
                </form>
            </div>
            <div>
                <p>Rejoindre une guilde :</p>
                <div>
                    <?php
                        foreach($guilde as $guilde){?>
                            <span class="guildeX">
                                <p>Nom de la guilde : <?= $guilde['nomGuilde']?></p>
                                <a href="index.php?galaxyInfinity=joinGuilde&idGuilde=<?=$guilde['idGuilde']?>">Rejoindre cette guilde</a>
                            </span>
                       <?php }
                    ?>
                </div>
            </div>
        <?php }
        else{?>
            <div>
                
            </div>
        <?php }

    ?>
    

</div>