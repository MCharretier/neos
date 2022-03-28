<?php
session_start();
require_once "pdo.php";

if ($_POST) {
    extract($_POST);
    $errors = false;

    if (empty($title)) {
        echo '<div class="alert">Veuillez indiquer un Titre à votre Post !</div>';
        $errors = true;
    }else {
        
        if(strlen($title) > 20){
            
            echo '<div class="alert">Votre titre doit contenir au maximum 20 caractères !</div>';
            $errors = true;
        }else{
            if(count(explode(" ",$title)) == 2){
                $title=explode(" ",$title);
                    for($i=0; $i < count($title); $i++){
                        if(strlen($title[$i])>= 10){
                            $title=implode("",$title);
                            $title = wordwrap($title,10," ",true);  
                                
                            break;  
                        }else{
                            $title= implode(" ",$title);
                            
                            break;
                        }
                    }
            
            }else if(count(explode(" ",$title)) > 2){
                echo '<div class="alert">Votre titre doit contenir qu\'un seul espace !</div>';
                $errors = true;
            } else if(strlen($title)>=10){
                $title = wordwrap($title,10," ",true);
                
            }
           
            
        }

    }
    
    if (!empty($hashtag)) {
        if(is_numeric($hashtag)){
            if(strlen($hashtag) <= 10){

            }else{
                echo '<div class="alert">Le hashtag doit contenir 10 chiffres au maximum !</div>';
            }
        }else{
            echo '<div class="alert">Le hashtag doit contenir que des chiffres !</div>';
        }
    }
    
    
    if (!empty($description)) {
        if(strlen($description) > 300){
            echo '<div class="alert">La description doit contenir 300 caractère au maximum !</div>';
        }
    }
    
    if (empty($file)) {
        echo '<div class="alert">Ajouter une image à votre Post !</div>';
        $errors = true;
    }

    if(!$errors){
        if(empty($hashtag) && empty($description)){
         $query = $pdo->prepare("INSERT INTO posts (user_id,title,image,date) VALUES (?,?,?,CURDATE());");
        }else if(empty($hashtag) && !empty($description)){
            $query = $pdo->prepare("INSERT INTO posts (user_id,title,image,date,description) VALUES (?,?,?,CURDATE(),?);");
            $query->bindValue(4,$description);
        }else if(!empty($hashtag) && empty($description)){
            $query = $pdo->prepare("INSERT INTO posts (user_id,title,image,date,hashtag) VALUES (?,?,?,CURDATE(),?);");
            $query->bindValue(4,$hashtag);
        }else{
            $query = $pdo->prepare("INSERT INTO posts (user_id,title,image,date,hashtag,description) VALUES (?,?,?,CURDATE(),?,?);");
            $query->bindValue(4,$hashtag);
            $query->bindValue(5,$description);
        }
         $query->bindValue(1,$_SESSION['id']);
         $query->bindValue(2,$title);
         $query->bindValue(3,$file);
         $query->execute();
         echo 'OK';
        }   
    }

?>
