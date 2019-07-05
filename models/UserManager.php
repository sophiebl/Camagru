<?php
class UserManager extends Model
{
    public function getUsers()
    {
        echo '  User manager  ';
        return $this->getAll('users', 'User');
    }

    public function register(){

        if (isset($_POST) && !empty($_POST)
            && isset($_POST['email']) && !empty($_POST['email'])
            && isset($_POST['username']) && !empty($_POST['username'])
            && isset($_POST['password']) && !empty($_POST['password'])
            && isset($_POST['password2']) && !empty($_POST['password2']))
            {
                echo "say";
                $err = [];
                $i = 0;
                $this->getBdd;
                if (strlen($_POST['password']) < 8)
                    $err[$i++] = "Veuillez entre un mot de passe de plus de 8 caractères";
                if (strcmp($_POST['password'], $_POST['password2']) != 0)
                    $err[$i++] = "Les mots de passe ne sont pas identique";
                $username = $this->secureString($_POST['username']);
                $email = $this->secureString($_POST['email']);
                if (filter_var($email, FILTER_VALIDATE_EMAIL) == 0) 
                    $err[$i++] = "L'adresse mail n'est pas correcte";
                $password = $_POST['password'];
                //$password = hash("SHA512", $password); 
                if ($this->ifUsernameExist($username) != NULL)
                    $err[$i++] = "Le nom d'utilisateur est déjà utilisé";
                if ($this->ifEmailExist($email))   
                    $err[$i++] = "L'adresse email est déjà utilisée";
                if (isset($err) && !empty($err))
                    return $err;
                else
                {
                    $req = $this->getBdd()->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
                    //if (!($this->sendMailVerif($email, $login, $hash)))
                    /*{
                        $out = "Une erreur est survenue lors de l'envois du mail";
                        return $out;
                    }*/
                    $req->execute([':username' => $username, ':password' => $password, ':email' => $email]);
                    $req->closeCursor();

                    //$hash = md5(rand(0,10000));
                   /* $req = $this->getBdd()->prepare("INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$password')");
                    $req->execute(['email' => $email, 'username' => $username, 'password' => $password]);
                    $req->closeCursor();*/
                    
                }
            }
    }

    public function login(){
        if (isset($_POST) && !empty($_POST)
            && isset($_POST['username']) && !empty($_POST['username'])
            && isset($_POST['password']) && !empty($_POST['password'])){
                var_dump("hello");
                die();
            $this->getBdd;
            $username = secureString($_POST['username']);
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
                return "EMPTY";
            }
            $newUser = new User($data);    
            return $newUser;
            $req->closeCursor();
        }
    }

}