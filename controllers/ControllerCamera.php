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

    private function takePicture()
    {
        session_start();
        if ($_SESSION['id'] == NULL)
        {
            $this->_view = new View('Accueil');
            $this->_view->generate(array('err' => "Vous devez vous connecter"));
        }
        else 
        {
            $this->_view = new View('Camera');
            $this->_view->generate(array('Camera' => NULL));
        }
    }

}