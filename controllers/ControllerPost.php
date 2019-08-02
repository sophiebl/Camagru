<?php
require_once('views/View.php');

class ControllerCamera
{
    private $_imageManager;
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception ("Page introuvable", 1);
        else if ($_GET['delete'] == 'OK' && isset($_GET[$img['id']]))
            $this->delPost();
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
            var_dump("hello");
            $this->_userManager = new UserManager();
            //var_dump($fileimg);
            $user = $this->_userManager->getUser($img['idUsers']);
            //var_dump("hello");
            var_dump($user);
    //        $this->_view = new View('Post');
  //          $this->_view->generate(array('user' => $user));
            //$this->_imageManager->saveImage($data, $filter, $x, $y);
            //$this->_imageManager->saveImage($data, $filter);
        }
    }

    private function delPost()
    {
        $this->_imageManager = new ImageManager();
        $this->deleteImage($_GET[$img['id']]);
        $this->_view = new View('Accueil');
        $this->_view->generate(array("msg" => "Votre image a bien été supprimée"));
    }
}