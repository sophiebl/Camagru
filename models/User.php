<?php
    class User 
    {
        private $_id;
        private $_email;
        private $_username;
        private $_password;
        private $_notifCom;
        private $_notifLike;

        public function __construct(array $data)
        {
            $this->hydrate($data);
        }

        public function hydrate(array $data)
        {
            foreach($data as $key => $value)
            {
                $method = 'set'.ucfirst($key);
                if (method_exists($this, $method))
                    $this->$method($value);
            }
        }

        public function setId($id)
        {
            $id = (int) $id;

            if ($id > 0)
                $this->_id = $id;
        }

        public function setEmail($email)
        {
            if (is_string($email))
                $this->_email = $email;
        }

        public function setUsername($username)
        {
            if (is_string($username))
                $this->_username = $username;
        }

        public function setPassword($password)
        {
            if (is_string($password))
                $this->_password = $password;
        }

        public function getId()
        {
            return $this->_id;
        }

        public function getEmail()
        {
            return $this->_email;
        }

        public function getUsername()
        {
            return $this->_username;
        }

        public function getPassword()
        {
            return $this->_password;
        }                

        public function getNotifCom()
        {
            return $this->_notifCom;
        }
    
        public function setNotifCom($_notifCom)
        {
            $this->_notifCom = $_notifCom;
    
            return $this;
        }

        public function getNotifLike()
        {
            return $this->_notifLike;
        }

        public function setNotifLike($_notifLike)
        {
            $this->_notifLike = $_notifLike;
    
            return $this;
        }
    }

