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
    <link rel="stylesheet" href="../style/recherche.css">
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
                <li ><a href="../templates/accueil.php"><img class="icone" src="../img/icone/accueil.svg" alt="Lien vers la page d'accueil"></a></li>
                <li><div class="barre"></div></li>
                <li class="active"><a href="../templates/recherche.php"><img class="icone" src="../img/icone/recherche.svg" alt="Lien vers la page de recherche"></a></li>
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

            <form action="" method="post" class="recherche">
                <h2>Pour trouver un contact c'est ici !</h2>
                <input type="text" id="recherche" name="recherche" placeholder="Rechercher...">
            </form>

            <div class="liste">
        
            </div>

        </div>

    </main>

    <footer>

        <ul>
            <li><a href="../templates/accueil.php"><img class="icone" src="../img/icone/accueil.svg" alt="Lien vers la page d'accueil"></a></li>
            <li><a href="../templates/crea_post.php"><img class="icone" src="../img/icone/publier.svg" alt="Lien vers la page de publication"></a></li>
            <li><a href="../templates/indispo.php"><img class="icone" src="../img/icone/message.svg" alt="Lien vers la page de message"></a></li>
        </ul>

    </footer>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/recherche.js"></script>
</body>
</html>

<?php
}
    else {
        header('Location: ../index.php');
    }
?>