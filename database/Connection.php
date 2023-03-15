<?php

class Connection
{
    public static function make()
    {
        $host = 'localhost';
        $db = 'cronistagata';
        $user = 'cronista';      //Usuario con el que conectarse
        $pass = '1234';          //Contraseña del usuario

        //Creamos la conexion
        
        /*Una de las grandes ventajas de PDO es que cuando se produce un error provoca una excepción en lugar de un error,
        por tanto, las ppodemos capturar*/
        try
        {
            $opciones = [
                //Que utilice UTF8
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                //Que cuando se produce un error se genere una excepcion para poder capturarla
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                /*La conexión es persistente (crear la conexión y cuando finaliza, en vez de cerrarla automáticamente, 
                guardar la conexión para que en un posterior acceso, en vez de crearla le devolvera la creada anteriormente)
                Esto mejorará mucho el rendimiento*/
                PDO::ATTR_PERSISTENT => true
            ];

            $connection = new PDO(
                //Cadena de conexion (dsn) porque PDO puede trabajar con distintos motores de BBDD
                    //Motor de BBDD -> mysql
                    //Donde se encuentra el host donde vamos a trabajar -> 
                    //Nombre BBDD -> cursodaw;
                    //Conjunto de caracteres de las cadenas devueltas por la BBDD
                'mysql:host='.$host.';dbname='.$db.';charset=utf8',
                $user,
                $pass,
                //Array de opciones con la configuración de la conexión que estamos creando
                $opciones
            );
        }
        catch (PDOException $PDOException)
        {
            //die muestra el string que le pasas y detener la ejecución del script (como hacer un exit)
            die($PDOException->getMessage());
        }
        
        return $connection;
    }

}

?>