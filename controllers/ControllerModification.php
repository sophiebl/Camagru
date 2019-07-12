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
        else if ($_GET['submit'] === 'OK')    
            $this->userModif();
        else if ($_GET['submit'] === 'MDP')    
            $this->userModifPassword();
        else
            $this->userIsLogged();
    }

    public function userIsLogged()
    {
        session_start();
        if ($_SESSION['id'])
        {
            $this->_userManager = new UserManager();
            $user = $this->_userManager->getUser($_SESSION['id']);
            $this->_view = new View('Modification');
            $this->_view->generate(array('Modification' => NULL, 'user' => $user));
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
        $user = $this->_userManager->getUser($_SESSION['id']);
        $this->_view = new View('Modification');
        $this->_view->generate(array('Modification' => NULL, 'user' => $user, 'res' => $res));
    }

    private function userModifPassword()
    {
        echo "userModifPassword";
        $this->_userManager = new UserManager();
        $res = $this->_userManager->modifPassword();
        $user = $this->_userManager->getUser($_SESSION['id']);
        var_dump($res);
        //var_dump($user);
        $this->_view = new View('Modification');
        $this->_view->generate(array('Modification' => NULL, 'user' => $user, 'res' => $res));
    }

}