<?php
session_start();
require_once "pdo.php";

if ($_POST) {
    extract($_POST);
    $errors = false;

    // Email
   
    if (empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="alert">L’email est invalide !</div>';
        $errors = true;
    }

    // Mot de passe
   
    if (empty($password)) {
        
        echo '<div class="alert">Le mot de passe est requis !</div>';
        $errors = true;              
    }
    


    if (!$errors) {
        
        
        $query = $pdo->prepare("SELECT *  FROM users WHERE mail = ? AND password = ?");
        $query->bindValue(1, $mail);
        $query->bindValue(2,hash("sha1",$password));
        $query->execute();
    
        // Récupération des résultat
        $user = $query->fetch(); 
       
        if (!empty($user)){
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['nom'];
            $_SESSION['mail'] = $user['mail'];
            $_SESSION['pseudo'] = $user['pseudo'];
            $_SESSION['statut'] = $user['statut'];


            echo 'OK';
        }
        else{
            
            echo '<div class="alert alert-danger" role="alert">Veuillez vous inscrire !</div>';
        }
    }
        exit();
    }

        ?>
?>