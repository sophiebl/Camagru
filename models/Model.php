<?php



abstract class Model
{

    private static $_bdd;

    // Instancie la connexion a la bdd
    private static function setBdd()
    {
        //self::$_bdd = new PDO('mysql:host=127.0.0.1;dbname=camagru;charset=utf8', 'root', 'sboulaao');
        self::$_bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'root', 'sboulaao');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    //R2cupere la connexion a la bdd
    protected function getBdd()
    {
        echo "enter BDD";
        if(self::$_bdd == null)
        {
            echo "connexion BDD FAIL";
            self::setBdd();
        }
        return self::$_bdd;
    }

    protected function getAll($table, $obj)
    {
        echo '  table '.$table;
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM '.$table);

        $req->execute();
      
        //echo '  req1 : '.$req;
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            //   var_dump($data);
            $var[] = new $obj($data);
            // var_dump($var);
        }
        // die();
        //var_dump($var[0]->getId());
        //die();
        return $var;
        $req->closeCursor();
    }

    protected function get($table, $obj, $id)
    {
        $var = [];
        //Ajouter if req echoue
        $req = $this->getBdd()->prepare("SELECT * FROM $table WHERE id = '$id'");

        $req->execute();
      
        $var = new $obj($req->fetch(PDO::FETCH_ASSOC));

        //var_dump($var);
        return $var;
        $req->closeCursor();
    }

    protected function ifUsernameExist($username)
    {
        $req = $this->getBdd()->prepare("SELECT * FROM users WHERE username = '$username'");
        //$req = self::$_bdd->prepare("SELECT * FROM users WHERE username = '$username'");
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        //return($data);
        if ($data == NULL)
            return FALSE;
        return TRUE;
        $req->closeCursor();
    }

    protected function ifEmailExist($email)
    {
        $req = $this->getBdd()->prepare("SELECT * FROM users WHERE email = '$email'");
        //$req = self::$_bdd->prepare("SELECT * FROM users WHERE email = '$email'");
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        //return($data);
        if ($data == NULL) 
            return FALSE;
        return TRUE;
        $req->closeCursor();
    }

    protected function sendEmailVerif($email, $username, $token)
    {
        $dest = $email;
        $subject = 'Veuillez verifier votre compte';
        $message = '

            Bonjour '. $username .',

            Merci de vérifier votre compte en cliquant sur le lien suivant :\n
            '. URL .'?url=verifEmail&email='. $email .'&token='. $token .' ';
            
        $header = 'From:noreply@camagru.com' . "\r\n";    
        $send = mail($dest, $subject, $message, $header); 
        return ($send);
    }

    protected function secureString($string)
    {
        // Match Emoticons
        $regex_emoticons = '/[\x{1F600}-\x{1F64F}]/u';
        $clear_string = preg_replace($regex_emoticons, '', $string);

        // Match Miscellaneous Symbols and Pictographs
        $regex_symbols = '/[\x{1F300}-\x{1F5FF}]/u';
        $clear_string = preg_replace($regex_symbols, '', $clear_string);

        // Match Transport And Map Symbols
        $regex_transport = '/[\x{1F680}-\x{1F6FF}]/u';
        $clear_string = preg_replace($regex_transport, '', $clear_string);

        // Match Miscellaneous Symbols
        $regex_misc = '/[\x{2600}-\x{26FF}]/u';
        $clear_string = preg_replace($regex_misc, '', $clear_string);

        // Match Dingbats
        $regex_dingbats = '/[\x{2700}-\x{27BF}]/u';
        $clear_string = preg_replace($regex_dingbats, '', $clear_string);

        $clear_string = htmlentities($clear_string);

        return $clear_string;
    }
}