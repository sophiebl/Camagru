<?php

class ImageManager extends Model
{

    public function saveImage()
    {
        if(isset($_POST))
        {
            $this->getBdd();
            $img = $_POST['image'];
            
        }


    }




}




