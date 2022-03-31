<?php
    
    require_once "pdo.php";
    if($_POST){
        extract($_POST);
        if(!empty($recherche)){

        
            $query=$pdo->prepare("SELECT id,pseudo,image FROM users WHERE pseudo LIKE CONCAT(?,'%');");
            $query->bindValue(1,$recherche);
            $query->execute();
            $users=$query->fetchAll();
            if(!empty($users)){
                $user_list ="";
                for($i=0;$i<count($users);$i++){
                    $user_list.=$users[$i]['pseudo'].'#&@'.$users[$i]['image'].'#&@'.$users[$i]['id'];
                    if($i+1 != count($users)){
                        $user_list.= "@&#";
                    }    
                }
                echo $user_list;
            }else{
                echo "ERROR";
            }
        }else{
            echo "ERROR";
        }
    }
?>