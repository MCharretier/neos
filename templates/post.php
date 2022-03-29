<?php
    session_start();
    require_once "../functions/pdo.php";
    if (!empty($_SESSION)){
        if($_GET){
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
                        <div class="nom" name="image_post">CLONEX</div>
                        <div class="hastag" name="hastag_post">#12428</div>
                        <div class="description" name="description_post">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra turpis eget placerat porttitor. Ut nec lacinia odio. </div>
                    </div>

                </div>

                <div class="commentaire">

                    <div class="top">
                        <img src="../img/icone/commentaire.svg" alt="Espace commentaire">
                        <h1>Commentaires</h1>
                        <img src="../img/icone/partage.svg" alt="Partager le contenu">
                    </div>
                    <?php
                        
                        $query = $pdo->prepare("SELECT * FROM users AS U INNER JOIN comments AS C ON U.id = C.user_id INNER JOIN posts AS P ON P.id = C.post_id WHERE C.post_id=? ");
                        $query->bindValue(1,$_GET["id"]);
                        $query->execute();
                        $comments =$query->fetchAll(); 
                    ?>
                    <?php for($i=0; $i<count($comments); $i++):?>
                    <div class="msg">
                        <div class="user">
                            <img src="../img/icone/photo_profil.svg" alt="Photo de profil de user4589">
                            <h2><?= $comments[$i]['pseudo'];?></h2>
                        </div>
                        <p><?= $comments[$i]['comment'];?></p>
                    </div>
                    <?php if($i+1 != count($comments)):?>
                    <div class="barre"></div>
                    <?php endif;?>
                    <?php endfor;?>
                    <form action="" method="post" id="add" class="add">
                        <input type="text" name="comment" placeholder="Ajouter un commentaire...">
                        <button type="submit">Publier</button>
                    </form>

                </div>    

            </div>

        </div>    

    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/commentaire.js"></script>
</body>
</html>

<?php
    }
    else {
        header('Location: accueil.php');
    }
}
    else {
        header('Location: ../index.php');
    }
?>