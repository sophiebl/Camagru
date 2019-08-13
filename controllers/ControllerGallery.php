<?php
require_once('views/View.php');

class ControllerGallery
{
    private $_imageManager;
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception ("Page introuvable", 1);
        else if (isset($_GET['page']))
            $this->displayGallery($_GET['page']);
        else
            $this->displayGallery(1);
    }

    private function displayGallery($p)
    {
        session_start();

            if (isset($_SESSION['id']) && $_SESSION['id'] !== NULL)
                $user = $_SESSION['id'];
            else
                $user = 'visitor';
            $this->_userManager = new UserManager();
            $this->_imageManager = new ImageManager();
            $allUsers = $this->_userManager->getUsers();
            $images = $this->_imageManager->getImages();
            $total_img = $this->_imageManager->getNbImg();
            if(!$images)
            {
                $this->_view = new View('Login');
                $this->_view->generate(array('users' => NULL)); 
            }
            else {
                $nb_results = 9;
                $nbPage = ceil(($total_img / $nb_results));

                $authors = $this->_imageManager->getPictureAuthors();
                $images = $this->_imageManager->getImagesPerPage($p);
        
                $this->_view = new View('Gallery');
                $this->_view->generate(array(
                    'images' => $images, 
                    'authors' => $authors, 
                    'user' => $user, 
                    'nbPage' => $nbPage, 
                    'allUsers' => $allUsers 
                    ));
            }
       }
}