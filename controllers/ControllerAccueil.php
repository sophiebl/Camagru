<?php
require_once('views/View.php');

class ControllerAccueil
{
    private $_articleManager;
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->articles();
    }
    
    private function articles()
    {
        $this->_articleManager = new ArticleManager;
        $articles = $this->_articleManager->getArticles();

        $this->_userManager = new UserManager;
        $users = $this->_userManager->getUsers();

        //require_once('views/viewAccueil.php');
        $this->_view = new View('Accueil');
        $this->_view->generate(array('articles' => $articles, 'users' => $users));
    }


}