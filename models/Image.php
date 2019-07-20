<?php

class Image
{
    private $_idUser;
    private $_idImg;
    private $_nbLike;
    private $_img;

    public function __construct(array $data, $nbLike)
    {
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
    public function setIdUser($idUser)
    {
        $this->_idUser = $idUser;
        return $this;
    }

    public function setIdImg($idImg)
    {
        $this->_idImg = $idImg;
        return $this;
    }

    public function setNbLike($nbLike)
    {
        $this->_nbLike = $nbLike;
        return $this;
    }

    public function setImg($img)
    {
        $this->_img = $img;
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

}





