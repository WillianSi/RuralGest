<?php 

require_once("conecta_bd.php");

function cadastraServico($nome){
    $conexao = conecta_bd();

    $query = $conexao->prepare("INSERT INTO servicos(nome) VALUES (?)");

    $query->bindParam(1,$nome);
    $retorno = $query->execute();
    if($retorno){
        return 1;
    } else{
        return 0;
    }        
}

function editarServico($codigo,$nome){
    $conexao = conecta_bd();

    $query = $conexao->prepare("SELECT * FROM servicos WHERE cod = ?");
    $query->bindParam(1,$codigo);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);

    if(count($retorno) > 0){
        $query = $conexao->prepare("UPDATE servicos SET nome = ? WHERE cod = ?");
        $query->bindParam(1, $nome);
        $query->bindParam(2, $codigo);
        $retorno = $query->execute();//retorno boolean padrao TRUE
        if($retorno){
            return 1;
        } else{
            return 0;
        }      
    }
}
?>