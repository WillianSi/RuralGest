<?php
require_once('../valida_session/valida_session.php');
require_once('../layout/header.php');
require_once('../layout/sidebar.php');
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
                        <h6 class="m-0 font-weight-bold text-success" id="title">GERENCIAR GASTOS</h6>
                    </div>
                    <div class="col-md-4 card_button_title">
                        <a title="Adicionar novo gasto" href="cad_ordem.php"><button type="button" class="btn btn-success btn-sm card_button_title" data-toggle="modal" id=" "> <i class="fas fa-fw fa-clipboard-list">&nbsp;</i> Adicionar Gasto</button></a>

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
                <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th class="text-center">Serviço</th>
                <th class="text-center">Preço</th>
                <th class="text-center">Descrição</th>
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
                echo "<td class='text-center'>" . $ordem['cod_servico'] . "</td>";
                echo "<td class='text-center'>" . $ordem['preco'] . "</td>";
                echo "<td class='text-center'>" . $ordem['descricao'] . "</td>";
                echo "<td class='text-center'><a href='atualizar_ordem.php?cod=" . $ordem['cod'] . "'><i class='fas fa-fw fa-edit'></i></a></td>";
                echo "<td class='text-center'><a href='excluir_ordem.php?cod=" . $ordem['cod'] . "'><i class='fas fa-fw fa-trash'></i></a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    <?php
    require_once('../layout/footer.php');
    ?>
</div>