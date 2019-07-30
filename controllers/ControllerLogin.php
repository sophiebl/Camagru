<?php
require_once('views/View.php');

class ControllerLogin
{
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        /*echo "GET :  ";
        var_dump($_GET);
        echo "user dans construct :  ";
        var_dump($_SESSION['id']);*/
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else if ($_GET['submit'] === 'OK')    
            $this->userTryLogin();
        else
            $this->userLogin();
    }
    
    private function userLogin()
    {
/*        session_start();
        echo "user :  ";
        var_dump($_SESSION['id']);
        echo "user log";*/
        if ($_SESSION['id'])
        {
           // echo "LE USER EXISTE";
            $this->_view = new View('Accueil');
            $this->_view->generate(array('users' => $user));
        }
        else
        {
         //   echo "LE USER N'EXISTE PAS";
            $this->_view = new View('Login');
            $this->_view->generate(array('login' => NULL));
        }
    }

    public function userTryLogin()
    {
    //    session_start();
/*        echo "try log";
        var_dump($_SESSION['id']);
        var_dump($_SESSION['id']);
        var_dump($_POST['username']);*/
        //die();
        $this->_userManager = new UserManager();
        $user = $this->_userManager->login();
        if ($user == "USERNAME")
        {
            $this->_view = new View('Accueil');
            $this->_view->generate(array('users' => $user));
            //$this->_view = new View('Login');
            //$this->_view->generate(array('err' => 'Vous n\'avez pas vérifié votre nom d\'utilisateur'));
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
			$this->_view->generate(array('user' => $user, 'msg' => "Welcome again <span style='background-color: #2e7dd1;color: #ffff00;padding: 0 5px;'>" . $user->getUsername() ."</span>"));
        }
    }
}