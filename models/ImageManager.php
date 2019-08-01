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
            $img = $_POST["result"];
            var_dump($_POST["result"]);
            //$file = $_FILES["file-input"];
            //var_dump($file);
            $filter = $_POST["resultFilter"];
            //$x = $_POST["x"];
            //$y = $_POST["y"];
           // $img = str_replace(' ', '+', $img);
            //$img_parts = explode(";base64,", $img);
            //$img_type_data = explode("image/", $img);
            //$img_type = $img_type_data[1];
            //urlencode($img_parts[1]);
            //$encodedData = str_replace(' ','+',$img_parts[1]);
            //$decodedData = base64_decode($encodedData);

            $decodedData = base64_decode($img);

            //var_dump($img_parts[1]);
            var_dump("helooooooo  blaa deco          :");
            var_dump($decodedData);
            $id_img = uniqid().'.png';

            $fileimg = UPLOAD_DIR.$id_img;
            //file_put_contents($file, $img_b64_decode);
            //file_put_contents($file, "gubjbj");
/*
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
            $req->closeCursor();*/
            //die();
        }
    }

    public function saveImage()
    {
        //if (isset($_GET) && !empty($_GET) && isset($_SESSION['id']) && !empty($_SESSION))
        if (isset($_POST))        
        {
            $this->getBdd();
            $img = $_POST['image'];
            $img_64 = base64_encode($img);
            $folderPath = "tmp/";
        
        //    $image_parts = explode(";base64,", $img);
           // $image_type_aux = explode("image/", $image_parts[0]);
            var_dump("image_parts");
            var_dump($img_64);
            /*var_dump("image_type_aux");
            var_dump($image_type_aux);
            $image_type = $image_type_aux[1];
        
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = uniqid() . '.png';
        
            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);*/
        
            //print_r($fileName);


    
            
        }


    }



}




