<?php 
	require_once("../valida_session/valida_session.php");
	require_once ("../bd/bd_generico.php");

	$codigo = $_GET['cod'];
	$tabela = "financas";
	$dados = removeDados($tabela,$codigo);

	if($dados == 0){
		$_SESSION['texto_erro'] = 'Os dados de gastos não foram excluidos do sistema!';
		header ("Location:cad_ordem.php");
	}else{
		$_SESSION['texto_sucesso'] = 'Os dados de gastos foram excluidos do sistema.';
		header ("Location:cad_ordem.php");
	}

?>