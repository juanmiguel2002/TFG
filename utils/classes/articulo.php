<?php 

class articulo{

    const RUTA_IMAGENES_GALLERY = 'upload/';

    private $titulo;
    private $tema;
    private $fecha;
    private $texto;
    private $imagen;
    private $id;
    private $fk_temas;
    
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
    {   //substituimos la fecha que esta en la BBDD por la fecha normal
        return date('d-m-Y', strtotime($this->fecha));
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
    public function getFk_temas() {
        return $this->fk_temas;
    }

    public function setFk_Temas($fk_temas): articulo
    { 
        $this->fk_temas = $fk_temas;
        return $this;
    }
    public function getUrlGallery() : string
    {   
        return self::RUTA_IMAGENES_GALLERY . $this->getImagen();
    }

}
?>