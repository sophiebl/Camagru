<?php
require_once('views/View.php');

class ControllerPost
{
    private $_imageManager;
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        //exit(42);
        if (isset($url) && count($url) > 1)
            throw new Exception ("Page introuvable", 1);
        else if (isset($_GET['delete']) && $_GET['delete'] == 'OK' && isset($_GET['imgId']))
            $this->delPost();
        //else if (isset($_GET['comment']) && $_GET['comment'] === 'ok')
        //    $this->_photoManager->addComment($picture_id, htmlentities($_POST['content']), $user_logged);
        else if (isset($_GET['like']) && $_GET['like'] === 'ok')
        {
            var_dump("hello");
            //die();
            session_start();
            $this->_imageManager = new ImageManager();
            $this->_imageManager->likePost($_GET['imgId'], $_SESSION['id']);
        }
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
            $this->_view = new View('Post');
            $this->_view->generate(array(
                'img' => $img, 
                'nbLike' => $nbLike, 
                'isLiked' => $isLiked, 
                'user' => $user));
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