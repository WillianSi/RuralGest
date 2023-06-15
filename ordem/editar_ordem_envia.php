<?php
require_once("../valida_session/valida_session.php");
require_once ("../bd/bd_ordem.php");
	     
$codigo = $_POST["cod"];
$tipo = $_POST["tipo"];
$preco = $_POST['preco'];
$data_servico = $_POST['data_servico'];
$descricao = $_POST['descricao'];
$nota_fiscal = $_POST['nota_fiscal'];
$cod_servico = $_POST['cod_servico'];

$dados = editarOrdem($codigo,$tipo, $preco, $data_servico, $descricao, $nota_fiscal, $cod_servico);

if ($dados == 1){
	$_SESSION['texto_sucesso'] = 'Os dados de gastos foram alterados no sistema.';
	header ("Location:cad_ordem.php");
}else{
	$_SESSION['texto_erro'] = 'Os dados de gastos não foram alterados no sistema!';
	header ("Location:cad_ordem.php");
}	
?>