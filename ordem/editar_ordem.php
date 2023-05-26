
<?php
require_once('../valida_session/valida_session.php');
require_once('../layout/header.php'); 
require_once('../layout/sidebar.php');
require_once ("../bd/bd_ordem.php");

$codigo = $_GET['cod'];
$dados = buscaOrdemeditar($codigo);

$cod = $dados["cod"];
//$cod_servico = $dados['cod_servico'];
//$tipo = $dados['tipo'];
$preco = $dados['preco'];
$data_servico = $dados['data_servico'];
$descricao = $dados['descricao'];
$nota_fiscal = $dados['nota_fiscal'];


?>

<!-- Main Content -->
<div id="content">

    <?php require_once('../layout/navbar.php');?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="m-0 font-weight-bold text-primary" id="title">ATUALIZAR DADOS DA ORDEM DE SERVIÇO</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="user" action="editar_ordem_envia.php" method="post">
                    <input type="hidden" name="cod" value="<?=$cod?>">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label> Serviço </label>
                            <input type="text" class="form-control form-control-user" id="cod_servico" name="cod_servico" value="<?= $servico ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label> Tipo </label>
                            <input type="text" class="form-control form-control-user" id="tipo" name="tipo" value="<?= $tipo ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="preco">Preço:</label>
                            <input type="text" class="form-control form-control-user2" id="preco" name="preco" value="<?= $preco ?>" required>
                        </div>
                        <div class="col-sm-6">
                            <label> Data do Serviço </label>
                            <input type="date" class="form-control form-control-user" id="data_servico" name="data_servico" value="<?= $data_servico ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                             <div class="col-sm-6">
                             <label>Descrição:</label>
                        <textarea class="form-control form-control-user2" id="descricao" name="descricao" placeholder="Descrição da receita ou despesa" rows="4"><?= $descricao ?></textarea>
                            </div>                   
                    </div>

                    <div class="form-group row">
                             <div class="col-sm-6">
                             <label for="nota_fiscal">Nota fiscal:</label><br>
                        <input class="form-control-user2" type="file" id="formFile" accept=".pdf,.jpg,.jpeg" name="nota" value="<?= $nota_fiscal ?>" required>
                            </div>                   
                    </div>
                    <div class="card-footer text-muted" id="btn-form">
                        <div class=text-right>
                            <a title="Voltar" href="cad_ordem.php"><button type="button" class="btn btn-success"><i class="fas fa-arrow-circle-left"></i>&nbsp;</i>Voltar</button></a>
                            <a title="Adicionar"><button type="submit" name="updatebtn" class="btn btn-primary uptadebtn"><i class="fas fa-edit">&nbsp;</i>Atualizar</button> </a>
                        </div>
                    </div>
                </form>  
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php
require_once('../layout/footer.php');
?>