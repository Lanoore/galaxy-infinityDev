<!DOCTYPE html>
<html>
    <head>
        <title>Galaxy Infinity</title> <!--Remplir ici le titre de votre site-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="config/themes/public/css/templateBase.css">
        <script type=" text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js "></script>
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 	
        <script src="https://kit.fontawesome.com/b8189872a7.js"></script>

       <?php if(!empty($css)){foreach($css as $css){?><link rel="stylesheet" href="<?=$css?>"> <?php }} ?> 
    </head>
    <body>
    <nav class="navGeneral">
       <ul>
            <li class='deroulant'><p>Général</p>
                <ul class='sousListe'>
                    <li><a href="index.php?galaxyInfinity=afficheHomeUser">Général</a></li>
                    <li><a href="index.php?galaxyInfinity=affichePreRequisUser&page=batiment">Pré-Requis</a></li>
                    <li><a href="index.php?galaxyInfinity=afficheGalaxieUser&systeme=1">Galaxie</a></li>
                    <li><a href="index.php?galaxyInfinity=afficheReglesUser">Règles</a></li>
                </ul>
                
            </li>

            <li class='deroulant'><p>Planete</p>
                <ul class='sousListe'>
                    <li><a href="index.php?galaxyInfinity=afficheBatimentUser&tier=1">Batiment</a></li>
                    <li><a href="index.php?galaxyInfinity=afficheTechnologieUser&tier=1">Technologie</a></li>
                    <li><a href="index.php?galaxyInfinity=afficheCraftUser&tier=1">Craft</a></li>
                </ul>
            </li>

            <li class='deroulant'><p>Social</p>
                <ul class='sousListe'>
                    <li><a href="index.php?forum=afficheCategories">Forum</a></li>
                    <li><a href="index.php?chat=afficheChat">Chat</a></li>
                    <li><a href="index.php?user=afficheUser">Profil</a></li>
                </ul>
            </li>
       </ul>  
    </nav>


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

