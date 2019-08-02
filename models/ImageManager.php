<?php

class ImageManager extends Model
{

    public function getImages($offset, $limit)
    {
        $this->getBdd();
        return $this->getAllPictures($offset, $limit);
    }

    public function getPost($fileimg)
    {
        var_dump($fileimg);
        var_dump('GET POST');
        $req = $this->getBdd()->prepare("SELECT * FROM `image` WHERE path = '$fileimg'");
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        var_dump($data);
        return($data);
        $req->closeCursor();
    }

    public function deleteImage($idImg)
    {
        $req = $this->getBdd()->prepare("DELETE * FROM `image` WHERE id = '$idImg'");
        $req->execute();
        $req->closeCursor();
    }

    public function sendImage()
    {
        if (isset($_POST))        
        {
            $img = $_POST["result"];
//            var_dump($_POST["result"]);
            //$file = $_FILES["file-input"];
            //var_dump($file);
            $filter = $_POST["resultFilter"];
            //$x = $_POST["x"];
            //$y = $_POST["y"];
           // $img = str_replace(' ', '+', $img);
            $img_parts = explode(",", $img);
            //$img_type_data = explode("image/", $img);
            $img = $img_parts[1];
            //urlencode($img_parts[1]);
            //$encodedData = str_replace(' ','+',$img_parts[1]);
            //$decodedData = base64_decode($encodedData);

//            var_dump($img);
            $decodedData = base64_decode($img);

            //var_dump($img_parts[1]);
           // var_dump("helooooooo img      :");
            $id_img = uniqid().'.png';
            $fileimg = UPLOAD_DIR.$id_img;

            $im = imagecreatefromstring($decodedData);
            var_dump($im);
            if ($im !== false) {
                // header('Content-Type: image/png');
                imagepng($im, $fileimg);
                imagedestroy($im);
            }
            else {
                echo 'An error occurred.';
            }
            //file_put_contents($fileimg, $decodeData);
            //file_put_contents($fileimg, "gubjbj");

//            var_dump('before bdd');
            $this->getBdd();
  //          var_dump('after bdd');
            //session_start();
            //$user = $_SESSION['id']->getIdUser();
            $user = $_SESSION['id'];
    //        var_dump($user);
            //$img = $_POST['image'];
            var_dump($fileimg);
            $legend = $_POST['legend'];
       //     var_dump($legend);
            $req = $this->getBdd()->prepare("INSERT INTO image (path, nbLike, idUsers, legend)
            VALUES (:fileimg, :nbLike, :user, :legend)");
            $req->execute([':fileimg' => $fileimg, ':nbLike' => 0, ':user' => $user, ':legend' => $legend]);
            $req->closeCursor();
            return ($fileimg);
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




