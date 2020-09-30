<!DOCTYPE html>
<html>
    <head>
        <title>Galaxy Infinity</title> <!--Remplir ici le titre de votre site-->
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="config/themes/public/css/templateBase.css">

        <?php if(!empty($css)){foreach($css as $css){?><link rel="stylesheet" href="<?=$css?>"> <?php }} ?> 
    </head>
    <body>

        <div class='divPlugins'>
            <?php
                foreach ($views as $view) {
                    echo $view;
                }
            ?>
        </div>
    </body>
</html>

