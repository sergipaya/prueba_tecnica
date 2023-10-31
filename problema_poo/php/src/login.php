<?php
use Mailer\Mail;

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuarios_json = file_get_contents("usuarios.json");
    $usuarios = json_decode($usuarios_json);

    try {
        $user;
        foreach ($usuarios->usuarios as $usuario) {
            if ($usuario->email == $_POST['email'] || $usuario->nombre == $_POST['nombre']) {
                $user = $usuario;
            }
        }
        if (!isset($user)) {
            throw new Exception('Usuario no encontrado');
        }
        if (isset($_POST['forgot'])) {
            try {
                $mail = new Mail(false, '192.168.1.22', null, null);

                $subject = 'Recordatorio de contraseña';
                $message = "
                    <p>Estimado usuari@</p>
                    <p>le recordamos que sus datos de acceso son los siguientes:</p>
                    <p>usuario: $user->nombre</p>
                    <p>password: $user->password</p>
                    <p>Un saludo.</p>
                ";

                $mail->send($user->email, $subject, $message);
                header('Location: /?mensaje=Mensaje enviado');
            } catch (Exception $e) {
                echo "". $e->getMessage() ."";
            }
        } else {
            if ($user->password == $_POST["password"]) {
                $_SESSION['user'] = serialize($user);
                header('Location: /user.view.php');
            } else {
                throw new Exception('Contraseña incorrecta');
            }
        }
    } catch (Exception $e) {
        echo "". $e->getMessage();
    }
}

require_once('login.view.php');