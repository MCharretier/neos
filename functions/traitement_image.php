<?php 
    
    $image_path = $_POST['image_path'];
    if(!empty($image_path) && file_exists($image_path)){
        unlink($image_path);
    }
    if (isset($_FILES['file']) && !empty($_FILES['file'])){
/*          var_dump($_FILES['file']); 
 */     $nameFile = $_FILES['file']["name"];
        $typeFile = $_FILES['file']["type"];      
        $tmpFile = $_FILES['file']["tmp_name"];      
        $sizeFile = $_FILES['file']["size"];
        $errorFile = $_FILES['file']["error"];
        $maxWeigth = 1000000000;
        
        if($errorFile <= 0){
            $explode_nameFile = explode(".", $nameFile);
           
            if(count($explode_nameFile) == 2){
                list($width, $height, $type, $attr) = getimagesize($tmpFile);
                if($type>=1 && $type<=3){
                    if($sizeFile <= $maxWeigth){
                        if($width == $height){
                            if($width >= 500){

                                $upload_path = "../upload/" . uniqid() . "." . strtolower(end($explode_nameFile));
                                move_uploaded_file($tmpFile, $upload_path);
                                echo $upload_path;
                                exit();
                            }else{
                                echo '<div class="alert">La résolution de l\'image est trop basse ! (500 x 500)</div>';
                            }
                        }else{
                            echo '<div class="alert">L\'image n\'est pas un carré !</div>';
                        }
                    }else{
                        echo '<div class="alert">Le fichier est trop lourd (1Go) !</div>';
                    }
                }else{
                    echo '<div class="alert">Le fichier doit être un .png, .jpg, .jpeg ou .gif !</div>';
                }  
            }else{
                echo '<div class="alert">Attention, les doubles extensions ne sont pas autorisées !</div>';
            }
        }else{
            echo '<div class="alert">Erreur !</div>';
        }
    }
    
?>