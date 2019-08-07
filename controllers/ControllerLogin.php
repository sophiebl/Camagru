<?php
require_once('views/View.php');

class ControllerLogin
{
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else if ($_GET['submit'] === 'OK')    
            $this->userTryLogin();
        else
            $this->userLogin();
    }
    
    private function userLogin()
    {
        if ($_SESSION['id'])
        {
            $this->_view = new View('Accueil');
            $this->_view->generate(array('users' => $user));
        }
        else
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('login' => NULL));
        }
    }

    public function userTryLogin()
    {
        $this->_userManager = new UserManager();
        $user = $this->_userManager->login();
        if ($user == "USERNAME")
        {
            $this->_view = new View('Accueil');
            $this->_view->generate(array('users' => $user));
        }
        else if ($user == "EMPTY")
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('err' => 'Votre mot de passe ou votre login est incorrect.'));
        }
        else
        {
            $this->_view = new View('Accueil');
			$this->_view->generate(array('user' => $user, 'msg' => "Welcome again <span style='background-color: #2e7dd1;color: #ffff00;padding: 0 5px;'>" . $user->getUsername() ."</span>"));
        }
    }
}