<?php 

require_once("conecta_bd.php");

function checaLogin($tabela,$email,$senha){
    $conexao = conecta_bd();
    $senhaMD5 = md5($senha);
    $query = $conexao->prepare("SELECT * 
              FROM 	$tabela
              WHERE email= ? and 
                senha= ? ");

    $query->bindParam(1,$email);
    $query->bindParam(2,$senhaMD5);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);

    return $retorno;
}

function consultaStatusClienteTercerizado($tabela,$cod_usuario,$status){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT count(*) AS total
                FROM $tabela
                WHERE cod_cliente = ? AND status = ?");

    $query->bindParam(1,$cod_usuario);
    $query->bindParam(2,$status);
    $query->execute();
    $total = $query->fetchAll(PDO::FETCH_ASSOC);

    return $total;
}

function listaDados($tabela){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT * FROM $tabela
                ORDER BY nome");

    $query->execute();
    $lista = $query->fetchAll(PDO::FETCH_ASSOC);

    return $lista;
}

?>