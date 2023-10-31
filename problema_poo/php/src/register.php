<?php

use Mailer\Mail;

include 'Mail.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $usuarios_json = file_get_contents("usuarios.json");
    $usuarios = json_decode($usuarios_json, true);

    $user = [
        "id" => count($usuarios["usuarios"]) + 1,
        "nombre" => $nombre,
        "email" => $email,
        "password" => $password
    ];

    $usuarios["usuarios"][] = $user;
    file_put_contents("usuarios.json", json_encode($usuarios));

    try {
        $mail = new Mail(true, '192.168.1.66', 'registro', 'r3g1str0');
        $subject = 'Bienvenido a Mi Aplicación';
        $message = "
            <p>Bienvenido <strong>$nombre</strong>,</p>
            <p>Su registro se ha realizado con éxito.</p>
            <p>Esperamos que nuestros servicios sean de su agrado.</p>
            <p>Un saludo</p>
        ";

        $mail->send($email, $subject, $message, true);

        header('Location: /?mensaje=Mensaje enviado');
    } catch (Exception $e) {
        echo "". $e->getMessage();
    }
}

require_once('register.view.php');