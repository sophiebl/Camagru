<?php
require_once('views/View.php');

class ControllerModification
{
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else if ($_POST['submit' == 'OK'])    
            $this->userModif();
        else
            $this->userIsLogged();
    }

    public function userIsLogged()
    {
        session_start();
        if ($_SESSIOn['user'] == NULL)
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('err' => "Vous devez vous connecter"));
        }
        else 
        {
            $this->_view = new View('Modification');
            $this->_view->generate(array('Modification' => NULL));
        }
    }   

    private function userModif()
    {
        $this->_userManager = new UserManager();
        $res = $this->_userManager->modifUserInfo();
        $this->_view = new View('Modification');
        $this->_view->generate(array('modification' => NULL));
    }
}