
<div>
    <p>Page de connexion</p>


    <form action="index.php?user=connectUser" method="POST">
        <div>
            <label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo">
        </div>

        <div>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <input type="submit">
        </div>
        <a href="index.php?user=afficheInscription">S'inscrire</a>
    </form>

</div>




<link rel="stylesheet" href="../plugins/user/public/css/connexionView.css">