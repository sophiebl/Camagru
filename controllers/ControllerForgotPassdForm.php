<?php
require_once('views/View.php');

class ControllerForgotPasswd
{
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else if ($_GET['submit'] === 'OK')    
            $this->userReqForgot();
        else
            $this->forgotPasswd();
    }

    private function forgotPasswd()
    {
        session_start();
        if ($_SESSION['id'])
        {
            $this->_view = new View('EmailForgotPasswd');
            $this->_view->generate(array('EmailForgotPasswd' => NULL));
        }
        else {
            $this->_view = new View('Accueil');
            $this->_view->generate(array('Accueil' => NULL));

        }
    }

    private function userReqForgot()
    {
        $this->_userManager = new UserManager();
        $res = $this->_userManager->forgotReqPasswd();
        $this->_view = new View('Modification');
        $this->_view->generate(array('Modification' => NULL, 'user' => $user, 'res' => $res));
    }

}