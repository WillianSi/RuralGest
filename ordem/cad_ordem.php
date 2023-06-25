<?php
require_once('../valida_session/valida_session.php');
require_once('../layout/header.php');
require_once('../layout/sidebar.php');
require_once("../bd/bd_generico.php");
require_once("../bd/bd_ordem.php");

$tabela = "servicos";
$servicos = listaDados($tabela);
?>

<!-- Main Content -->
<div id="content">

    <?php require_once('../layout/navbar.php'); ?>

    <div class="container-fluid">

        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="m-0 font-weight-bold text-success" id="title">ADICIONAR DESPESAS/RECEITAS</h6>
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

                <form enctype="multipart/form-data" class="user" action="cad_ordem_envia.php" method="post" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-md-6">
                            <label> Servico </label>
                            <select class="form-control" id="cod_servico" name="cod_servico">
                                <?php foreach ($servicos as $dados) : ?>
                                    <option value="<?= $dados['cod'] ?>"><?= $dados['nome'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="preco">Preço:</label>
                                <input type="text" class="form-control form-control-user2" id="preco" name="preco" value="<?php if (!empty($_SESSION['preco'])) {echo $_SESSION['preco'];} ?>" placeholder="50.00" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo">Tipo:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" id="tipo" value="1" checked>
                                    <label class="form-check-label" for="despesa">
                                        Despesa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" id="tipo" value="0" checked>
                                    <label class="form-check-label" for="receita">
                                        Receita
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data_servico">Data do Serviço:</label>
                                <input type="date" class="form-control form-control-user2" id="data_servico" name="data_servico" aria-describedby="emailHelp" placeholder="00/00/0000" maxlength="10" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Descrição (Opcional):</label>
                        <textarea class="form-control form-control-user2" id="descricao" name="descricao" placeholder="Descrição da receita ou despesa" rows="4"><?php if (!empty($_SESSION['descricao'])) {
                                                                                                                                                                        echo $_SESSION['descricao'];
                                                                                                                                                                    } ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nota_fiscal">Nota fiscal (opcional):</label><br>
                        <input class="form-control-user2" type="file" id="nota" accept=".pdf,.jpg,.jpeg" name="nota" value="<?php if (!empty($_SESSION['nota_fiscal'])) {echo $_SESSION['nota_fiscal'];} ?>">
                    </div>
                    <div class="card-footer text-muted" id="btn-form">
                        <div class=text-right>
                            <a title="Voltar" href="../home/home.php"><button type="button" class="btn btn-success"><i class="fas fa-arrow-circle-left"></i>&nbsp;</i>Voltar</button></a>
                            <button type="submit" name="updatebtn" class="btn btn-primary uptadebtn"><i class="fas fa-fw fa-clipboard-list">&nbsp;</i>Adicionar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Begin Page Content -->
<div class="container-fluid mt-4">

    <?php require_once('../layout/navbar.php'); ?>

    <div class="card shadow mb-2">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-8">
                    <h6 class="m-0 font-weight-bold text-success" id="title">GERENCIAR GASTOS</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="display:none" ;>cod</th>
                        <th class="text-center">Serviço</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Preço</th>
                        <th class="text-center">Data do Serviço</th>
                        <th class="text-center">Descrição</th>
                        <th class="text-center">Nota fiscal</th>
                        <th class="text-center" data-orderable="false">Atualizar</th>
                        <th class="text-center" data-orderable="false">Excluir</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    require_once("../bd/bd_ordem.php"); // Inclua o arquivo que contém a função buscarOrdens()

                    $ordens = buscaOrdens(); // Obtém os dados das ordens do banco de dados

                    foreach ($ordens as $ordem) {
                        echo "<tr>";
                        echo "<td style='display:none'>" . $ordem['cod'] . "</td>";
                        // Obter o nome do serviço com base no código do serviço
                        $tabela = 'servicos';
                        $servicos = listaDados($tabela);
                        $nomeServico = '';
                        foreach ($servicos as $servico) {
                            if ($servico['cod'] == $ordem['cod_servico']) {
                                $nomeServico = $servico['nome'];
                                break;
                            }
                        }
                        echo "<td class='text-center'>" . $nomeServico . "</td>";

                        // Exibir "Despesa" se cod_servico for igual a 1
                        if ($ordem['tipo'] == 1) {
                            echo "<td class='text-center'>Despesa</td>";
                        }
                        // Exibir "Receita" se cod_servico for igual a 0
                        if ($ordem['tipo'] == 0) {
                            echo "<td class='text-center'>Receita</td>";
                        }
                        echo "<td class='text-center'>" . $ordem['preco'] . "</td>";
                        echo "<td class='text-center'>" . $ordem['data_servico'] . "</td>";
                        echo "<td class='text-center'>" . $ordem['descricao'] . "</td>";
                        echo "<td class='text-center'>";
                        if (!empty($ordem['nota_fiscal'])) {
                            // Verifica se há um arquivo salvo
                            echo "<a href='mostrar_nota.php?cod=" . $ordem['cod'] . "'>Visualizar</a>";
                        } else {
                            echo "N/A";
                        }
                        echo "<td class='text-center'><a href='editar_ordem.php?cod=" . $ordem['cod'] . "'><i class='fas fa-fw fa-edit'></i></a></td>";
                        echo "<td class='text-center'><a href='remove_ordem.php?cod=" . $ordem['cod'] . "'><i class='fas fa-fw fa-trash'></i></a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End of Main Content -->

<?php
require_once('../layout/footer.php');
?>

<script>
    function toggleBarra() {
        var barra = document.getElementById("barra-componentes");

        if (barra.style.display === "none") {
            barra.style.display = "block";
        } else {
            barra.style.display = "none";
        }
    }
</script>