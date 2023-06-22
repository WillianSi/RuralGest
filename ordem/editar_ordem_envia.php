<?php
require_once("../valida_session/valida_session.php");
require_once("../bd/bd_ordem.php");

$codigo = $_POST["cod"];
$tipo = $_POST["tipo"];
$preco = $_POST['preco'];
$data_servico = $_POST['data_servico'];
$descricao = $_POST['descricao'];
$cod_servico = $_POST['cod_servico'];

// Verifique se um arquivo foi enviado
if (is_uploaded_file($_FILES['nota']['tmp_name'])) {
    $nota_fiscal = file_get_contents($_FILES['nota']['tmp_name']);
  } else {
    $nota_fiscal = 0; // Define como null caso nenhum arquivo tenha sido enviado
  }

if ($nota_fiscal === 0) {
    $dados = editarOrdem($codigo, $tipo, $preco, $data_servico, $descricao, $cod_servico);
    
    if ($dados == 1) {
        $_SESSION['texto_sucesso'] = 'Os dados de gastos foram alterados no sistema (editarOrdem).';
        header("Location: cad_ordem.php");
        exit;
    } else {
        $_SESSION['texto_erro'] = 'Os dados de gastos não foram alterados no sistema!';
        header("Location: cad_ordem.php");
        exit;
    }
}
else{
    // Read the contents of the uploaded file
    $nota_fiscal = file_get_contents($_FILES['nota']['tmp_name']);
    
    if ($nota_fiscal === false) {
        $_SESSION['texto_erro'] = 'Erro ao ler o arquivo de nota fiscal!';
        header("Location: cad_ordem.php");
        exit;
    }

    $dados = editarOrdemFiscal($codigo, $tipo, $preco, $data_servico, $descricao, $nota_fiscal, $cod_servico);
    
    if ($dados == 1) {
        $_SESSION['texto_sucesso'] = 'Os dados de gastos foram alterados no sistema (editarOrdemFiscal).';
        header("Location: cad_ordem.php");
        exit;
    } else {
        $_SESSION['texto_erro'] = 'Os dados de gastos não foram alterados no sistema!';
        header("Location: cad_ordem.php");
        exit;
    }
}
?>