<?php
require_once('views/View.php');

class ControllerCamera
{
    private $_imageManager;
    private $_view;

    public function __construct($url)
    {
        var_dump($url);
        if (isset($url) && count($url) > 1)
            throw new Exception ("Page introuvable", 1);
        else if ($_GET['submit'])
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
            var_dump('hello');
            die();
            $this->_imageManager = new ImageManager();
            $this->_imageManager->sendImage();
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

}