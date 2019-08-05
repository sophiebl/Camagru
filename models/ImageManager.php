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

    public function likePost($idImg, $idUser)
    {
        $req = $this->getBdd()->prepare("SELECT * FROM `like` WHERE idImg = $idImg AND idUser = '$idUser'");
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        var_dump($data);
        if ($data)
            $req = $this->getBdd()->prepare("DELETE FROM `like` WHERE `idUser` = '$idUser' AND `idImg` = '$idImg'");
        else
            $req = $this->getBdd()->prepare('INSERT INTO `like` (`idImg`, `idUser`) VALUES (:idImg, :idUser)');
        $req->execute([':idImg' => $idImg, ':idUser' => $idUser]);
        //$data = $req->fetch(PDO::FETCH_ASSOC);
        //var_dump($data);
        $req->closeCursor();
    }
    
    // retrieve the total number of likes for a picture

    public function getNbLikes($idImg)
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
        $req = $this->getBdd()->prepare("SELECT * FROM `like` WHERE idImg = $idImg AND idUser = $user");
        $req->execute();
        $isLiked = $req->fetch(PDO::FETCH_ASSOC);
            var_dump("|||||||||||||||||||||||||||||||||||||IS LIKE OR NOT |||||||||||||||||||||||||||||||||||||||||||||||");
        var_dump($isLiked);
        if ($isLiked)
            return true;
        else
            return false;
        $req->closeCursor();
    }

    public function getComments($idImg) 
    {
      // INSERT INTO `comments` (`id`, `content`, `idUser`, `Idimg`) VALUES (NULL, 'Hello je suis un premier commentaire', '13', '428'), (NULL, 'Hello je suis un deuxième commentaire', '13', '428');
        $req = $this->getBdd()->prepare("SELECT * FROM `comments` WHERE idImg = $idImg");
        $req->execute();
        $comments = $req->fetchAll(PDO::FETCH_ASSOC);
        var_dump("comments  |||||||||||||||||||||||||||");
        var_dump($comments);
        return($comments);
        $req->closeCursor();
    }

}




