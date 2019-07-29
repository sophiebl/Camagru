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
        $this->_userManager = new UserManager;
        $users = $this->_userManager->getUsers();
        $this->_view = new View('Accueil');
        if (isset($_SESSION['id']) && ($_SESSION['id'] != NULL))
			$this->_view->generate(array('user' => $user, 'msg' => "Welcome again " . $user->getUsername()));
        else    
            $this->_view->generate(array("msg" => "Welcome to SnapWorld the website where you can take, share and comment some beautiful pictures. If you want to try it's on the right corner, ENJOY!"));
    }


}