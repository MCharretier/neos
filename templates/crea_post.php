<?php
    session_start();
    if (!empty($_SESSION)){
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/post.css">
    <title>Accueil</title>
</head>
<body>
    <main>

        <nav>
            <ul>
                <li><a href="../templates/accueil.php"><img class="icone" src="../img/icone/accueil.svg" alt="Lien vers la page d'accueil"></a></li>
                <li><div class="barre"></div></li>
                <li><a href=""><img class="icone" src="../img/icone/recherche.svg" alt="Lien vers la page de recherche"></a></li>
                <li><div class="barre"></div></li>
                <li><a href="../templates/crea_post.php"><img class="icone" src="../img/icone/publier.svg" alt="Lien vers la page de publication"></a></li>
                <li><div class="barre"></div></li>
                <li><a href=""><img class="icone" src="../img/icone/message.svg" alt="Lien vers la page de message"></a></li>
                <li><div class="barre"></div></li>
                <li><a href=""><img class="icone" src="../img/icone/profil.svg" alt="Lien vers la page de profil"></a></li>
            </ul>
        </nav>

        <div class="corps">

            <img class="logo" src="../img/logo/logo_+_texte_noir.png" alt="Logo Neos">

            <form action="" method="post" enctype="multipart/form-data" class="cadre">

                <div class="contenu">
                    <div class="import">
                        <input type="file" class="select">
                        <p>Importer votre NFT</p>
                        <img src="../img/icone/plus.svg" alt="Importer votre NFT">
                        <div class="fake">Sélectionner</div>
                    </div>

                    <div class="info">
                        <input type="text" name="name" class="name" placeholder="Nom du NFT">
                        <input type="text" name="hastag" class="name" placeholder="Hastag du NFT">
                        <input type="text" name="description" class="description" placeholder="Description du NFT">
                    </div>
                </div>

                <button type="submit" class="publier">Publier</button>

            </form>

        </div>    

    </main>
    
</body>
</html>