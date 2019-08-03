<?php
require_once('views/View.php');

class ControllerPost
{
    private $_imageManager;
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception ("Page introuvable", 1);
        else if ($_GET['delete'] == 'OK' && isset($_GET['imgId']))
            $this->delPost();
        //else if (isset($_GET['comment']) && $_GET['comment'] === 'ok')
        //    $this->_photoManager->addComment($picture_id, htmlentities($_POST['content']), $user_logged);
        else if (isset($_GET['like']) && $_GET['like'] === 'ok')
            $this->_photoManager->likePost($picture_id, $user_logged);
        else
            $this->displayPost();
    }
    
    private function displayPost()
    {
        session_start();
        if ($_SESSION['id'] == NULL)
        {
            $this->_view = new View('Post');
            $this->_view->generate(array('err' => "Vous devez vous connecter"));
        }
        else
        {
            var_dump("|||||||||||||||||||||||||||||||||||||IS LIKE OR NOT |||||||||||||||||||||||||||||||||||||||||||||||");
            $idImg = $_GET['imgId'];
            $user = $_SESSION['id'];
            $this->_userManager = new UserManager();
            $this->_imageManager = new ImageManager();
            $img = $this->_imageManager->getImage($idImg);
            $nbLike = $this->_imageManager->getLikes($idImg);
            $isLiked = $this->_imageManager->isLiked($idImg, $user);
            var_dump($isLiked);

            //$login = $this->_photoManager->getPictureAuthor($picture_id);

            $this->_view = new View('Post');

            $this->_view->generate(array(
                'img' => $img, 
                'nbLike' => $nbLike, 
                'isLiked' => $isLiked, 
                'user' => $user));
            //$fileimg = $this->_imageManager->sendImage();
            //$user = $this->_userManager->getUser($img['idUsers']);
            //var_dump("hello");
            //var_dump($user);
            //var_dump($img);
    //        $this->_view = new View('Post');
  //          $this->_view->generate(array('user' => $user));
            //$this->_imageManager->saveImage($data, $filter, $x, $y);
            //$this->_imageManager->saveImage($data, $filter);
/*
            public function generatePost($picture_id) {
                $login = $this->_photoManager->getPictureAuthor($picture_id);
                $nb_likes = $this->_photoManager->getLikes($picture_id);
                $liked_or_not = $this->_photoManager->alreadyLiked($picture_id);
                $picture = $this->_photoManager->getPictureById($picture_id);
                $comments = $this->_photoManager->getComments($picture_id);
                $date = $this->_photoManager->getPictureDate($picture_id);
                $this->_view = new View('Post');
                $this->_view->generate(array(
                    'id' => $picture_id, 
                    'login' => $login, 
                    'picture' => $picture, 
                    'comments' => $comments, 
                    'nb_likes'=> $nb_likes,
                    'liked_or_not' => $liked_or_not,
                    'date' => $date));
            }*/

        }
    }

    private function delPost()
    {
        session_start();
        $this->_imageManager = new ImageManager();
        var_dump($_GET['imgId']);
        $this->_imageManager->deletePost($_GET['imgId'], $_SESSION['id']);
        $this->_view = new View('Accueil');
        $this->_view->generate(array("msg" => "Votre image a bien été supprimée"));
    }
}