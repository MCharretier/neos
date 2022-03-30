<?php
    require_once 'pdo.php';
    session_start();
    if($_POST){
        
        extract($_POST);
        if(!empty($description)){
            if(strlen($description)<=255){
                $query=$pdo->prepare('UPDATE users SET bio = ? WHERE id=?;');
                $query->bindValue(1,$description);
                $query->bindValue(2,$_SESSION['id']);
                $query->execute();
                echo $description;  
                  
            }else{
                echo "ERROR";
            }
        }else{
            echo "ERROR";
        }
        
    }else{
        echo "ERROR";
    }

?>