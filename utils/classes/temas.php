<?php 

    class temas{

        private $tema;
        private $id;

        public function setTema(string $temas) : temas
        {
            $this->tema = $temas;
            return $this;
        }
        public function getTema(){
            return $this->tema;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id): temas
        { 
            $this->id = $id;
            return $this;
        }
    }
?>