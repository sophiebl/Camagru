<?php

class ImageManager extends Model
{
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
            var_dump("                filter                 ");
            var_dump($filter);
            $img_parts = explode(",", $img);
            $img = $img_parts[1];
            $decodedData = base64_decode($img);
            $id_img = uniqid().'.png';
            $fileimg = UPLOAD_DIR.$id_img;

            $filter_parts = explode(",", $filter);
            $filter = $filter_parts[1];
            $decodedDataFilter = base64_decode($filter);
            $id_filter = uniqid().'.png';
            $filefilter = UPLOAD_DIR.$id_filter;

            $imagepng = imagecreatefromstring($decodedData);
            $imagefilter = imagecreatefromstring($decodedDataFilter);
            var_dump($imagepng);
            if ($imagepng !== false && $imagefilter !== false) {
                // header('Content-Type: image/png');
               // var_dump("helloe");
                imagecopy($imagepng, $imagefilter, 0, 0, 0, 0, 200, 200);
                imagepng($imagepng, $fileimg);
                imagedestroy($imagepng);
                imagedestroy($imagefilter);
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

    public function getImage($idImg)
    {
        $req = $this->getBdd()->prepare("SELECT * FROM `image` WHERE id = '$idImg'");
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        var_dump($data);
        return($data);
        $req->closeCursor();
    }

    public function getPost($fileimg)
    {
        $req = $this->getBdd()->prepare("SELECT * FROM `image` WHERE path = '$fileimg'");
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return($data);
        $req->closeCursor();
    }

    public function deletePost($idImg, $idUser)
    {
        $req = $this->getBdd()->prepare("DELETE FROM `image` WHERE id = '$idImg' AND idUser = '$idUser'");
        $req->execute();
        $req->closeCursor();
    }

    public function likePost($id, $login)
    {
        $this->_query = 'SELECT COUNT(*) FROM `like` WHERE `photo_id` = :id AND `login` = :login';
        $req = $this->getDb()->prepare($this->_query);
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->bindParam(':login', $login, PDO::PARAM_STR);
        $req->execute();
        $res = $req->fetchColumn();
        if ($res)
            $this->_query = 'DELETE FROM `like` WHERE `login` = :login AND `photo_id` = :id';
        else
            $this->_query = 'INSERT INTO `like` (`photo_id`, `login`) VALUES (:id, :login)';
        $req = $this->getDb()->prepare($this->_query);
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->bindParam(':login', $login, PDO::PARAM_STR);
        $req->execute();
        $req->closeCursor();
    }
    
    // retrieve the total number of likes for a picture

    public function getLikes($idImg)
    {
        $req = $this->getBdd()->prepare("SELECT COUNT(*) FROM `like` WHERE idImg = $idImg");
        $req->execute();
        $nbLike = $req->fetch(PDO::FETCH_ASSOC);
        return($nbLike);
        $req->closeCursor();
    }
    
    // return a boolean depending if the photo is liked or not by the user logged

    public function isLiked($idImg, $user)
    {
        $req = $this->getBdd()->prepare("SELECT COUNT(*) FROM `like` WHERE idImg = $idImg AND idUser = $user");
        $req->execute();
        $isLiked = $req->fetch(PDO::FETCH_ASSOC);
        if ($isLiked)
            return true;
        else
            return false;
        $req->closeCursor();
    }

}




