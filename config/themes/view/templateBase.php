<!DOCTYPE html>
<html>
    <head>
        <title>Galaxy Infinity</title> <!--Remplir ici le titre de votre site-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="../config/themes/public/css/templateBase.css">
        <?php if(isset($css)){echo $css;}?> <!--Pensez a ajoutez une boucle pour chaque entré de chaque view pour le css-->
    </head>
    <body>
    <nav>
       <ul>
            <li><a href="index.php?forum=afficheCategories">Forum</a></li>
            <li><a href="index.php?chat=afficheChat">Chat</a></li>
            <li><a href="index.php?user=afficheUser">Profil</a></li>
       </ul>  
    </nav>


        <div class='divPlugins'>
            <?php
                foreach ($views as $view) {
                    echo $view;
                }
            ?>
        </div>
    </body>
</html>

