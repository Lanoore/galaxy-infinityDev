<!DOCTYPE html>
<html>
    <head>
        <title>Galaxy Infinity</title> <!--Remplir ici le titre de votre site-->
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="icon" type="image/png" href="public/img/favicon.png"/>
        <link rel="stylesheet" href="config/themes/public/css/templateBase.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 	
        <script src="https://kit.fontawesome.com/b8189872a7.js"></script>

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


    <footer>
        <p>Discord :<a style="color: #7289da" href="https://discord.gg/zJMtdCW"><i class="fab fa-discord fa-2x"></i></a></p>
    </footer> 
    </body>
</html>

