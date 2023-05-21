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

function listaDados($tabela){
  $conexao = conecta_bd();
  $query = $conexao->prepare("SELECT * FROM $tabela
              ORDER BY nome");

  $query->execute();
  $lista = $query->fetchAll(PDO::FETCH_ASSOC);

  return $lista;
}

function buscaDadoseditar($tabela,$codigo){
  $conexao = conecta_bd();
  $query = $conexao->prepare("SELECT * FROM $tabela
              WHERE cod = ?");

  $query->bindParam(1,$codigo);
  $query->execute();
  $lista = $query->fetch(PDO::FETCH_ASSOC);

  return $lista;
}

function removeDados($tabela,$codigo){
  $conexao = conecta_bd();

  $query = $conexao->prepare("DELETE FROM $tabela
              WHERE cod = ?");

  $query->bindParam(1,$codigo);
  $query->execute();
  $retorno = $query->execute();
  if ($retorno) {
      return 1;
  }else{
      return 0;
  }   
}
?>