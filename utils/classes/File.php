<?php
require_once 'exceptions/FileException.php';

/*
UPLOAD_ERR_OK - Value: 0
    There is no error, the file uploaded with success.
UPLOAD_ERR_INI_SIZE - Value: 1
    The uploaded file exceeds the upload_max_filesize directive in php.ini.
UPLOAD_ERR_FORM_SIZE - Value: 2
    The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.
UPLOAD_ERR_PARTIAL - Value: 3
    The uploaded file was only partially uploaded.
UPLOAD_ERR_NO_FILE - Value: 4
    No file was uploaded.
UPLOAD_ERR_NO_TMP_DIR - Value: 6
    Missing a temporary folder.
UPLOAD_ERR_CANT_WRITE - Value: 7
    Failed to write file to disk.
UPLOAD_ERR_EXTENSION - Value: 8
    A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension
    caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help
*/

class File
{
    private $file;
    private $fileName;

    public function __construct(string $fileName, array $arrTypes)
    {
        $tmpFile = $_FILES[$fileName];

        if (!isset($tmpFile) || ($tmpFile['name'] == ""))
        {
            throw new FileException('Debes seleccionar un fichero');
        }
        elseif ($tmpFile['error'] !== UPLOAD_ERR_OK)
        {
            switch ($tmpFile['error']){
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new FileException('El fichero es demasiado grande');
                    break;
                case UPLOAD_ERR_PARTIAL:
                    throw new FileException('No se ha podido subir el fichero completo');
                    break;
                default:
                    throw new FileException('No se ha podido subir el fichero');

            }
        }
        elseif (in_array($tmpFile['type'], $arrTypes) === false)
        {
            throw new FileException('El tipo del fichero no está soportado.');
        }
        else
        {
            $this->file = $tmpFile;
            $this->fileName = $this->file['name'];
        }
    }

    public function getFileName(){
        return $this->fileName;
    }

    public function saveUploadFile(string $rutaDestino)
    {
        if (is_uploaded_file($this->file['tmp_name']) === false)
        {
            throw new FileException('El archivo no ha sido subido mediante un formulario');
        }

        $ruta = $rutaDestino . $this->fileName;

        if (is_file($ruta) === true){
            //$this->fileName = time() . '_' . $this->fileName;
            //$this->fileName = date('Y').date('m').date('d').date('H').date('i').date('s') . '_' . $this->fileName;
            $ruta = $rutaDestino . $this->fileName;
        }

        if (move_uploaded_file($this->file['tmp_name'], $ruta) === false)
        {
            throw new FileException('No se puede mover el fichero a su destino');
        }
    }
}

?>