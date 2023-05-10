<?php
    session_start();
    session_destroy();
    echo "<h1>Has tancat Sesió correctament</h1><br>";
    header("Location: ../index.php");
?>