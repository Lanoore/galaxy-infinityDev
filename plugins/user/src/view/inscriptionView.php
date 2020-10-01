<link rel="stylesheet" href="../plugins/user/public/css/inscriptionView.css">


<div class='divInscription'>
<p>Page d'inscription</p>

<form action="index.php?user=createUser" method="POST">
        <div>
            <label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo">
        </div>
        <div>
            <label for="email">Adresse Mail</label>
            <input type="email" id="email" name="email">
            
        </div>
        <span id='verifEmailJs'></span>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password">
            
        </div>
        <span id='verifPasswordJs'></span>
        <div>
            <label for="repeatPassword">Répétez le mot de passe</label>
            <input type="password" id="repeatPassword" name="repeatPassword">
        </div>
            <input  type="submit">
            <span id='verifFormJs'></span>
    </form>
    <a href="index.php?user=afficheConnexion">Se connecter</a> <!--Vous pouvez également mettre votre page d'accueil-->
</div>




<script type='text/javascript' src='plugins/user/public/js/gestionUser.js'></script>
<script type='text/javascript' src='plugins/user/public/js/mainUser.js'></script>

