<?php

class Router
{
    private $_ctrl;
    private $_view;

    
    public function routeReq()
    {
        echo "   Router   ";
        try
        {
            spl_autoload_register(function($class){
                require_once('models/'.$class.'.php');
            });

            echo "     Autoload done     ";
            //Le cntroller est inclus selon l'action de l'utilisateur
            if(isset($_GET['url']))
            {
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
                echo "isset url           ";

                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = "Controller".$controller;
                $controllerFile = "controllers/".$controllerClass.".php";
                //If ControllerAccueil.php exist for example
                echo "  controllerfile".$controllerFile;
                if(file_exists($controllerFile))
                {
                    echo "   controllerfile exist   ";
                    require_once($controllerFile);
                    $this->_ctrl = new $controllerClass($url);
                }
                else
                    throw new Exception('Page introuvable');
            }
            else 
            {
                echo "     CONTROLLER     ";
                require_once('controllers/ControllerAccueil.php');
                $this->_ctrl = new ControllerAccueil($url);
            }
        }
        //Gestion des erreurs
        catch(Exception $e)
        {
            $errorMsg = $e->getMessage();
            require_once('views/viewError.php');
        }
    }
}