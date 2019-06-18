<?php

class View
{
    private $_file;
    private $_t;

    public function __construct($action)
    {
        $this->_file = 'views/view'.$action.'.php';
    }
    //Genere et affiche la vue
    public function generate($data)
    {
        // Partie specifique de la vue
        $content = $this->generateFile($this->_file, $data);

        // Template
        $view = $this->generateFile('views/template.php', array('t' => $this->_t, 'content' => $content));

        echo $view;
    }

    // Genere un fichier vue et renvoie le resultat produit
    private function generateFile($file, $data)
    {
        if (file_exists($file))
        {
            extract($data);

            ob_start();

            //Inclus le fichier vue
            require $file;

            return ob_get_clean();
        }
        else
            throw new Exception('Fichier'.$file.' introuvable');
    }
}