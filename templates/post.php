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
                <li><a href="../templates/profil.php"><img class="icone" src="../img/icone/profil.svg" alt="Lien vers la page de profil"></a></li>
            </ul>
        </nav>

        <div class="corps">

            <img class="logo" src="../img/logo/logo_+_texte_noir.png" alt="Logo Neos">

            <div class="cadre">

                <img class="retour" src="../img/icone/retour.svg" alt="Retour à l'accueil">

                <div class="info">

                    <img class="nft" src="../img/nft/CloneX.png" alt="NFT de la collection CloneX">

                    <div class="text">
                        <div class="nom">CLONEX</div>
                        <div class="hastag">#12428</div>
                        <div class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra turpis eget placerat porttitor. Ut nec lacinia odio. </div>
                    </div>

                </div>

                <div class="commentaire">

                    <div class="top">
                        <img src="../img/icone/commentaire.svg" alt="Espace commentaire">
                        <h1>Commentaires</h1>
                        <img src="../img/icone/partage.svg" alt="Partager le contenu">
                    </div>

                    <div class="msg">

                        <div class="user">
                            <img src="../img/icone/photo_profil.svg" alt="Photo de profil de user4589">
                            <h2>user4589</h2>
                        </div>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra turpis eget placerat porttitor.</p>

                    </div>

                    <div class="barre"></div>                    
                    
                    <div class="msg">

                        <div class="user">
                            <img src="../img/icone/photo_profil.svg" alt="Photo de profil de user4589">
                            <h2>user4589</h2>
                        </div>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra turpis eget placerat porttitor.</p>

                    </div>

                    <div class="barre"></div>

                    <div class="msg">

                        <div class="user">
                            <img src="../img/icone/photo_profil.svg" alt="Photo de profil de user4589">
                            <h2>user4589</h2>
                        </div>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra turpis eget placerat porttitor.</p>

                    </div>

                    <div class="add">
                        <p>Ajouter un commentaire...</p>
                        <button>Publier</button>
                    </div>

                </div>    

            </div>

        </div>    

    </main>
    
</body>
</html>

<?php
}
    else {
        header('Location: ../index.php');
    }
?>