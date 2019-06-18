<?php



abstract class Model
{

    private static $_bdd;

    // Instancie la connexion a la bdd
    private static function setBdd()
    {
        self::$_bdd = new PDO('mysql:host=127.0.0.1;dbname=camagru;charset=utf8', 'root', 'sboulaao');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    //R2cupere la connexion a la bdd
    protected function getBdd()
    {
        if(self::$_bdd == null)
            self::setBdd();
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


}