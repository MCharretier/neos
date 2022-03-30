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
    <title>Accueil</title>
</head>
<body>
<header>

    <a href="../templates/profil.php?id=<?= $_SESSION["id"]?>"><img src="../img/icone/photo_profil.svg" alt="Photo de votre profil"></a>
    <img class="logo" src="../img/logo/logo_fond_noir.png" alt="Logo Neos">
    <a href=""><img src="../img/icone/recherche.svg" alt="Page recherche"></a>

</header>
    <main>

        <nav>
            <ul>
                <li class="active"><a href="../templates/accueil.php"><img class="icone" src="../img/icone/accueil.svg" alt="Lien vers la page d'accueil"></a></li>
                <li><div class="barre"></div></li>
                <li><a href=""><img class="icone" src="../img/icone/recherche.svg" alt="Lien vers la page de recherche"></a></li>
                <li><div class="barre"></div></li>
                <li><a href="../templates/crea_post.php"><img class="icone" src="../img/icone/publier.svg" alt="Lien vers la page de publication"></a></li>
                <li><div class="barre"></div></li>
                <li><a href=""><img class="icone" src="../img/icone/message.svg" alt="Lien vers la page de message"></a></li>
                <li><div class="barre"></div></li>
                <li><a href="../templates/profil.php?id=<?= $_SESSION["id"]?>"><img class="icone" src="../img/icone/profil.svg" alt="Lien vers la page de profil"></a></li>
            </ul>
            
        </nav>
        
       <div class="corps">

            <img class="logo" src="../img/logo/logo_+_texte_noir.png" alt="Logo Neos">

            <div class="cadre">

                <div class="carousel">
                    <?php 
                    $query = $pdo->prepare("SELECT * FROM posts AS P ORDER BY id DESC");
                    
                    $query->execute();
                    $post =$query->fetchAll();                         
                    ?>  
                    <?php for($i=0; $i<count($post); $i++): ?> 
                        <a href="../templates/post.php?id=<?=$post[$i]['id'];?>">
                            <div class="post">
                                <img class="nft" src="<?=$post[$i]['image'];?>" alt="NFT">
                                <div class="marge">
                                    <div class="text">
                                        <img class="pp" src="../img/icone/photo_profil.svg" alt="photo de profil">
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
            <li><a href=""><img class="icone" src="../img/icone/message.svg" alt="Lien vers la page de message"></a></li>
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