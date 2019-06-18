<?php
    class Article
    {
        private $_id;
        private $_title;
        private $_content;
        private $_date;

        public function __construct(array $data)
        {
            // var_dump($data);
            // die();
            $this->hydrate($data);
        }

        public function hydrate(array $data)
        {
            // var_dump("coucouc");
            // die();
            foreach($data as $key => $value)
            {
                $method = 'set'.ucfirst($key);
                // var_dump($method);
                if (method_exists($this, $method))
                    $this->$method($value);
            }
            // die();
        }

        public function setId($id)
        {
            $id = (int) $id;

            if ($id > 0)
                $this->_id = $id;
        }
        public function setTitle($title)
        {
            if (is_string($title))
                $this->_title = $title;
        }
        public function setContent($content)
        {
            if (is_string($content))
                $this->_content = $content;
        }
        public function setDate($date)
        {
            $this->_date = $date;   
        }

        public function getId()
        {
            //var_dump("Hey");
            //die();
            return $this->_id;
        }
        public function getTitle()
        {
            return $this->_title;
        }
        public function getContent()
        {
            return $this->_content;
        }
        public function getDate()
        {
            return $this->_date;
        }        
    }