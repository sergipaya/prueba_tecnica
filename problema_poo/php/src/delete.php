<?php
use Mailer\Mail;
include 'Mail.php';

session_start();
$user = unserialize($_SESSION['user']);

$usuarios_json = file_get_contents("usuarios.json");
$usuarios = json_decode($usuarios_json);

$index = -1;
foreach ($usuarios->usuarios as $usuario) {
    if ($usuario->email === $user->email) {
        $index = $usuario->id - 1;
    }
}

if ($index >= 0) {
    array_splice($usuarios->usuarios, $index, 1);
    file_put_contents("usuarios.json", json_encode($usuarios));

    try {
        $mail = new Mail(true, '192.168.33', 'usuario', 'pAss12345');
        $subject = 'Eliminación de cuenta';
        $message = "Su cuenta ha sido eliminada exitosamente.";
        $mail->send($user->email, $subject, $message);

        unset($_SESSION['user']);
        session_destroy();
        header('Location: /?mensaje=Mensaje enviado');
    } catch (Exception $e) {
        echo "". $e->getMessage() ."";
    }
}

