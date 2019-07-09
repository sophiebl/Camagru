<?php
require_once('views/View.php');

class ControllerLogin
{
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        //var_dump($_GET);
        //die();
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else if ($_GET['submit' == 'OK'])    
        {
            echo "TRY LOGIN";
            die();
            $this->userTryLogin();
        }
        else
            $this->userLogin();
    }
    
    private function userLogin()
    {
        session_start();
        var_dump($_SESSION['user']);
        echo "user log";
    //die();
        if ($_SESSION['user'])
        {
            $this->_view = new View('Accueil');
            //$this->_view->generate(array('users' => $users));
        }
        else
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('login' => NULL));
        }
    }

    public function userTryLogin()
    {
        //session_start();
        echo "try log";
        var_dump($_SESSION['user']);
        die();
        $this->_userManager = new UserManager();
        $user = $this->_userManager->login();

        if ($user == "USERNAME")
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('err' => 'Vous n\'avez pas vérifié votre nom d\'utilisateur'));
        }
        else if ($user == "EMPTY")
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('err' => 'Votre mot de passe ou votre login est incorrect.'));
        }
        else
        {
            //var_dump('user not log');
            //die();
            $this->_view = new View('Accueil');
		//	$this->_view->generate(array('user' => $user, 'msg' => "Welcom again " . $user->getUsername()));
        }
    }
}