<?php
require_once('views/View.php');

class ControllerForgotPasswdForm
{
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        $email= $_GET['email'];
        $token= $_GET['token'];
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else if ($_GET['submit'] === 'OK')    
            $this->userReqReset();
        else
            $this->resetForm();
    }

    private function resetForm()
    {
        //session_start();
        //if ($_SESSION['id'])
        //{
            $this->_view = new View('ForgotPasswdForm');
           // $email = $this->secureString($_GET['email']);
            //$token = $this->secureString($_GET['token']);
            //var_dump($email);
            $this->_view->generate(array('ForgotPasswdForm' => NULL));
        /*}
        else {
            $this->_view = new View('Accueil');
            $this->_view->generate(array('Accueil' => NULL));

        }*/
    }

    private function userReqReset()
    {
        $this->_userManager = new UserManager();
        $res = $this->_userManager->resetReqPasswd();
        if ($res == 'OK')
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('Login' => NULL, 'msg' => 'Votre mot de passe a bien été modifié vous pouvez vous connecter'));
        }
        else 
        {
            $this->_view = new View('ForgotPasswdForm');
            $this->_view->generate(array('ForgotPasswdForm' => NULL, 'err' => 'La requete a expirée veuillez refaire une demande de nouveau mot de passe'));
        }
    }
}