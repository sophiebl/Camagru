<?php
require_once('views/View.php');

class ControllerCamera
{
    private $_cameraManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
        throw new Exception ("Page introuvable", 1);
        else if ($_GET['submit'] == 'OK')
            $this->savePicture();
        else
            $this->takePicture();
    }
    
    private function savePicture()
    {
        

        $img = $_POST["img"];


        print_r($img); 
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $dest = base64_decode($img);
        file_put_contents("public/img/tmp.png", $dest);
    }

    private function getViewCamera()
    {
        $this->_cameraManager = new ArticleManager;
        $articles = $this->_cameraManager->getCamera();

        //$this->_userManager = new UserManager;
        //$users = $this->_userManager->getUsers();

        //require_once('views/viewAccueil.php');
        $this->_view = new View('Camera');
        $this->_view->generate(array('articles' => $articles, 'users' => $users));
    }

}