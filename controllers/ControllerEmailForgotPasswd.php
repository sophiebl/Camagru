<?php
require_once('views/View.php');

class ControllerEmailForgotPasswd
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
        /*session_start();
        if ($_SESSION['id'])
        {*/
            $this->_view = new View('EmailForgotPasswd');
            $this->_view->generate(array('hello' => NULL));
        /*}
        else {
            $this->_view = new View('Accueil');
            $this->_view->generate(array('Accueil' => NULL));

        }*/
    }

    private function userReqForgot()
    {
        $this->_userManager = new UserManager();
        $res = $this->_userManager->forgotReqPasswd();
        if ($res == "MAIL")
        {
            $this->_view = new View('EmailForgotPasswd');
            $this->_view->generate(array('msg' => 'Un Email vous a été envoyé'));
        }
        else 
        {
            $this->_view = new View('EmailForgotPasswd');
            $this->_view->generate(array('err' => $res));
        }
    }

}