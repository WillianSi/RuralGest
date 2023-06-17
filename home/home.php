<?php
require_once('../valida_session/valida_session.php');
require_once('../layout/header.php');
require_once('../layout/sidebar.php');
require_once('../bd/bd_generico.php');
?>

<!-- Main Content -->
<div id="content">
    <?php require_once('../layout/navbar.php'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid mb-4">

        <!-- Content Row -->
        <div class="row justify-content-center mt-4">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4 mr-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Lucro (Total)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        $tabela = "financas"; // Nome da tabela no seu banco de dados
                                        $tipo = 0; // Código a ser usado na consulta
                                        $soma_despesas = buscaDadosSomar($tabela, $tipo);
                                        echo "$" . number_format($soma_despesas, 2);
                                        ?>
                                    </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-arrow-up fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4 mr-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Despesas (Total)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        $tabela = "financas"; // Nome da tabela no seu banco de dados
                                        $tipo = 1; // Código a ser usado na consulta
                                        $soma_despesas = buscaDadosSomar($tabela, $tipo);
                                        echo "$" . number_format($soma_despesas, 2);
                                        ?>
                                    </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-arrow-down fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card o-hidden border-0 shadow-lg">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Cotações</h1>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <?php
                                    // Faz a requisição
                                    $url = "https://economia.awesomeapi.com.br/json/last/USD-BRL,EUR-BRL,BTC-BRL,CNY-BRL";
                                    $response = file_get_contents($url);
                                    $data = json_decode($response, true);

                                    // Verifica se a requisição foi bem-sucedida
                                    if ($data !== null) {
                                        // Obtém os valores de câmbio
                                        $currencies = ["USDBRL", "EURBRL", "BTCBRL", "CNYBRL"];

                                        // Loop para imprimir os cards
                                        foreach ($currencies as $currency) {
                                            $current_currency = $data[$currency];
                                            $bid = number_format((float)$current_currency["bid"], 2, '.', '');

                                            $card = '
                                            <div class="col-xl-4 col-md-6 mb-4 mr-4">
                                                <div class="card border-left-info shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                                    ' . $current_currency["name"] . '
                                                                </div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                                    ' . $bid . '
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            ';
                                            echo $card;
                                        }
                                    } else {
                                        echo "Falha na requisição.";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require_once('../layout/footer.php');
    ?>
</div>