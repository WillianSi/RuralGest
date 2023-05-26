<?php
require_once('../valida_session/valida_session.php');
require_once('../layout/header.php'); 
require_once('../layout/sidebar.php'); 
require_once("../bd/bd_ordem.php");
require_once("../bd/bd_servico.php");

// Verifica se os valores foram enviados pelo formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenha os valores necessários
    $cod_servico = $_POST['cod_servico'] ?? '';
    $tipo = $_POST['tipo'];
    $preco = $_POST['preco'] ?? '';
    $data_servico = $_POST['data_servico'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $nota_fiscal = $_POST['nota_fiscal'] ?? '';

    $resultado = cadastraOrdem($cod_servico, $tipo, $preco, $data_servico, $descricao, $nota_fiscal);
    $dados = buscaOrdemadd($cod_servico, $tipo, $preco, $data_servico, $descricao, $nota_fiscal);
}
?>

<!-- Resto do seu código aqui -->


<!-- Resto do seu código aqui -->


<!-- Main Content -->
<div id="content">
    <?php require_once('../layout/navbar.php');?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="m-0 font-weight-bold text-primary" id="title">ORDEM DE SERVIÇO</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <?php
            if (isset($_SESSION['texto_sucesso'])):
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

<form class="user" action="cad_ordem_envia.php" method="post">
    <div class="form-group">
        <label> Serviço </label>
        <input type="text" class="form-control form-control-user" id="cod_servico" name="nome_servico" value="<?= isset($_POST['nome_servico']) ? $_POST['nome_servico'] : '' ?>" readonly>
    </div>

    <div class="form-group">
        <label> Preço </label>
        <input type="text" class="form-control form-control-user" id="preco" name="preco" value="<?= isset($_POST['preco']) ? $_POST['preco'] : '' ?>" readonly>
    </div>

    <div class="form-group">
        <label> Tipo </label>
        <input type="text" class="form-control form-control-user" id="tipo" name="tipo" value="<?= isset($_POST['tipo']) ? $_POST['tipo'] : '' ?>" readonly>
    </div> 

    <div class="form-group">
        <label> Data do Serviço </label>
        <input type="text" class="form-control form-control-user" id="data_servico" name="data_servico" value="<?= date('d/m/Y',strtotime($_POST['data_servico'])) ?>" readonly>
    </div>

    <div class="form-group">
        <label> Descrição </label>
        <input type="text" class="form-control form-control-user" id="descricao" name="descricao" value="<?= $_POST['descricao'] ?>" readonly>
    </div> 
    
    <div class="form-group">
        <label> Nota Fiscal </label>
        <input type="text" class="form-control form-control-user" id="formfile" name="nota" value="<?= $_POST['nota_fiscal'] ?>" readonly>
    </div> 

    <div class="card-footer text-muted" id="btn-form">
        <div class=text-right>
            <a title="Voltar" href="ordem.php">
                <button type="button" class="btn btn-success">
                    <i class="fas fa-arrow-circle-left"></i>&nbsp;Voltar
                </button>
            </a>
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