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
        else if (isset($_GET['submit']) && $_GET['submit'] === 'OK')
            $this->savePicture();
        else
            $this->takePicture();
    }
    
    private function savePicture()
    {
        session_start();
        if ($_SESSION['id'] == NULL)
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('err' => "Vous devez vous connecter"));
        }
        else
        {
            $this->_imageManager = new ImageManager();
            $this->_userManager = new UserManager();
            $fileimg = $this->_imageManager->sendImage();
            $img = $this->_imageManager->getPost($fileimg);
            var_dump("hello change de page");
            var_dump($img['id']);
            header('Location: '. URL .'?url=post&imgId='. $img['id'] .'');
        }
    }

    private function takePicture()
    {
        session_start();
        if ($_SESSION['id'] == NULL)
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('err' => "Vous devez vous connecter"));
        }
        else 
        {
            $this->_view = new View('Camera');
            $this->_view->generate(array('Camera' => NULL));
        }
    }
/*
    private function delPost()
    {
        $this->_imageManager = new ImageManager();
        var_dump($img['id']);
        $this->deleteImage($img['id']);
        die();
        $this->_view = new View('Accueil');
        $this->_view->generate(array("msg" => "Votre image a bien été supprimée"));
    }
*/
}