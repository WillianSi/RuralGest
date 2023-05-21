<?php
require_once("../valida_session/valida_session.php");
	     
$codigo = $_SESSION['cod_usu'];
$senha = md5($_POST["senha"]);

require_once ("../bd/bd_usuario.php");
$tabela = 'usuario';
$dados = editarSenha($tabela,$codigo,$senha);

if ($dados == 1){
	$_SESSION['texto_sucesso'] = 'A senha foi alterada no sistema.';
	header ("Location:editar_senha.php");
}else{
	$_SESSION['texto_erro'] = 'A senha não foi alterada no sistema!';
	header ("Location:editar_senha.php");
}

?>