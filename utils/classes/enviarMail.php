<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $imagenes = $_SESSION['imagenes'];
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host = 'smtp.office365.com';                       // Set the SMTP server to send through
    $mail->From = 'cronistadegata@outlook.es';   
    $mail->CharSet = 'UTF-8';                                   //permitir envío de caracteres especiales (tildes y ñ)
    $mail->SMTPAuth= true;                                   // Enable SMTP authentication
    $mail->Username = 'cronistadegata@outlook.es';          // SMTP username
    $mail->Password = 'Crongata2023';                                     // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable implicit TLS encryption
    $mail->Port = 587;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ]
    ];

    $nombre = isset($_SESSION['nombre'])? $_SESSION['nombre'] : "";
    //Recipients
    $mail->setFrom('cronistadegata@outlook.es', '');                                     // Set sender (email, name)
    $mail->addAddress($_SESSION['email'], $_SESSION['nombre']);                                // Add a recipient (email, name)
    $mail->addReplyTo('cronistadegata@outlook.es', '');  
    //CONFIGURACIÓN DEL MENSAJE, EL CUERPO DEL MENSAJE
    $mail->isHTML(true);
    $mail->Subject = 'Colaboció o aport de '. $nombre; // Set email subject
    //cuerpo del email
    $mail->Body = $_SESSION['texto'] . '
    <h3>Colaboració de '.$nombre.'</h3><footer><h3>Cronista de Gata de Gorgos</h3></footer>';   // Set email body
    foreach ($imagenes['tmp_name'] as $index => $imagenTemporal) {//recorremos el array de imagenes para insertar las imagenes
        if (is_uploaded_file($imagenTemporal)) {
            $imagenNombre = $imagenes['name'][$index]; //recorremos el nombre de la imagen
            $mail->addAttachment($imagenTemporal, $imagenNombre);//añadimos las imagens al correo electrónico
        }
    }
    if ($mail->Send()) {
        echo'<script type="text/javascript">
                alert("Enviado Correctamente.");
            </script>';
    } else {
        echo'<script type="text/javascript">
                alert("NO ENVIADO, intentar de nuevo.");
            </script>';
    }
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
