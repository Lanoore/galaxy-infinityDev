<!DOCTYPE html>
<html>
    <head>
        <title>Titre</title> <!--Remplir ici le titre de votre site-->
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, user-scalable=no">

        <?php if(isset($css)){echo $css;}?> <!--Pensez a ajoutez une boucle pour chaque entré de chaque view pour le css-->
    </head>
    <body>
        <div>
            <?php
                foreach ($views as $view) {
                    echo $view;
                }
            ?>
        </div>
    </body>
</html>

