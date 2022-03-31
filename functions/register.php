<?php
require_once "pdo.php";

if($_POST){
    extract($_POST);
    $errors=false;

    if(empty($nom)){
        echo '<div class="alert">Le nom est obligatoire</div>';
        $errors=true;   
    }else{
       $nom = strtolower($nom);
       if(count(explode(' ', $nom)) >= 2){
            $nom = explode(' ', $nom);
            for($i=0; $i<count($nom); $i++){        
                $nom[$i] =  ucfirst($nom[$i]);
        
            }
            $nom = implode(' ', $nom);
        }else {
            echo '<div class="alert">Le nom ET le prénom sont requis !</div>';
            $errors=true;
        }
    }
    
    if(empty($mail)){
        echo '<div class="alert">Le mail est obligatoire</div>';
        $errors=true;   
    }else{
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
        {
            echo '<div class="alert">Veuillez entrez une adresse mail correct </div>';
            $errors=true;  
        } else{
            $query = $pdo->prepare("SELECT mail FROM users WHERE mail = ?;");
            $query->bindValue(1,$mail);
            $query->execute();
            $user = $query->fetch();
            
            if(!empty($user)){
               echo '<div class="alert">Un compte existe déjà avec cette adresse mail</div>';
                $errors=true;
            }
        }
    } 
    
    if(empty($username)){
        echo '<div class="alert">Le nom d\'utilisateurs est obligatoire</div>';
        $errors=true;   
    }
    else{
        $query = $pdo->prepare("SELECT pseudo FROM users WHERE pseudo = ?;");
        $query->bindValue(1,$username);
        $query->execute();
        $user = $query->fetch();
        
        if(!empty($user)){
           echo '<div class="alert">Un compte existe déjà avec ce nom d\'utilisateur </div>';
            $errors=true;
        }
    }
    if(empty($password)){
        echo '<div class="alert">Le mot de passe est obligatoire</div>'; 
        $errors=true;  
    }
    
    if(strlen($password) >= 8){
        if(empty($confirm_password)){
            echo '<div class="alert">La confirmation de mot de passe est obligatoire</div>';
            $errors=true;   
        }else{
            if($confirm_password!=$password){
                echo '<div class="alert">Les mots de passes sont différents</div>';
                $errors=true;  
            }
        }
    }else{
        echo '<div class="alert">Entrez au minimum 8 caractères</div>';
        $errors=true;  
    }

    if(!$errors){
      
        $query = $pdo->prepare("INSERT INTO users (nom,pseudo,mail,password) VALUES(?,?,?,?);");
        $query->bindValue(1,$nom);
        $query->bindValue(2,$username);
        $query->bindValue(3,$mail);
        $query->bindValue(4,hash("sha1",$password));
        $query->execute();

        $query = $pdo->prepare("SELECT * FROM users WHERE mail = ? AND password = ?");
        $query->bindValue(1, $mail);
        $query->bindValue(2,hash("sha1",$password));
        $query->execute();
        $user = $query->fetch(); 
        
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['nom'];
        $_SESSION['mail'] = $user['mail'];
        $_SESSION['pseudo'] = $user['pseudo'];
        $_SESSION['statut'] = $user['statut'];

        echo 'OK';
    }

}
?>