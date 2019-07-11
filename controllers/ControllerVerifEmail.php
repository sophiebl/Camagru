<?php
require_once('views/View.php');

class ControllerVerifEmail
{
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->verifEmail();
    }
    
    private function verifEmail()
    {
        $this->_userManager = new UserManager();
        $msg = $this->_userManager->verifUser();

        if ($msg == "La verification de votre compte a été faites avec succès")
        {
            $this->_view = new View('Login');
            $this->_view->generate(array("msg" => "La verification de votre compte a été faites avec succès"));
        }
        else if ($msg == "Votre compte a déjà été vérifié")
        {
            $this->_view = new View('Login');
            $this->_view->generate(array("msg" => "Votre compte a déjà été vérifié"));
        } 
        else 
        {
            $this->_view = new View('Login');
            $this->_view->generate(array("msg" => "La verification a échouée"));
        }
    }
}