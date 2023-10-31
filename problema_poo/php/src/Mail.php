<?php
namespace Mailer;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include_once("../vendor/autoload.php");

class Mail {
    /**
    * Indica si la conexión con el servidor de correo requiere autenticación
    * @var <boolean>
    */
    private bool $authentication;
    /**
    * Indica el host donde se realizará la conexión con el servidor de correo
    * @var <string>
    */
    private string $host;
    /**
    * Indica el usuario que se empleará en la autenticación con el servidor de correo
    * @var <string>
    */
    private string $user;
    /**
    * Indica el password que se empleará en la autenticación con el servidor de correo
    * @var <string>
    */
    private string $password;
    public function __construct(bool $authentication, string $host, string $user='', string $password=''){
        $this->authentication = $authentication;
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }
    /**
    * Envia el email
    * @param <string> $to Es la dirección de email del destinatario
    * @param <string> $subject Es el asunto del mensaje
    * @param <string> $body Es el cuerpo del mensaje
    * @param <boolean> $is_html Indica si el cuerpo del mensaje está en formato html
    * @param <array> $para_cc Un array de direcciones de email para copia Cc
    * @param <array> $para_bcc Un array de direcciones de email para copia Bcc
    * @return <boolean> Devuelve true si se envia el email y lanza una excepción en caso de fallo
    */
    private function sendEmail($to, $subject, $body, $is_html=false, Array $para_cc=array(), Array
    $para_bcc=array()){
    //... Envia el email y devuelve true si todo ha ido bien o lanza una excepción si falla
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $this->host;

        if ($this->authentication) {
            $mail->SMTPAuth = true;
            $mail->Username = $this->user;
            $mail->Password = $this->password;
        }

        $mail->setFrom($this->user);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $body;
        if ($is_html) {
            $mail->isHTML(true);
        }

        if (!$mail->send()) {
            throw new Exception('El correo electrónico no se pudo enviar: ' . $mail->ErrorInfo);
        } else {
            return true;
        }
    }
    public function send($to, $subject, $body, $is_html = false, Array $para_cc = array(), Array $para_bcc = array()) {
        $resultado = $this->sendEmail($to, $subject, $body, $is_html, $para_cc, $para_bcc);

        return $resultado;
    }
}
?>