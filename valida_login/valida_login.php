<?php
session_start();
require_once ("../bd/bd_generico.php");

if ((empty($_POST['email'])) OR (empty($_POST['senha'])) ){
    header("Location: ../index.php"); 
}
else{

	$email = $_POST["email"];
	$senha = $_POST["senha"];

	$tabela= "usuario";
	$dados = checaLogin($tabela,$email,$senha);

	if($dados == "") {
		$_SESSION['texto_erro_login'] = 'Email ou Senha Inválido!';
	    header("Location:../index.php");
	}
	else {
	    // Salva os dados encontrados na sessão
	    $_SESSION['cod_usu'] = $dados['cod'];
		$_SESSION['nome_usu'] = $dados['nome'];
		$_SESSION['perfil'] = $dados['perfil'];
	    header("Location:../home/home.php");
	}
	die();
}