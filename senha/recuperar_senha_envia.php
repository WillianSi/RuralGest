<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('../valida_login/PHPMailer/src/Exception.php');
require_once('../valida_login/PHPMailer/src/PHPMailer.php');
require_once('../valida_login/PHPMailer/src/SMTP.php');
require_once('../bd/conecta_bd.php');

if (isset($_POST['validar-email'])) {
    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['texto_erro'] = 'E-mail inválido';
	        header ("Location:../index.php");
    } else {
        $novasenha = substr(md5(time()), 0, 6);

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'josesilva9856443439848944@gmail.com';
            $mail->Password = '5^5d38soJktZ';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('josesilva9856443439848944@gmail.com', 'Ruralgest');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Sua nova senha';
            $mail->Body = 'Sua nova senha: ' . $novasenha;

            $mail->send();

            $sql = "UPDATE usuario SET senha = '$novasenha' WHERE email ='$email'";
            $consulta = $db->prepare($sql);
            $consulta->execute();

            $_SESSION['texto_sucesso'] = 'A senha foi alterada no sistema.';
            header ("Location:editar_senha.php");

        } catch (Exception $e) {
            $_SESSION['texto_erro'] = 'A senha não foi alterada no sistema!';
	        header ("Location:../index.php");
        }
    }
}