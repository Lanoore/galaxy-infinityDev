

<div>
    <p>Pseudo: <?= $_SESSION['pseudo']?></p>
    <p>Email: <?= $_SESSION['email']?></p>
    <p>Dernière connexion: <?= $_SESSION['lastConnexion']?></p>
    <p>Date d'inscription: <?= $_SESSION['dateInscription']?></p>

    <p><a href="index.php?user=disconnectUser">Se déconecter</a></p>

</div>




<link rel="stylesheet" href="../plugins/user/public/css/userInfoView.css">