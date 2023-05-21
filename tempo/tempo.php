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
						<h6 class="m-0 font-weight-bold text-success" id="title">PREVISÃO DO TEMPO</h6>
					</div>
				</div>
			</div>
		</div>
	</div>

	<form method="GET" action="" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
		<div class="input-group">
			<input type="text" name="city" id="city" class="form-control small" placeholder="Digite a cidade">
			<div class="input-group-append">
				<button class="btn btn-success" type="submit">
					<i class="fas fa-fw fa-sun">&nbsp;</i>Previsão
				</button>
			</div>
		</div>
	</form>
	<!-- /.container-fluid -->

	<?php
	if (isset($_GET['city'])) {
		$city = $_GET['city'];
		$apiKey = 'YOUR_API_KEY'; // Insira sua chave de API do OpenWeatherMap aqui

		$apiUrl = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=metric";
		$response = file_get_contents($apiUrl);

		if ($response) {
			$data = json_decode($response, true);

			if ($data && $data['cod'] === 200) {
				$weatherDescription = $data['weather'][0]['description'];
				$temperature = $data['main']['temp'];
				$humidity = $data['main']['humidity'];

				echo "<h2>Tempo em $city:</h2>";
				echo "<p>Descrição: $weatherDescription</p>";
				echo "<p>Temperatura: $temperature °C</p>";
				echo "<p>Humidade: $humidity%</p>";
			} else {
				echo "Erro: não foi possível buscar dados meteorológicos.";
			}
		} else {
			echo "Erro: não foi possível conectar-se à API do clima.";
		}
	}
	?>
</div>
<!-- End of Main Content -->
<?php
require_once('../layout/footer.php');
?>