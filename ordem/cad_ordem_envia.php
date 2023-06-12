<?php
session_start();

$cod_servico = $_POST['cod_servico'];
$tipo = $_POST['tipo'];
$preco = $_POST['preco'];
$data_servico = $_POST['data_servico'];
$descricao = $_POST['descricao'];

// Verifique se um arquivo foi enviado
if (!empty($_FILES['nota']['tmp_name'])) {
    $nota_fiscal = file_get_contents($_FILES['nota']['tmp_name']);
  } else {
    $nota_fiscal = 0; // Define como null caso nenhum arquivo tenha sido enviado
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