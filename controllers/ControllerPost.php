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
        else if (isset($_GET['delete']) && $_GET['delete'] === 'OK' && isset($_GET['imgId']))
            $this->delPost();
        else if (isset($_GET['comment']) && $_GET['comment'] === 'ok' && isset($_GET['content']) && $_GET['content'] !== '')
        {
            session_start();
            var_dump($_GET['content']);
            var_dump($_GET['content']);
            $this->_imageManager = new ImageManager();
            $this->_imageManager->addComment($_GET['imgId'], $_SESSION['id'], htmlentities($_GET['content']));
        }
        else if (isset($_GET['like']) && $_GET['like'] === 'ok')
        {
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
        if (!isset($_SESSION['id']) && $_SESSION['id'] == NULL)
        {
            $this->_view = new View('Accueil');
            $this->_view->generate(array('msg' => "Vous devez vous connecter"));
        }
        else
        {
            $idImg = $_GET['imgId'];
            var_dump($idImg);
            $user = $_SESSION['id'];
            $this->_userManager = new UserManager();
            $this->_imageManager = new ImageManager();
            $img = $this->_imageManager->getImage($idImg);
            var_dump($img);
            $authorImg = $this->_imageManager->getImgAuthor($idImg);
            $nbLike = $this->_imageManager->getNbLikes($idImg);
            $isLiked = $this->_imageManager->isLiked($idImg, $user);
            $comments = $this->_imageManager->getComments($idImg);
            $nbLike = $nbLike["COUNT(*)"];
            $this->_view = new View('Post');
            $this->_view->generate(array(
                'img' => $img, 
                'nbLike' => $nbLike, 
                'isLiked' => $isLiked, 
                'comments' => $comments, 
                'authorImg' => $authorImg, 
                'user' => $user));
        }
    }

    private function delPost()
    {
        session_start();
        $this->_imageManager = new ImageManager();
        var_dump($_GET['imgId']);
        var_dump($_SESSION['id']);
        $this->_imageManager->deletePost($_GET['imgId'], $_SESSION['id']);
        $this->_view = new View('Accueil');
        $this->_view->generate(array("msg" => "Votre image a bien été supprimée"));
    }
}