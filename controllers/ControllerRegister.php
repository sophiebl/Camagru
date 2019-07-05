<?php
require_once('views/View.php');

class ControllerRegister
{
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else if ($_POST)    
            $this->userTryRegister();
        else
            $this->userRegister();
    }
    
    private function userRegister()
    {
        $this->_userManager = new UserManager();
        $this->_view = new View('Register');
        $this->_view->generate(array('register' => NULL));
    }

    public function userTryRegister()
    {
        $res = [];
        $this->_userManager = new UserManager();
        $res = $this->_userManager->register();
        if (isset($res))
            echo json_encode($res);
        echo "HELLO";

    }
}