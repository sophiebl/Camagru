<?php
    class User 
    {

        private $_id;
        private $_email;
        private $_username;
        private $_password;

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

        public function setIdUser($id)
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

        public function getIdUser()
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
    }


/*
class User extends Database {

    public function getAllUsers() {
        $stmt = $this->connect()->query("SELECT * FROM users");
        while ($row = $stmt->fetch()) {
            $uid = $row['id'];
            $name = $row['username'];
            return $name;
        }
    }

    public function getUsersWithCountCheck() {
        $id = 2;
        $username = "Test";

        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE id=? AND username=?");    
        $stmt->execute([$id, $username]);

        if ($stmt->rowCount()) {
            while ($row = $stmt->fetch()) {
                return $row['username'];
            }
        }
    }
    
} */
