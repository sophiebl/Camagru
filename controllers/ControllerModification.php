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
        else if ($_GET['submit' == 'OK'])    
            $this->userModif();
        else
            $this->userIsLogged();
    }

    public function userIsLogged()
    {
        session_start();
        if ($_SESSION['user'])
        {
            $this->_view = new View('Modification');
            $this->_view->generate(array('Modification' => NULL));
        }
        else 
        {
            $this->_view = new View('Accueil');
            $this->_view->generate(array('err' => "Vous devez vous connecter"));
        }
    }   

    private function userModif()
    {
        $this->_userManager = new UserManager();
        $res = $this->_userManager->modif();
        $users = $this->_userManager->getUsers();
        $this->_view = new View('Modification');
        $this->_view->generate(array('modification' => NULL));
    }
}