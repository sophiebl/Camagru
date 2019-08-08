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
			$this->_view->generate(array('user' => $user, 'msg' => "Welcome again <span style='background-color: #2e7dd1;color: #ffff00;padding: 0 5px;'>" . $user->getUsername() ."</span>"));
        }
        else    
        {
            $this->_view = new View('Accueil');
            $this->_view->generate(array("msg" => "Welcome to <span style='background-color: #2e7dd1;color: #ffff00;padding: 0 5px;'>SnapWorld</span> the website where you can take, share and comment some <span style='background-color: #2e7dd1;color: #ffff00;padding: 0 5px;'>beautiful pictures</span>. If you want to try it's on the right corner, ENJOY!"));
        }
    }
}