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
            $this->userModif();
        else
            $this->userIsLogged();
    }

    public function userIsLogged()
    {
        session_start();
        echo "user :  ";
        var_dump($_SESSION['id']);
        echo "user log";
//            die();
        if ($_SESSION['id'])
        {
                echo "Tu DOiS aFFICHER PAGE MODIFIcat";
            $this->_userManager = new UserManager();
            $user = $this->_userManager->getUser($_SESSION['id']);
            echo "<pre>";
            print_r($_SESSION['id']);
            echo "</pre>";

                echo "hello pfou";
            //$user = $this->_userManager->getUsers();
            //$idUsr = $user->getId();
            //$idUsr = $user->getId();
            //$user = $this->_userManager->getUsers();
                echo "    hello again    ";
                var_dump($user->getId());
            //$this->_view->generate(array('users' => NULL));
            //$user2 = $_SESSION['id'];

           //echo "\n USER = \n";
            //var_dump($user);
            $this->_view = new View('Modification');
            //$this->_view->generate(array('Modification' => $user2));
            $this->_view->generate(array('Modification' => NULL, 'user' => $user));
        }
        else 
        {
                echo "TU DOIS PA AFFICHER PAGE MODIF";
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
        $this->_view->generate(array('Modification' => NULL, 'user' => $user));
    }
}