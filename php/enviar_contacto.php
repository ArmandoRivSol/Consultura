<?php
include "conexion.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$nombre   = $_POST['nombre'];
$correo   = $_POST['correo'];
$telefono = $_POST['telefono'];
$mensaje  = $_POST['mensaje'];

mysqli_query($conn, "INSERT INTO solicitudes(nombre,correo,telefono,mensaje)
VALUES('$nombre','$correo','$telefono','$mensaje')");

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'chatcorporacion@gmail.com';
    $mail->Password   = 'cglu npap ogob qlql';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
    $mail->CharSet    = 'UTF-8';

    $mail->setFrom('chatcorporacion@gmail.com', 'Chat Corporación');

    $mail->addAddress('chatcorporacion@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Nueva solicitud de contacto';
    $mail->Body    = "
      <h3>Nueva solicitud recibida</h3>
      <p><b>Nombre:</b> $nombre</p>
      <p><b>Correo:</b> $correo</p>
      <p><b>Teléfono:</b> $telefono</p>
      <p><b>Mensaje:</b><br>$mensaje</p>
    ";

    $mail->send();

    $mail->clearAddresses();
    $mail->addAddress($correo);

    $mail->Subject = 'Hemos recibido tu solicitud';
    $mail->Body    = "
      <h3>Gracias por contactarnos</h3>
      <p>Hola <b>$nombre</b>,</p>
      <p>
        Hemos recibido tu solicitud correctamente.
        En Chat Corporación revisaremos tu mensaje
        y nos pondremos en contacto contigo lo antes posible.
      </p>
      <p>
        <b>Chat Corporación</b><br>
        Soluciones digitales para tu empresa
      </p>
    ";

    $mail->send();

    echo "<script>
      alert('Solicitud enviada correctamente. Revisa tu correo.');
      window.location.href = '../contacto.html';
    </script>";

} catch (Exception $e) {
    echo "Error al enviar correo: {$mail->ErrorInfo}";
}
