<?php
    // Configuración de la conexión a la base de datos
    $dsn = "mysql:host=localhost;dbname=cron;charset=utf8mb4";
    $usuario = "cronista";
    $contraseña = "1234";

    // Opciones de PDO
    $opciones = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
    ];

    try {
        // Crear instancia de PDO
        $pdo = new PDO($dsn, $usuario, $contraseña, $opciones);
    } catch (PDOException $e) {
        // Manejar errores de conexión
        echo "Ocurrió un error al conectar a la base de datos: " . $e->getMessage();
        exit;
    }
?>