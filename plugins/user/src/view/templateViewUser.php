<!DOCTYPE html>
<html>
    <head>
        <title>Titre</title> <!--Remplir ici le titre de votre site-->
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, user-scalable=no">

        <?php if(!empty($css)){foreach($css as $css){?><link rel="stylesheet" href="<?=$css?>"> <?php }} ?> 
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

