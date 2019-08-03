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
        else if ($_GET['submit'] === 'OK')
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
            //var_dump('hello');
           // die();
/*            $this->_imageManager = new ImageManager();
            var_dump('controller camera');
            var_dump($this->_imageManager);
            $user = $_SESSION['id'];
            
            var_dump('controller camera');

            var_dump($user);
            $this->_imageManager->sendImage();
            $this->_imageManager->saveImage();*/

            $this->_imageManager = new ImageManager();
            $this->_userManager = new UserManager();
            $fileimg = $this->_imageManager->sendImage();
            $img = $this->_imageManager->getPost($fileimg);
            var_dump("hello change de page");
            var_dump($img['id']);
            //$user = $this->_userManager->getUser($img['idUsers']);
            header('Location: '. URL .'?url=post&imgId='. $img['id'] .'');
            //$this->_view = new View('Post');
            //$this->_view->generate(array('img' => $img, 'user' => $user));
            //header('Location: '. URL .'?url=post');


            //$this->_imageManager->saveImage($data, $filter, $x, $y);
            //$this->_imageManager->saveImage($data, $filter);
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