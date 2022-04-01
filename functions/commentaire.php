<?php 
session_start();

require_once "pdo.php";
if($_POST){
    extract($_POST);
    $errors = false;
    if(!empty($comment)){
        $link=explode("?",$link);  
        if(count($link) <= 2){
            $parametre=explode("&", $link[1]);
            for($i=0; $i<count($parametre);$i++){
                if(substr($parametre[$i], 0, 2)== "id"){
                    $id=explode("=", $parametre[$i]);
                    $id=$id[1];
                    
                }
            }
        }
    }else{
        $errors=true;
    }
    if(!$errors){
    
     $query = $pdo->prepare("INSERT INTO comments (user_id,post_id,comment,date) VALUES (?,?,?,CURDATE());");
     $query->bindValue(1,$_SESSION['id']);
     $query->bindValue(2,$id);
     $query->bindValue(3,$comment);
     $query->execute();

     $query = $pdo->prepare("SELECT U.pseudo, U.image, U.id FROM users AS U INNER JOIN comments AS C ON U.id = C.user_id WHERE C.user_id =?");
     $query->bindValue(1,$_SESSION['id']);
     $query->execute();
     $com =$query->fetch();

     echo '<div class="barre"></div><div class="msg"><a href="../templates/profil.php?id='.$com['id'].'" class="user"><img src="'.$com['image'].'" alt="Photo de profil de '.$com['pseudo'].'">
     <h2>'.$com['pseudo'].'</h2></a><p>'.$comment.'</p></div>';
    } 
}

?>