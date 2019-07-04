<?php
class UserManager extends Model
{
    public function getUsers()
    {
        echo '  User manager  ';
        return $this->getAll('users', 'User');
    }
    public function login(){
        if (isset($_POST) && !empty($_POST)
            && isset($_POST['username']) && !empty($_POST['username'])
            && isset($_POST['password']) && !empty($_POST['password'])){
                var_dump("hello");
                die();
            $this->getBdd;
            $username = $mysqli->real_escape_string($_POST['username']);
            $password = $_POST['password'];
            //$password = hash("SHA512", $password); 
            $req = $this->getBdd()->prepare("SELECT * FROM users WHERE username = '$username' AND password = '$password' ");
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            if ($data['isVerif'] == '0' && isset($data['username']))
                return "USERNAME";
            if (empty($data['username']))
            {
                echo "PAS OKKKKKKKK";
                return "Entrez un nom d'utilisateur";
            }
            $newUser = new User($data);    
            return $newUser;
            $req->closeCursor();
        }
    }

}