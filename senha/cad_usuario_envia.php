<?php
session_start();
$nome = $_POST["nome"];
$senha = md5($_POST["senha"]);
$email = $_POST["email"];
$perfil = 1;
$status = 1;
$data=date("y/m/d");

require_once ("../bd/bd_usuario.php");

$tabela = "usuario";
$dados = consultaEmail($tabela,$email);

if($dados != 0){
	$_SESSION['texto_erro'] = 'Este email já existe cadastrado no sistema!';
	$_SESSION['nome'] = $nome;
	$_SESSION['email'] = $email;
	header ("Location:criar_conta.php");
}else{
	$dados = cadastraUsuario($nome,$senha,$email,$perfil,$status,$data);
	if($dados == 1){
		$_SESSION['texto_sucesso'] = 'Usuario criado com sucesso.';
		unset($_SESSION['texto_erro']);
		unset ($_SESSION['nome']);
		unset ($_SESSION['email']);
		unset ($_SESSION['senha']);
		header ("Location:../index.php");
	}else{
		$_SESSION['texto_erro'] = 'Usuario não foroi adicionado no sistema!';
		$_SESSION['nome_usu'] = $nome;
		$_SESSION['email'] = $email;
		header ("Location:criar_conta.php");
	}
	
}
?>