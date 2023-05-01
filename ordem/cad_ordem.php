
<?php
require_once('../valida_session/valida_session.php');
require_once('../layout/header.php'); 
require_once('../layout/sidebar.php');
require_once ("../bd/bd_servico.php");
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
                        <h6 class="m-0 font-weight-bold text-success" id="title">ADICIONAR DESPESAS/RECEITAS</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
             <?php
             if (isset($_SESSION['texto_erro'])):
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

                <form class="user" action="cad_ordem_envia.php" method="post" >
                    
                        <div class="form-group">
                            <label> Nome: </label>
                            <input type="text" class="form-control form-control-user2" id="nome" name="nome" value="<?php if (!empty($_SESSION['nome'])) { echo $_SESSION['nome'];} ?>"  
                            placeholder="Nome da receita ou despesa" required>
                        </div>

                        <div class="form-group">
                            <label> Servico: </label>
                            <select class="form-control" id="cod_servico" name="cod_servico">
                                <?php foreach($servicos as $dados):?>
                                <option value="<?=$dados['cod']?>"><?=$dados['nome']?></option> 
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Tipo: </label>
                            <select class="form-control" id="cod_terceirizado" name="cod_terceirizado">
                                <?php foreach($terceirizados as $dados):?>
                                <option value="<?=$dados['cod']?>"><?=$dados['nome']?></option> 
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Descrição: </label>
                            <textarea class="form-control form-control-user2" id="nome" name="nome" 
                            placeholder="Descrição da receita ou despesa" required rows="4"><?php if (!empty($_SESSION['nome'])) 
                            { echo $_SESSION['nome'];} ?></textarea> 
                            
                        </div>

                         <div class="form-group">
                            <label> Data do Serviço: </label>
                            <input type="date" class="form-control form-control-user2"
                            id="data_servico" name="data_servico" aria-describedby="emailHelp"
                            placeholder="00/00/0000" maxlength="10" onkeypress="mascaraData(this)"required>
                        </div>                          

                    <div class="card-footer text-muted" id="btn-form">
                        <div class=text-right>
                            <a title="Voltar" href="ordem.php"><button type="button" class="btn btn-success"><i class="fas fa-arrow-circle-left"></i>&nbsp;</i>Voltar</button></a>
                            <a title="Adicionar"><button type="submit" name="updatebtn" class="btn btn-primary uptadebtn"><i class="fas fa-fw fa-clipboard-list">&nbsp;</i>Adicionar</button> </a>
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


