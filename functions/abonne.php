<?php
    require_once 'pdo.php';
    session_start();
    if($_POST){
        extract($_POST);
        $errors=false;
        $link=explode("?",$link);  
        if(count($link) <= 2){
            $parametre=explode("&", $link[1]);
            for($i=0; $i<count($parametre);$i++){
                if(substr($parametre[$i], 0, 2)== "id"){
                    $id=explode("=", $parametre[$i]);
                    $id=$id[1]; 
                }
            }
        }else{
            $errors=true;
        }
        if(!$errors){
            $query=$pdo->prepare("SELECT * FROM abonnements WHERE id_abonnes=? AND id_abonnement=?");
            $query->bindValue(1,$_SESSION['id']);
            $query->bindValue(2,$id);
            $query->execute();
            $abo=$query->fetch();
            if(empty($abo)){      
                $query=$pdo->prepare("INSERT INTO abonnements(id_abonnes, id_abonnement) VALUES (?,?)");
                $query->bindValue(1,$_SESSION['id']);
                $query->bindValue(2,$id);
                $query->execute();
                $query=$pdo->prepare("UPDATE users SET nb_abonnes=nb_abonnes+1 WHERE id=?");
                $query->bindValue(1,$id);
                $query->execute();
                $query=$pdo->prepare("UPDATE users SET nb_abonnement=nb_abonnement+1 WHERE id=?");
                $query->bindValue(1,$_SESSION['id']);
                $query->execute();
                $query=$pdo->prepare("SELECT nb_abonnes, nb_abonnement FROM users WHERE id=?");
                $query->bindValue(1,$id);
                $query->execute();
                $abo=$query->fetch();
                echo "Abonné"." ".$abo['nb_abonnes']." ".$abo['nb_abonnement'];
            }else{
                $query=$pdo->prepare("DELETE FROM abonnements WHERE id_abonnes=? ");
                $query->bindValue(1,$_SESSION['id']);
                $query->execute();
                $query=$pdo->prepare("UPDATE users SET nb_abonnes=nb_abonnes-1 WHERE id=?");
                $query->bindValue(1,$id);
                $query->execute();
                $query=$pdo->prepare("UPDATE users SET nb_abonnement=nb_abonnement-1 WHERE id=?");
                $query->bindValue(1,$_SESSION['id']);
                $query->execute();
                $query=$pdo->prepare("SELECT nb_abonnes, nb_abonnement FROM users WHERE id=?");
                $query->bindValue(1,$id);
                $query->execute();
                $abo=$query->fetch();
                echo "S'abonner"." ".$abo['nb_abonnes']." ".$abo['nb_abonnement'];
            }
            
        }
    }

?>