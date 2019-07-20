<?php

class ImageManager extends Model
{

    public function getImages($offset, $limit)
    {
        $this->getBdd();
        return $this->getAllPictures($offset, $limit);
    }

    public function sendImage()
    {
        if (isset($_POST))        
        {
            $this->getBdd();
            $img = $_POST['image'];
            var_dump($img);
            //die();
        }
    }

    public function saveImage()
    {
        if (isset($_GET) && !empty($_GET) && isset($_SESSION['id']) && !empty($_SESSION))
        {
            $this->getBdd();
            $img = $_POST['image'];
            
        }


    }




}




