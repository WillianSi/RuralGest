<?php
session_start();
$nome = $_POST["nome"];

require_once ("../bd/bd_servico.php");

$dados = cadastraServico($nome);
if($dados == 1){
	$_SESSION['texto_sucesso'] = 'Dados adicionados com sucesso.';
	unset ($_SESSION['nome']);
	unset($_SESSION['texto_erro']);
	header ("Location:servico.php");
}else{
	$_SESSION['texto_erro'] = 'O dados não foram adicionados no sistema!';
	$_SESSION['nome'] = $nome;
	header ("Location:cad_servico.php");
}


?>