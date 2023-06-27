<?php 

require_once("conecta_bd.php");

function consultaEmail($tabela,$email)
{
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT * FROM $tabela
                WHERE email = ?");

    $query->bindParam(1,$email);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);
    if ($retorno) {
        return 1;
    }else{
        return 0;
    }   
}

function cadastraUsuario($nome,$senha,$email,$data)
{
    $conexao = conecta_bd();

    $query = $conexao->prepare("INSERT INTO usuario(nome,senha,email,
        data) VALUES (?,?,?,?)");

    $query->bindParam(1,$nome);
    $query->bindParam(2,$senha);
    $query->bindParam(3,$email);
    $query->bindParam(4,$data);
    $retorno = $query->execute();
    if($retorno){
        return 1;
    } else{
        return 0;
    }        
}

function buscaDadoseditarPerfil($tabela,$codigo)
{
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT * FROM $tabela
                WHERE cod = ?");

    $query->bindParam(1,$codigo);
    $query->execute();
    $lista = $query->fetch(PDO::FETCH_ASSOC);

    return $lista;
}

function editarPerfilUsuario($codigo,$nome,$email,$data)
{
    $conexao = conecta_bd();

    $query = $conexao->prepare("SELECT * FROM usuario WHERE cod = ?");
    $query->bindParam(1,$codigo);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);
    if(count($retorno) > 0){
        $query = $conexao->prepare("UPDATE usuario SET nome = ?, email = ?, data = ? WHERE cod = ?");
        $query->bindParam(1, $nome);
        $query->bindParam(2, $email);
        $query->bindParam(3, $data);
        $query->bindParam(4, $codigo);
        $retorno = $query->execute();//retorno boolean padrao TRUE
        if($retorno){
            return 1;
        } else{
            return 0;
        }        
    }

}

function editarSenha($tabela,$codigo,$senha)
{
    $conexao = conecta_bd();

    $query = $conexao->prepare("SELECT * FROM $tabela WHERE cod = ?");
    $query->bindParam(1,$codigo);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);
    if(count($retorno) > 0){
        $query = $conexao->prepare("UPDATE $tabela SET senha = ? WHERE cod = ?");
        $query->bindParam(1, $senha);
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