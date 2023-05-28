<?php
session_start();

$cod_servico = $_POST['cod_servico'];
$tipo = $_POST['tipo'];
$preco = $_POST['preco'];
$data_servico = $_POST['data_servico'];
$descricao = $_POST['descricao'];
if (isset($dados['nota'])) {
    $nota_fiscal = $dados['nota'];
} else {
    $nota_fiscal = '15'; // Valor padrão para nota_fiscal, caso não seja fornecido
}

require_once("../bd/bd_ordem.php");

$resultado = cadastraOrdem($tipo, $preco, $data_servico, $descricao, $nota_fiscal, $cod_servico);

if ($resultado == 1) {
    $_SESSION['texto_sucesso'] = 'Ordem de serviço aberta com sucesso.';
    unset($_SESSION['texto_erro']);
    header("Location: cad_ordem.php");
} else {
    $_SESSION['texto_erro'] = 'Os dados não foram adicionados no sistema!';
    header("Location: cad_ordem.php");
}
?>