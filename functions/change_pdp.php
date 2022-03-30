<?php
    require_once 'pdo.php';
    session_start();
    if($_POST){ 
           
        extract($_POST);
        if(!empty($pdp)){
            
            $query=$pdo->prepare('UPDATE users SET image=? WHERE id=?;');
            $query->bindValue(1,$pdp);
            $query->bindValue(2,$_SESSION['id']);
            $query->execute();
            echo $pdp;
        }else{
            echo "ERROR";
        }
    }else{
        echo "ERROR";
    }

    ?>