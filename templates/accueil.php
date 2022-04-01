<?php
    session_start();
    require_once "../functions/pdo.php";
    if (!empty($_SESSION)){
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/accueil.css">
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
            $query = $pdo->prepare("SELECT image FROM users");
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

                <div class="carousel">
                    <?php 
                        $query = $pdo->prepare("SELECT P.id AS pid,P.image AS pdp,P.title,P.hashtag,U.id,U.pseudo,U.image FROM posts AS P INNER JOIN users AS U ON U.id=P.user_id ORDER BY P.id DESC");
                        $query->execute();
                        $post =$query->fetchAll();                         
                    ?>  
                    <?php for($i=0; $i<count($post); $i++): ?> 
                        <a href="../templates/post.php?id=<?=$post[$i]['pid'];?>">
                            <div class="post">
                                <img class="nft" src="<?=$post[$i]['pdp'];?>" alt="NFT">
                                
                                <div class="marge">
                                    <div class="text">
                                        <div  class="profil">
                                            
                                            <img class="pp" src="<?= $post[$i]['image'];?> " alt="photo de profil">
                                            <p class="pseudo"><?=$post[$i]['pseudo'];?></p>
                    
                                        </div>
                                        <?php $title=explode(" ",$post[$i]['title']) ?>
                                        <?php if(count($title)>1 || strlen($post[$i]['title'])>10): ?>

                                        <p class="nom dbligne">
                                            <?php 
                                            for($x=0;$x<count($title);$x++) {
                                                echo $title[$x];
                                                echo "<br>";
                                            }
                                            ?>
                                        </p>
                                        <?php else: ?>
                                        <p class="nom"><?=$post[$i]['title'];?></p>
                                        <?php endif; ?>
                                        <?php if(strlen($post[$i]['hashtag'])>0){
                                            $tag="#".$post[$i]['hashtag'];
                                        }else{
                                            $tag="";
                                        }
                                        ?>
                                        <p class="id"><?=$tag;?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endfor; ?>

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
    <script src="../js/accueil.js"></script>
</body>
</html>

<?php
}
    else {
        header('Location: ../index.php');
    }
?>