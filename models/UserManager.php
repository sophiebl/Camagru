<?php
class UserManager extends Model
{
    public function getUsers()
    {
        echo '  User manager  ';
        return $this->getAll('users', 'User');
    }

    public function getUser($id)
    {
        echo '  User   ';
        return $this->get('users', 'User', $id);
    }

    public function register(){

        if (isset($_POST) && !empty($_POST)
            && isset($_POST['email']) && !empty($_POST['email'])
            && isset($_POST['username']) && !empty($_POST['username'])
            && isset($_POST['password']) && !empty($_POST['password'])
            && isset($_POST['password2']) && !empty($_POST['password2']))
            {
                $err = [];
                $i = 0;
                $this->getBdd();
                if (strlen($_POST['password']) < 8)
                    $err[$i++] = "Veuillez entre un mot de passe de plus de 8 caractères";
                if (strcmp($_POST['password'], $_POST['password2']) != 0)
                    $err[$i++] = "Les mots de passe ne sont pas identique";
                $username = $this->secureString($_POST['username']);
                $email = $this->secureString($_POST['email']);
                if (filter_var($email, FILTER_VALIDATE_EMAIL) == 1) 
                    $err[$i++] = "L'adresse mail n'est pas correcte";
                $password = $_POST['password'];
                $password = hash("SHA512", $password); 
                //var_dump($password);
                if ($this->ifUsernameExist($username) != NULL)
                    $err[$i++] = "Le nom d'utilisateur est déjà utilisé";
                if ($this->ifEmailExist($email))   
                    $err[$i++] = "L'adresse email est déjà utilisée";
                if (isset($err) && !empty($err))
                    return $err;
                else
                {
                    echo "before Rand";
                   // $token = random_int(0, 10000);
                    $token = rand( 0, 10000);
                    echo "after random_int";
                    $req = $this->getBdd()->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");

                    echo "before encvoi Email ";
                    if (!($this->sendEMailVerif($email, $username, $token)))
                        return "Une erreur est survenue lors de l'envoi du mail";
                    echo "After envoi Email !!! ";
                    $this->_view = new View('Accueil');
                    $this->_view->generate(array("msg" => "Un lien d'activation de votre compte vous a été par mail"));
                    $req->execute([':username' => $username, ':password' => $password, ':email' => $email]);
                    $req->closeCursor();

                    //$hash = md5(rand(0,10000));
                   /* $req = $this->getBdd()->prepare("INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$password')");
                    $req->execute(['email' => $email, 'username' => $username, 'password' => $password]);
                    $req->closeCursor();*/
                    
                }
            }
    }

    public function verifUser()
    {
        if (isset($_GET) && !empty($_GET)
            && isset($_GET['email']) && !empty($_GET['email'])
            && isset($_GET['token']) && !empty($_GET['token']))
        {
            $this->getBdd();
            $email = $this->secureString($_GET['email']);
            //$token = $this->secureString($_GET['token']);
            $req = $this->getBdd()->prepare("SELECT * FROM users WHERE email = '$email' AND token = '$token'");
            $req->execute();
            echo "hello";
            //print_r('req : '.$req);
            //die();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            echo " FUCK2 ";
            var_dump($data);
            if ($data == NULL)
                return 'La verification a échouée';
            else if ($data['isVerif'] == 0)
            {
                $req = $this->getBdd()->prepare("UPDATE users SET isVerif = true WHERE email = :email");
                $req->execute([':email' => $email]);
                return "La verification de votre compte a été faites avec succès";
            }
            else if ($data['isVerif'] == 1)
                return "Votre compte a déjà été vérifié";
        }
    }

    public function login(){
                var_dump("hello on est dans login()");
        if (isset($_POST) && !empty($_POST)
            && isset($_POST['username']) && !empty($_POST['username'])
            /*&& isset($_POST['password']) && !empty($_POST['password'])*/){
                var_dump("hello on est dans login()");
            //    die();
            //echo " OKKKKKKKK";
           // $this->getBdd();
            session_start();
               echo " USER : ";
        var_dump($_SESSION['id']);
        var_dump($_POST['username']);
            //$this->getBdd;
            echo " OKKKKKKKK 1";
            //$idUsr = $_SESSION['id']->getIdUser();
            $username = $this->secureString($_POST['username']);
            echo " OKKKKKKKK before req";
            $password = $_POST['password'];
            $password = hash("SHA512", $password); 
            //$req = $this->getBdd()->prepare("SELECT * FROM users WHERE username = '$username' AND password = '$password' ");
            $req = $this->getBdd()->prepare("SELECT * FROM users WHERE username = '$username'");
            echo " OKKKKKKKK after requetE";
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            $_SESSION['id'] = $data['id'];
            if ($data['isVerif'] == '0' && isset($data['username']))
            {
                echo "YESSSSSSSSSSSSSSSSS      ";
                return "USERNAME";
            }
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

    public function logout(){
        session_start();
        if (isset($_SESSION['id']))
            $_SESSION['id'] = NULL;
    }

    public function modif(){
        session_start();
        if (isset($_POST) && !empty($_POST)
            && isset($_POST['email']) && !empty($_POST['email'])
            && isset($_POST['username']) && !empty($_POST['username']))
        {

//            $this->getBdd();

            //$username = $this->secureString($_POST['username']);
            $username = $this->secureString($_POST['username']);
            $id = $_SESSION['id'];
            $err = [];
            $i = 0;

            $username = $this->secureString($_POST['username']);
            //$username = $this->secureString($_POST['username']);
            $email = $this->secureString($_POST['email']);
            if (filter_var($email, FILTER_VALIDATE_EMAIL) == 1) 
                $err[$i++] = "L'adresse mail n'est pas correcte";
            if ($this->ifUsernameExist($username) != NULL)
                $err[$i++] = "Le nom d'utilisateur est déjà utilisé";
            if ($this->ifEmailExist($email))   
                $err[$i++] = "L'adresse email est déjà utilisée";
            if (isset($err) && !empty($err))
                return $err;
            else
            {
                echo "before req";
                $req = $this->getBdd()->prepare("UPDATE users SET username = :username, email = :email WHERE id = :id");
                echo "after req";
                $req->execute([':username' => $username, ':email' => $email, ':id' => $id]);
                $req->closeCursor();

                //$hash = md5(rand(0,10000));
                
            }
        }
        if (isset($_POST) && !empty($_POST)
            && isset($_POST['password']) && !empty($_POST['password'])
            && isset($_POST['newpassword']) && !empty($_POST['newpassword'])
            && isset($_POST['newpassword2']) && !empty($_POST['newpassword2'])){

            $password = $_POST['password'];
            $newpassword = $_POST['newpassword'];
            $newpassword2 = $_POST['newpassword2'];

            $id = $_SESSION['id'];
            $err = [];
            $i = 0;

            if (strlen($_POST['newpassword']) < 8)
                $err[$i++] = "Veuillez entre un mot de passe de plus de 8 caractères";
            if (strcmp($_POST['newpassword'], $_POST['newpassword2']) != 0)
                $err[$i++] = "Les mots de passe ne sont pas identique";
            //$password = hash("SHA512", $password); 
            if (isset($err) && !empty($err))
                return $err;
            else
            {
                $req = $this->getBdd()->prepare("UPDATE users SET password = :newpassword WHERE id = :id");
                $req->execute([':password' => $newpassword, ':id' => $id]);
                $req->closeCursor();
            }
        }

    }

}