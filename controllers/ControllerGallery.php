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
        else
            $this->displayGallery();
    }

    private function displayGallery()
    {
        session_start();

            $user = $_SESSION['id'];
            $this->_userManager = new UserManager();
            $this->_imageManager = new ImageManager();
            $allUsers = $this->_userManager->getUsers();
            $images = $this->_imageManager->getImages();
           // $nbLike = $this->_imageManager->getNbLikes($idImg);
           // $isLiked = $this->_imageManager->isLiked($idImg, $user);
           // $comments = $this->_imageManager->getComments($idImg);
          //  $nbLike = $nbLike["COUNT(*)"];
            $this->_view = new View('Gallery');
            $this->_view->generate(array(
                'images' => $images, 
              //  'nbLike' => $nbLike, 
             //   'isLiked' => $isLiked, 
              //  'comments' => $comments, 
                'allUsers' => $allUsers, 
                'user' => $user));
        }
}