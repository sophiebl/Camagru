<?php

class ImageManager extends Model
{

    public function getImages()
    {
        $req = $this->getBdd()->prepare("SELECT * FROM `image`");
        $req->execute();
        $data2 = $req->fetchColumn(PDO::FETCH_ASSOC);
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        var_dump("GET IMG");
        var_dump($data);
        var_dump("IiIiiiiiiiiiiiiiiiiiii DIFFERENCE BETWEEN DATA ET DATA2 iiiiiiiiiiiiiii");
        var_dump($data2);
        return($data);
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
            //var_dump("                filter                 ");
            //var_dump($filter);
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
            //var_dump($imagepng);
            if ($imagepng !== false && $imagefilter !== false) {
                // header('Content-Type: image/png');
               // var_dump("helloe");
                imagecopy($imagepng, $imagefilter, 0, 0, 0, 0, 300, 300);
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
            //var_dump($fileimg);
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


    public function getPictureAuthor($id)
    {
        var_dump("author");
        $req = $this->getBdd()->prepare("SELECT `username` FROM `users` INNER JOIN `image` ON `users`.`id` = `image`.`idUsers` WHERE `image`.`id`");
        $req->execute();
        $author = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $author;
    }


    public function getPictureDate($id)
    {
        $req = $this->getBdd()->prepare("SELECT `date` FROM `image` WHERE `id` = :id");
        $req->execute();
        $date = strtotime($req->fetchColumn());
        $req->closeCursor();
        $req->closeCursor();
        return $date;
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
        {
            $req = $this->getBdd()->prepare("DELETE FROM `like` WHERE `idUser` = '$idUser' AND `idImg` = '$idImg'");
            $req->execute();
            $req->closeCursor();
        }
        else
        {
            $req = $this->getBdd()->prepare('INSERT INTO `like` (`idImg`, `idUser`, `isLiked`) VALUES (:idImg, :idUser, :isLiked)');
            $req->execute([':idImg' => $idImg, ':idUser' => $idUser, ':isLiked' => true]);
            $userLiked = $this->getUsrPhoto($idImg);
            if ((bool)$userLiked['notifLike'])
            {
                var_dump($_SESSION['id']);
                var_dump("OK");
                $this->sendMailLikeCom($userLiked['email'], $userLiked['username'], $_SESSION['id'], "Quelqu'un a liké votre photo");
                var_dump('emailsend');
                //die();
                $req->closeCursor();
            }
        }
        var_dump("putain");
        //$data = $req->fetch(PDO::FETCH_ASSOC);
        //var_dump($data);
    }

    public function getNbLikes($idImg)
    {
        $req = $this->getBdd()->prepare("SELECT COUNT(*) FROM `like` WHERE idImg = $idImg");
        $req->execute();
        $nbLike = $req->fetch(PDO::FETCH_ASSOC);
        return($nbLike);
        $req->closeCursor();
    }
    

    public function isLiked($idImg, $user)
    {
        $req = $this->getBdd()->prepare("SELECT * FROM `like` WHERE idImg = $idImg AND idUser = $user");
        $req->execute();
        $isLiked = $req->fetch(PDO::FETCH_ASSOC);
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

    public function addComment($idImg, $idUser, $content)
    {
        $req = $this->getBdd()->prepare('INSERT INTO `comments` (`idImg`, `idUser`, `content`) VALUES (:idImg, :idUser, :content)');
        $req->execute([':idImg' => $idImg, ':idUser' => $idUser, ':content' => $content]);
        $userCommented = $this->getUsrPhoto($idImg);
        var_dump("|||||||||||||||||||||||||||||||||||||IS comment |||||||||||||||||||||||||||||||||||||||||||||||");
        if ((bool)$userCommented['notifCom'])
        {
            var_dump($_SESSION['id']);
            var_dump("OK");
            $this->sendMailLikeCom($userCommented['email'], $userCommented['username'], $_SESSION['id'], "Quelqu'un a commenté votre photo");
            var_dump('emailsend');
            //die();
            $req->closeCursor();
        }
        var_dump("ADDcomments  |||||||||||||||||||||||||||");
        /*$this->_query = 'INSERT INTO `comments` (`idImg`, `idUser`, `content`) VALUES (:idImg, :idUser, :content)';
        $req = $this->getBdd()->prepare($this->_query);
        $req->bindParam(':idImg', $idImg, PDO::PARAM_INT); 
        $req->bindParam(':content', $content, PDO::PARAM_STR); 
        $req->bindParam(':idUser', $user, PDO::PARAM_STR); 
        $req->execute();
        $comments = [];
        while ($data = $req->fetch(PDO::FETCH_ASSOC))
            $comments[] = $data;*/
    }

}




