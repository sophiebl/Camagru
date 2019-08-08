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

            $user = $_SESSION['id'];
            $this->_userManager = new UserManager();
            $this->_imageManager = new ImageManager();
            $allUsers = $this->_userManager->getUsers();
            $images = $this->_imageManager->getImages();
            $total_img = $this->_imageManager->getNbImg();
            //var_dump($images);
            /*foreach($images as $image) {
                $author = $this->_imageManager->etPictureAuthor($img['id']);
                //$isLiked = $this->_imageManager->isLiked($image['id'], $user);
            }*/
           // $isLiked = $this->_imageManager->isLiked($idImg, $user);
           // $comments = $this->_imageManager->getComments($idImg);
            //$nbLike = $nbLike["COUNT(*)"];
            if(!$images)
            {
            //    header('Location: '. URL .'?url=);
                $this->_view = new View('Login');
                $this->_view->generate(array('users' => NULL)); 
            }
            else {
                $nb_results = 9;
                var_dump($total_img);
                $nbPage = ceil(($total_img / $nb_results));

                $img_author = $this->_imageManager->getPictureAuthors();
                $img_author = $img_author["0"];

                $images = $this->_imageManager->getImagesPerPage($p);
                //var_dump($authors);
           var_dump($img_author["0"]);
           var_dump($img_author['author']);
        
                $this->_view = new View('Gallery');
                $this->_view->generate(array(
                    'images' => $images, 
                    'img_author' => $img_author, 
                   // 'nbLike' => $nbLike, 
                 // 'isLiked' => $isLiked, 
                    'user' => $user, 
                    'nbPage' => $nbPage, 
                    'allUsers' => $allUsers 
                    ));
            }

 

           /* foreach($images as $image) {
                $this->_view->generate(array(
                    'image' => $image, 
                    'user' => $user = $this->_imageManager->getPictureAuthor($image['id'])));
            }*/
        }
}