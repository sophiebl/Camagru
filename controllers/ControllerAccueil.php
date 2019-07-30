<?php
require_once('views/View.php');

class ControllerAccueil
{
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->welcoming();
    }
    
    private function welcoming()
    {
        session_start();
        if (isset($_SESSION['id']) && ($_SESSION['id'] != NULL))
        {
            $this->_userManager = new UserManager;
            $user = $this->_userManager->getUser($_SESSION['id']);
            $this->_view = new View('Accueil');
			$this->_view->generate(array('user' => $user, 'msg' => "Welcome again " . $user->getUsername()));
            //$this->_view->generate(array('user' => $user, 'msg' => "Welcome again " . $user->getUsername()));
        }
        else    
        {
            $this->_view = new View('Accueil');
            $this->_view->generate(array("msg" => "Welcome to SnapWorld the website where you can take, share and comment some beautiful pictures. If you want to try it's on the right corner, ENJOY!"));
        }
    }
}