<?php

require_once("conecta_bd.php");

function consultaStatusUsuario($status)
{
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT count(*) AS total
                FROM financas WHERE status = ?");

    $query->bindParam(1, $status);
    $query->execute();
    $total = $query->fetchAll(PDO::FETCH_ASSOC);

    return $total;
}

function listaOrdem()
{
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT
                                    o.cod AS cod,
                                    u.nome AS nome_usuario,
                                    s.nome AS nome_servico,
                                    o.data_servico AS data_servico,
                                    o.status AS status
                                FROM  
                                financas f , servicos s, usuario u
                                WHERE 
                                    o.cod_usuario = u.cod AND
                                    o.cod_servico = s.cod");

    $query->execute();
    $lista = $query->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}

function cadastraOrdem($tipo, $preco, $data_servico, $descricao, $nota_fiscal, $cod_servico)
{
    $conexao = conecta_bd();

    $query = $conexao->prepare("INSERT INTO financas (tipo, preco, data_servico, descricao, nota_fiscal, cod_servico)
                                    VALUES (?, ?, ?, ?, ?, ?)");

    $query->bindParam(1, $tipo);
    $query->bindParam(2, $preco);
    $query->bindParam(3, $data_servico);
    $query->bindParam(4, $descricao);
    $query->bindParam(5, $nota_fiscal, PDO::PARAM_LOB); // Define o parâmetro como LOB (Large Object)
    $query->bindParam(6, $cod_servico);

    $retorno = $query->execute();
    if ($retorno) {
        return 1;
    } else {
        return 0;
    }
}



function buscaOrdemadd($cod_servico, $tipo, $preco, $data_servico, $descricao, $nota_fiscal)
{
    $conexao = conecta_bd();

    $query = $conexao->prepare("SELECT 
                                    data_servico,
                                    descricao,
                                    nota_fiscal
                                FROM 
                                    financas
                                WHERE 
                                    cod_servico = ? AND
                                    tipo = ? AND
                                    preco = ? AND
                                    data_servico = ? AND
                                    descricao = ? AND
                                    nota_fiscal = ?
                                ORDER BY cod DESC
                                LIMIT 1");

    $query->bindParam(1, $cod_servico);
    $query->bindParam(2, $tipo);
    $query->bindParam(3, $preco);
    $query->bindParam(4, $data_servico);
    $query->bindParam(5, $descricao);
    $query->bindParam(6, $nota_fiscal);

    $query->execute();

    $lista = $query->fetch(PDO::FETCH_ASSOC);
    return $lista;
}



function buscaOrdens()
{
    $conexao = conecta_bd();

    $query = $conexao->prepare("SELECT * FROM financas");
    $query->execute();

    $dados_ordem = $query->fetchAll(PDO::FETCH_ASSOC);

    return $dados_ordem;
}

function buscaOrdemeditar($codigo)
{
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT 
                                   f.cod AS cod,
                                   f.preco AS preco,
                                   f.data_servico AS data_servico,
                                   f.descricao AS descricao,
                                   f.nota_fiscal AS nota_fiscal
                               FROM financas f 
                               WHERE f.cod = :codigo");
    $query->bindParam(":codigo", $codigo);
    $query->execute();
    $dados = $query->fetch(PDO::FETCH_ASSOC);
    return $dados;
}


function editarOrdem($codigo, $preco, $data_servico, $descricao, $nota_fiscal)
{
    $conexao = conecta_bd();

    $query = $conexao->prepare("SELECT * FROM financas WHERE cod = ?");
    $query->bindParam(1, $codigo);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);

    if (count($retorno) > 0) {
        $query = $conexao->prepare("UPDATE financas SET preco = ?, data_servico = ?, descricao = ?, nota_fiscal = ? WHERE cod = ?");
        $query->bindParam(1, $preco);
        $query->bindParam(2, $data_servico);
        $query->bindParam(3, $descricao);
        $query->bindParam(4, $nota_fiscal);
        $query->bindParam(5, $codigo);

        $retorno = $query->execute(); //retorno boolean padrao TRUE
        if ($retorno) {
            return 1;
        } else {
            return 0;
        }
    }
}

function buscarNotaFiscal($cod) {
    $conexao = conecta_bd();

    $query = $conexao->prepare("SELECT nota_fiscal FROM financas WHERE cod = ?");
    $query->bindParam(1, $cod);
    $query->execute();

    $notaFiscal = $query->fetch(PDO::FETCH_ASSOC);

    if ($notaFiscal !== false) {
        return $notaFiscal;
    } else {
        return false;
    }
}
