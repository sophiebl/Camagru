<?php

class ControllerAccueil
{
    private $_articleManager;
    private $_view;


    public function __construct($url)
    {
        echo '  ControllerAccueil  ';
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->articles();
    }
    
    private function articles()
    {
        echo ' articles  ';
        $this->_articleManager = new ArticleManager;
        $articles = $this->_articleManager->getArticles();

        require_once('view/viewAccueil.php');
    }
}