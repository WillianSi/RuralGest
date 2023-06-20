<?php
require_once("../bd/bd_ordem.php"); // Inclua o arquivo que contém a função para buscar a nota fiscal

if (isset($_GET['cod'])) {
    $cod = $_GET['cod'];
    $notaFiscal = buscarNotaFiscal($cod); // Função que busca a nota fiscal a partir do código da ordem de serviço

    if ($notaFiscal !== false && !empty($notaFiscal['nota_fiscal'])) {
        $fileData = $notaFiscal['nota_fiscal'];

        // Define os cabeçalhos apropriados
        header("Content-Type: application/pdf");
        header("Content-Disposition: inline; filename=nota_fiscal.pdf");

        // Exibe o conteúdo do arquivo PDF
        echo $fileData;
        exit;
    }
}

// Caso ocorra algum erro ou a nota fiscal não seja encontrada, redirecione para a página de erro ou para a página inicial, por exemplo.
header("Location: ../ordem/ordem.php");
exit;
?>