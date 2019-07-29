<?php

class ImageManager extends Model
{

    public function getImages($offset, $limit)
    {
        $this->getBdd();
        return $this->getAllPictures($offset, $limit);
    }

    public function sendImage()
    {
        if (isset($_POST))        
        {
            var_dump('before bdd');
            $this->getBdd();
            var_dump('after bdd');
            //session_start();
            //$user = $_SESSION['id']->getIdUser();
            $user = $_SESSION['id'];
            var_dump($user);
            $img = $_POST['image'];
            var_dump($img);
            $legend = $_POST['legend'];
            var_dump($legend);
            $req = $this->getBdd()->prepare("INSERT INTO image (path, nbLike, idUsers, legend)
            VALUES (:img, :nbLike, :user, :legend)");
            $req->execute([':img' => $img, ':nbLike' => 0, ':user' => $user, ':legend' => $legend]);
            $req->closeCursor();
            //die();
        }
    }

    public function saveImage()
    {
        if (isset($_GET) && !empty($_GET) && isset($_SESSION['id']) && !empty($_SESSION))
        {
            $this->getBdd();
            $img = $_POST['image'];
            
        }


    }


/*
    
    $img = $_POST['image'];
    $folderPath = "upload/";
  
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.png';
  
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);
  
    print_r($fileName);
    ?>
  */

}




