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
    <link rel="stylesheet" href="../style/crea_post.css">
    <title>Accueil</title>
</head>
<body>
    <header>

        <a href="../templates/profil.php?id=<?= $_SESSION["id"]?>"><img src="../img/icone/photo_profil.svg" alt="Photo de votre profil"></a>
        <img class="logo" src="../img/logo/logo_fond_noir.png" alt="Logo Neos">
        <a href="../templates/recherche.php"><img src="../img/icone/recherche.svg" alt="Page recherche"></a>

    </header>
    <main>

        <nav>
            <ul>
                <li><a href="../templates/accueil.php"><img class="icone" src="../img/icone/accueil.svg" alt="Lien vers la page d'accueil"></a></li>
                <li><div class="barre"></div></li>
                <li><a href="../templates/recherche.php"><img class="icone" src="../img/icone/recherche.svg" alt="Lien vers la page de recherche"></a></li>
                <li><div class="barre"></div></li>
                <li class="active"><a href="../templates/crea_post.php"><img class="icone" src="../img/icone/publier.svg" alt="Lien vers la page de publication"></a></li>
                <li><div class="barre"></div></li>
                <li><a href="../templates/indispo.php"><img class="icone" src="../img/icone/message.svg" alt="Lien vers la page de message"></a></li>
                <li><div class="barre"></div></li>
                <li><a href="../templates/profil.php?id=<?= $_SESSION["id"]?>"><img class="icone" src="../img/icone/profil.svg" alt="Lien vers la page de profil"></a></li>
            </ul>
        </nav>

        <div class="corps">

            <img class="logo" src="../img/logo/logo_+_texte_noir.png" alt="Logo Neos">

            <form action="" method="post" enctype="multipart/form-data" class="cadre" id="publication">

                <div class="contenu">
                    <div class="import">
                        <input type="file" name="file" id="file" class="select">
                        <p>Importer votre NFT</p>
                        <img class="plus" src="../img/icone/plus.svg" alt="Importer votre NFT">
                        <div class="fake"><p>Sélectionner</p></div>
                    </div>

                    <div class="info">
                        <input type="text" name="name" class="name" placeholder="Nom du NFT">
                        <input type="text" name="hashtag" class="name" placeholder="Hashtag du NFT">
                        <input type="text" name="description" class="description" placeholder="Description du NFT">
                    </div>
                </div>

                <button type="submit" class="publier">Publier</button>

            </form>
        </div>    
    </main>
    <footer>

        <ul>
            <li><a href="../templates/accueil.php"><img class="icone" src="../img/icone/accueil.svg" alt="Lien vers la page d'accueil"></a></li>
            <li class="active"><a href="../templates/crea_post.php"><img src="../img/icone/publier.svg" alt="Lien vers la page de publication"></a></li>
            <li><a href="../templates/indispo.php"><img class="icone" src="../img/icone/message.svg" alt="Lien vers la page de message"></a></li>
        </ul>

    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/publication.js"></script>
    
</body>
</html>

<?php
}
    else {
        header('Location: ../index.php');
    }
?>