<?php

require_once("../bd/conecta_bd.php");

if (isset($_POST['validar-email'])) {


    
    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['texto_erro'] = 'E-mail inválido';
        header("Location:../index.php");
    } else {
        $novasenha = substr(md5(time()), 0, 6);

        $to = $email;
        $subject = 'Sua nova senha';
        $message = 'Sua nova senha: ' . $novasenha;

        $headers = "From: remetente@example.com\r\n";
        $headers .= "Reply-To: remetente@example.com\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        if (mail($to, $subject, $message, $headers)) {
            $sql = "UPDATE usuario SET senha = '$novasenha' WHERE email ='$email'";
            $consulta = $db->prepare($sql);
            $consulta->execute();

            $_SESSION['texto_sucesso'] = 'A senha foi alterada no sistema.';
            header("Location:recuperar_senha.php");
        } else {
            $_SESSION['texto_erro'] = 'A senha não foi alterada no sistema!';
            header("Location:recuperar_senha.php");
        }
    }
}
?>