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
    <link rel="icon" type="image/x-icon" href="../img/logo/logo_fond_carré.ico">
    <title>Accueil</title>
</head>
<body>
    <header>

        <a href="../templates/profil.php?id=<?= $_SESSION["id"]?>"><img src="../img/icone/photo_profil.svg" alt="Photo de votre profil"></a>
        <a href="../templates/accueil.php"><img class="logo" src="../img/logo/logo_fond_noir.png" alt="Logo Neos"></a>
        <a href="../templates/recherche.php"><img src="../img/icone/recherche.svg" alt="Page recherche"></a>

    </header>
    <main>

        <?php 
            $query = $pdo->prepare("SELECT image FROM users WHERE id=?");
            $query->bindValue(1, $_SESSION['id']);
            $query->execute();
            $nav_img =$query->fetch();                         
        ?>  
        <nav>
            <ul>
                <li class="active"><a href="../templates/accueil.php"><img class="icone" src="../img/icone/accueil.svg" alt="Lien vers la page d'accueil"></a></li>
                <li><div class="barre"></div></li>
                <li><a href="../templates/recherche.php"><img class="icone" src="../img/icone/recherche.svg" alt="Lien vers la page de recherche"></a></li>
                <li><div class="barre"></div></li>
                <li><a href="../templates/crea_post.php"><img class="icone" src="../img/icone/publier.svg" alt="Lien vers la page de publication"></a></li>
                <li><div class="barre"></div></li>
                <li><a href="../templates/indispo.php"><img class="icone" src="../img/icone/message.svg" alt="Lien vers la page de message"></a></li>
                <li><div class="barre"></div></li>
                <li><a href="../templates/profil.php?id=<?= $_SESSION["id"]?>"><img class="icone" src="<?= $nav_img['image'];?>" alt="Lien vers la page de profil"></a></li>
            </ul>
            
        </nav>

        <div class="corps">

            <a href="../templates/accueil.php"><img class="logo" src="../img/logo/logo_+_texte_noir.png" alt="Logo Neos"></a>

            <div class="cadre">

                <a href="../templates/accueil.php"><img class="retour" src="../img/icone/retour.svg" alt="Retour à l'accueil"></a>
                
                <?php 
                    $query = $pdo->prepare("SELECT P.image AS pimage,P.hashtag,P.title,P.description, U.image AS pdp, U.id AS uid, U.pseudo FROM posts AS P INNER JOIN users AS U ON U.id = P.user_id WHERE P.id=?");
                    $query->bindValue(1,$_GET['id']);
                    $query->execute();
                    $post =$query->fetch();                         
                ?>  


                <div class="info">
                    <a href="../templates/profil.php?id=<?= $post['uid'];?>" class="post_image">
                        <div class="profil">
                            <img id="pp" src="<?= $post['pdp'];?> " alt="photo de profil">
                            <p class="pseudo"><?=$post['pseudo'];?></p>
                        </div>
                        <img class="nft" src="<?=$post['pimage'];?>" alt="<?=$post['title'];?>">
                    </a>
                    

                    <div class="text">
                        <div class="nom" name="image_post"><?=$post['title'];?></div>
                        <?php if(strlen($post['hashtag'])>0){
                                $tag="#".$post['hashtag'];
                            }else{
                                $tag="";
                            }
                        ?>
                        <div class="hashtag" name="hashtag_post"><?=$tag;?></div>
                        <div class="description" name="description_post"><?=$post['description'];?></div>
                        
                    </div>

                </div>

                <div class="commentaire">

                    <div class="top">
                        <img src="../img/icone/commentaire.svg" alt="Espace commentaire">
                        <h1>Commentaires</h1>
                        <img src="../img/icone/partage.svg" alt="Partager le contenu">
                    </div>
                    <?php
                        
                        $query = $pdo->prepare("SELECT U.pseudo,C.comment,U.image FROM users AS U INNER JOIN comments AS C ON U.id = C.user_id INNER JOIN posts AS P ON P.id = C.post_id WHERE C.post_id=? ");
                        $query->bindValue(1,$_GET["id"]);
                        $query->execute();
                        $comments =$query->fetchAll(); 
                    ?>
                    <?php for($i=0; $i<count($comments); $i++):?>
                    <div class="msg">
                        <a href="../templates/profil.php?id=<?= $post['uid'];?>" class="user">
                            <img src="<?= $comments[$i]['image'];?>" alt="Photo de profil de <?= $comments[$i]['pseudo'];?>">
                            <h2><?= $comments[$i]['pseudo'];?></h2>
                        </a>
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
    <footer>

        <ul>
            <li class="active"><a href="../templates/accueil.php"><img class="icone" src="../img/icone/accueil.svg" alt="Lien vers la page d'accueil"></a></li>
            <li><a href="../templates/crea_post.php"><img class="icone" src="../img/icone/publier.svg" alt="Lien vers la page de publication"></a></li>
            <li><a href="../templates/indispo.php"><img class="icone" src="../img/icone/message.svg" alt="Lien vers la page de message"></a></li>
        </ul>

    </footer>

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