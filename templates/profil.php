<?php
    session_start();
    require_once '../functions/pdo.php';
    if (!empty($_SESSION)){
        if ($_GET){
            
            $query = $pdo->prepare('SELECT image, pseudo, bio, nb_abonnes, nb_abonnement FROM users WHERE id=?;');
            $query->bindValue(1, $_GET['id']);
            $query->execute();
            $user = $query->fetch();
            if(!empty($user)){

            
            
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/profil.css">
    <link rel="icon" type="image/x-icon" href="../img/logo/logo_fond_carré.ico">
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
                <li><a href="../templates/crea_post.php"><img class="icone" src="../img/icone/publier.svg" alt="Lien vers la page de publication"></a></li>
                <li><div class="barre"></div></li>
                <li><a href="../templates/indispo.php"><img class="icone" src="../img/icone/message.svg" alt="Lien vers la page de message"></a></li>
                <li><div class="barre"></div></li>
                <li class="active"><a href="../templates/profil.php?id=<?= $_SESSION['id']?>"><img class="icone" src="../img/icone/profil.svg" alt="Lien vers la page de profil"></a></li>
            </ul>
            
        </nav>
        
       <div class="corps">

            <img class="logo" src="../img/logo/logo_+_texte_noir.png" alt="Logo Neos">

            <div class="cadre">

                <?php
                $query = $pdo->prepare('SELECT image, pseudo, bio, nb_abonnes, nb_abonnement FROM users WHERE id=?;');
                $query->bindValue(1, $_GET['id']);
                $query->execute();
                $user = $query->fetch();
                ?>

                <div class="user">

                    <img id="photodp" src="<?= $user['image']?>" alt="Photo de profil de <?= $user['pseudo']?>">

                    <div class="info">

                        <span class="nom">
                            <p class="titre">Nom</p>
                            <p class="text"><?= $user['pseudo']?></p>
                        </span>

                        <span class="desc">
                            <p class="titre">Description</p>
                            <p class="text_ita" id="bio" ><?= $user['bio']?></p>
                        </span>

                    </div>

                    <div class="abo">

                        <div class="stat">

                            <span class="abonnés">
                                <p class="title">Abonnés</p>
                                <p class="text" id="nb_abonnes"><?= $user['nb_abonnes']?></p>
                            </span>

                            <span class="abonnements">
                                <p class="title">Abonnements</p>
                                <p class="text" id="nb_abonnement"><?= $user['nb_abonnement']?></p>
                            </span>

                        </div>

                        <div class="bouton">
                            <?php if ($_SESSION['id'] != $_GET['id']):?>
                            <div class="buttons">
                                
                                    <?php 
                                        $query=$pdo->prepare("SELECT * FROM abonnements WHERE id_abonnes=? AND id_abonnement=?");
                                        $query->bindValue(1,$_SESSION['id']);
                                        $query->bindValue(2,$_GET['id']);
                                        $query->execute();
                                        $abo=$query->fetch();
                                        
                                    ?>
                                    <?php if(empty($abo)):?>
                                        <button class="grand" id="abonner">S'abonner</button>
                                    <?php else:?>
                                        <button class="grand" id="abonner">Abonné</button>
                                    <?php  endif;?>
                                
                                <button class="autre" id="open_reports">...</button>
                            </div>
                            <div id="report" >
                                <button class="grand">Signaler</button>
                                <button class="grand">Bloquer</button>
                            </div>
                            <?php else:?>
                            <button class="autre" id="open_settings">Paramètres</button>
                            <?php endif;?>
                        </div>

                    </div>

                </div>

                <?php
                $query = $pdo->prepare('SELECT id, title, image FROM posts WHERE user_id=? ORDER BY id DESC;');
                $query->bindValue(1, $_GET['id']);
                $query->execute();
                $posts = $query->fetchAll();
                ?>

                <div class="collection">

                    <p class="titre">Collections</p>

                    <div class="nft">

                        <?php for($i=0; $i<count($posts); $i++): ?> 
                        <a href="post.php?id=<?= $posts[$i]['id']?>">
                            <img class="post" src="<?= $posts[$i]['image']?>" alt="<?= $posts[$i]['title']?>">
                        </a>
                        <?php endfor; ?>
                        
                    </div>

                </div>

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

    <div class="settings">
        <div class="popup">
        <button id="change_mdp">Changer de mot de passe</button>
        <button id="change_pdp">Changer de photo de profil</button>
        <button id="change_description">Changer de description</button>
        <button>Confidentialité et sécurité</button>
        <button>Notifications</button>
        <button id="deconnexion">Déconnexion</button>
        <button id="annuler">Annuler</button>
        </div>

        <form action="" method="post" id="new_description">
            <img src="../img/icone/retour.svg" class="return">
            <textarea name="description" placeholder="Nouvelle description..."></textarea>
            <button type="submit" value="changer">Valider</button>
        </form>

        <form action="" method="post" enctype="multipart/form-data" id="new_pdp">
            <img src="../img/icone/retour.svg" class="return">
            <div>
                <input type="file" name="pdp" id="pdp">
                <img src="../img/icone/plus.svg" alt="Choisir une photo de profil" id="plus">
            </div>
            <button type="submit">Valider</button>
        </form>

        <form action="" method="post" id="new_mdp">
            <img src="../img/icone/retour.svg" class="return">
            <input type="password" name="old_password" placeholder="Ancien mot de passe...">
            <input type="password" name="new_password" placeholder="Nouveau mot de passe...">
            <input type="password" name="confirm_new_password" placeholder="Confirmez le nouveau mot de passe...">
            <button type="submit">Valider</button>
        </form>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/profil.js"></script>
</body>
</html>

<?php
        }else{
            header('Location: accueil.php');
        }
    }
    else {
        header('Location: accueil.php');
    }
}
    else {
        header('Location: ../index.php');
    }
?>