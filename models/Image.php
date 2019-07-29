<?php

class Image
{
    private $_idUser;
    private $_idImg;
    private $_nbLike;
    private $_img;
    private $_legend;

    public function __construct(array $data, $nbLike)
    {
        var_dump('Image');
        $this->hydrate($data, $nbLike);
    }

    public function hydrate(array $data, $nbLike)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
                $this->$method($value);
        }
        $this->setNbLike($nbLike);
    }

    //GETTER AND SETTER
    public function setIdUser($_idUser)
    {
        var_dump('IdUser');
        $this->_idUser = $_idUser;
        return $this;
    }

    public function setIdImg($_idImg)
    {
        $this->_idImg = $_idImg;
        return $this;
    }

    public function setNbLike($_nbLike)
    {
        $this->_nbLike = $_nbLike;
        return $this;
    }

    public function setImg($_img)
    {
        $this->_img = $_img;
        return $this;
    }
    
    /*public function getUserPosted($idUser)
    {
        $image_manager = new ImageManager;
        return $image_manager->getUserPostedImg($idUser);
    }

    public function getAllComment($idImg)
    {
        $image_manager = new ImageManager;
        return $image_manager->getImgComment($idImg);
    }*/

    public function getIdUser()
    {
        var_dump('get IdUser');
        return $this->_idUser;
    }
    
    public function getIdImg()
    {
        return $this->_idImg;
    }

    public function getNbLike()
    {
        return $this->_nbLike;
    }

    public function getImg()
    {
        return $this->_img;
    }

    public function getLegend()
    {
        return $this->_legend;
    }

    public function setLegend($_legend)
    {
        $this->_legend = $_legend;

        return $this;
    }

}





