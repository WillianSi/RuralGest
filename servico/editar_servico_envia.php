<?php
require_once('../valida_session/valida_session.php');
require_once ("../bd/bd_servico.php");
	     
$codigo = $_POST["cod"];
$nome = $_POST["nome"];


$dados = editarServico($codigo,$nome);
if ($dados == 1){
	$_SESSION['texto_sucesso'] = 'Os dados do serviço foram alterados no sistema.';
	header ("Location:servico.php");
}else{
	$_SESSION['texto_erro'] = 'Os dados do serviço não foram alterados no sistema!';
	header ("Location:servico.php");
}

		
?>