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
    <link rel="stylesheet" href="../style/profil.css">
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

                <div class="user">

                    <img src="../img/icone/profil_carre.svg" alt="Photo de profil de user_name">

                    <div class="info">

                        <span class="nom">
                            <p class="titre">Nom</p>
                            <p class="text">user_name</p>
                        </span>

                        <span class="desc">
                            <p class="titre">Description</p>
                            <p class="text_ita">Hello i’m a fan of NFT and i'm happy to share my NFT gallery on Neos with you guys</p>
                        </span>

                    </div>

                    <div class="abo">

                        <div class="stat">

                            <span class="abonnés">
                                <p class="title">Abonnés</p>
                                <p class="text">1256</p>
                            </span>

                            <span class="abonnements">
                                <p class="title">Abonnements</p>
                                <p class="text">125</p>
                            </span>

                        </div>

                        <div class="bouton">

                            <button class="grand">S'abonner</button>

                            <button class="autre">...</button>

                            <span class="report">
                                <button class="grand">Signaler</button>
                                <button class="grand">Bloquer</button>
                            </span>

                        </div>

                    </div>

                </div>

                <div class="collection">

                    <p class="titre">Collections</p>

                    <div class="nft">

                        <?php for($i=0; $i<5; $i++): ?> 
                        <img class="post" src="../img/nft/MekaVerse2.jpg" alt="Nft de la collection Mekaverse" class="nft">
                        <?php endfor; ?>
                        
                    </div>

                </div>

            </div>

        </div>

    </main>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/accueil.js"></script>
</body>
</html>

<?php
}
    else {
        header('Location: ../index.php');
    }
?>