<?php
require_once('../valida_session/valida_session.php');
require_once('../layout/header.php');
require_once('../layout/sidebar.php');
require_once("../bd/bd_generico.php");

$codigo = $_GET['cod'];
$tabela = 'financas';
$dados = buscaDadoseditar($tabela, $codigo);

$tabela = "servicos";
$servicos = listaDados($tabela);

$cod = $dados["cod"];
$cod_servico = $dados['cod_servico'];
$tipo = $dados['tipo'];
$preco = $dados['preco'];
$data_servico = $dados['data_servico'];
$descricao = $dados['descricao'];
$nota_fiscal = base64_decode($dados['nota_fiscal']);

?>

<!-- Main Content -->
<div id="content">

    <?php require_once('../layout/navbar.php'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="m-0 font-weight-bold text-success" id="title">ATUALIZAR DADOS DA ORDEM DE SERVIÇO</h6>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <?php
                if (isset($_SESSION['texto_erro'])) :
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?= $_SESSION['texto_erro'] ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                    unset($_SESSION['texto_erro']);
                endif;
                ?>
                <?php
                if (isset($_SESSION['texto_sucesso'])) :
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-check"></i>&nbsp;&nbsp;<?= $_SESSION['texto_sucesso'] ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                    unset($_SESSION['texto_sucesso']);
                endif;
                ?>

                <form enctype="multipart/form-data" class="user" action="editar_ordem_envia.php" method="post">
                    <input type="hidden" name="cod" value="<?= $cod ?>">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label> Serviço </label>
                            <select class="form-control" id="cod_servico" name="cod_servico">
                                <?php foreach ($servicos as $dados) : ?>
                                    <option value="<?= $dados['cod'] ?>" <?= ($dados['cod'] == $cod_servico) ? 'selected' : '' ?>>
                                        <?= $dados['nome'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="preco">Preço:</label>
                            <input type="text" class="form-control form-control" id="preco" name="preco" value="<?= $preco ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo">Tipo:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" id="despesa" value="1" <?php echo ($tipo == 1) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="despesa">
                                        Despesa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" id="receita" value="0" <?php echo ($tipo == 0) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="receita">
                                        Receita
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label> Data do Serviço </label>
                            <input type="date" class="form-control form-control" id="data_servico" name="data_servico" value="<?= $data_servico ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Descrição (Opcional):</label>
                            <textarea class="form-control form-control-user2" id="descricao" name="descricao" placeholder="Descrição da receita ou despesa" rows="4"><?= $descricao ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="nota_fiscal">Nota fiscal (opcional):</label><br>
                            <a href="mostrar_nota.php?cod=<?= $cod ?>" class="btn btn-success">Visualizar</a>
                            <input class="form-control-user2" type="file" id="nota" accept=".pdf,.jpg,.jpeg" name="nota" value="<?php if (!empty($_SESSION['nota_fiscal'])) {
                                                                                                                                    echo $_SESSION['nota_fiscal'];
                                                                                                                                } ?>">
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