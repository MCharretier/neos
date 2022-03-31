<?php 
    session_start();
    if (empty($_SESSION)){
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/index.css">
    <title>Accueil</title>
</head>
<body>

    <main>
        <div id="webgl"></div>
        <div class="logoaccueil">
            <img class="logo" src="./img/logo/logo_contour_blanc.png" alt="Logo Neos">
            <img class="logo" src="./img/logo/texte_blanc.png" alt="Logo Neos">
        </div>
        <div class="btn-list">
            <button class="btn blob" data-form="login">
                Connexion
                <span></span><span></span><span></span><span></span>
            </button>
            <button class="btn blob" data-form="register">
                Inscription
                <span></span><span></span><span></span><span></span>
            </button>
        </div>

        <div class="popup" id="login">
            <span class="close-btn"><img class="retour" src="./img/icone/retour.svg" alt="retour"></span>

            <img class="logo2" src="./img/logo/logo_+_texte_noir.png" alt="Logo Neos">
            
            <div class="msg_alert"></div>

            <form class="form" action="" method="post" id="form_login">

                <div>
                    <input type="text" class="email" name="email" placeholder="adresse mail">
                </div>

                <div>
                    <input type="password"  class="password" name="password" placeholder="mot de passe">
                </div>

                <div class="remind">
                    <input type="checkbox" id="remind">
                    <label>Se souvenir de moi ?</label>
                </div>

                <button type="submit" class="btn">connexion</button>

                <div class="barre"></div>

                <label>Mot de passe oublié ?</label>

                <button type="submit" class="btn2">inscription</button>

            </form>

        </div>

        <div class="popup" id="register">
            <span class="close-btn"><img class="retour" src="./img/icone/retour.svg" alt="retour"></span>

            <img class="logo2" src="./img/logo/logo_+_texte_noir.png" alt="Logo Neos">
            
            <div class="msg_alert"></div>

            <form class="form" action="" method="post" id="form_register">

                <div>
                    <input type="text" class="fullName" name="fullName" placeholder="nom complet">
                </div>

                <div>
                    <input type="text" class="user" name="user" placeholder="nom d'utilisateur">
                </div>

                <div>
                    <input type="email" class="email" name="email" placeholder="adresse mail">
                </div>

                <div>
                    <input type="password"  class="password" name="password" placeholder="mot de passe">
                </div>

                <div>
                    <input type="password"  class="password" name="confirm_password" placeholder="confimer le mot de passe">
                </div>

                <button type="submit" class="btn">inscription</button>

                <div class="barre"></div>

                <button type="submit" class="btn2">connexion</button>

            </form>
        </div>
    </main>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/three.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
<?php 
    }else{
        header("Location: templates/accueil.php");   
    } 
?>