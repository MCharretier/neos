<?php
    require_once 'pdo.php';
    session_start();
    if($_POST){
        
        extract($_POST);
        if(!empty($old_password)){
            if(!empty($new_password)){
                if(!empty($confirm_new_password)){
                    $query = $pdo->prepare("SELECT password  FROM users WHERE id = ?");
                    $query->bindValue(1, $_SESSION['id']);
                    $query->execute();
                    $mdp = $query->fetch();
                    if($mdp['password'] == hash("sha1",$old_password)){
                        if($new_password == $confirm_new_password){
                            $query=$pdo->prepare('UPDATE users SET password=? WHERE id=?;');
                            $query->bindValue(1,hash("sha1",$new_password));
                            $query->bindValue(2,$_SESSION['id']);
                            $query->execute();
                            session_destroy();
                            
                        }else{
                            echo "ERROR";
                        }
                    }else{
                        echo "ERROR";
                    }
                }else{
                    echo "ERROR";
                }
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