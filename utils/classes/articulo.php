<?php 

class articulo{

    const RUTA_IMAGENES_GALLERY = 'upload/';

    private $titulo;
    private $tema;
    private $fecha;
    private $texto;
    private $imagen;
    private $id;
    
    public function setTitulo(string $titulo) : articulo
    {
        $this->titulo = $titulo;
        return $this;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTema(string $temas) : articulo
    {
        $this->tema = $temas;
        return $this;
    }
    public function getTema(){
        return $this->tema;
    }
    
    public function setFecha(string $fecha) : articulo
    {
        $this->fecha = $fecha;
        return $this;
    }
    public function getFecha()
    {
        return $this->fecha;
    }

    public function setTexto(string $texto): articulo
    {
        $this->texto = $texto;
        return $this;
    }
    public function getTexto()
    {
        return $this->texto;
    }
    public function getImagen()
    {
        return $this->imagen;
    }
    public function setImagen(string $imagen): articulo
    {
        // if($imagen != 'sin_imagen.jpg'){
        //     $this->imagen = $imagen;
        //     return $this;
        // }
        $this->imagen = $imagen;
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id): articulo
    { 
        $this->id = $id;
        return $this;
    }
    public function getUrlGallery() : string
    {   
        return self::RUTA_IMAGENES_GALLERY . $this->getImagen();
    }
}
?>