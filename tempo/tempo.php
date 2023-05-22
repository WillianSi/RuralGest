<?php
require_once('../valida_session/valida_session.php');
require_once('../layout/header.php');
require_once('../layout/sidebar.php');
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" 
integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" 
crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/styles.css" />
<script src="js/scripts.js" defer></script>

<div id="content">
  <?php require_once('../layout/navbar.php'); ?>

  <div class="container">
    <div class="form">
      <h3>Confira o clima:</h3>
      <div class="form-input-container">
        <input type="text" placeholder="Digite o nome da cidade" id="city-input" />
        <button id="search">
          <i class="fas fa-search fa-sm"></i>
        </button>
      </div>
    </div>

    <div id="weather-data" class="hide">
      <h2><i class="fa-solid fa-location-dot"></i> <span id="city"></span> <img id="country"></img></h2>
      <p id="temperature"><span></span>&deg;C</p>
      <div id="description-container">
        <p id="description"></p>
        <img id="weather-icon" src="" alt="Condições atuais">
      </div>
      <div id="details-container">
        <p id="umidity">
          <i class="fa-solid fa-droplet"></i>
          <span></span>
        </p>
        <p id="wind">
          <i class="fa-solid fa-wind"></i>
          <span></span>
        </p>
      </div>
    </div>
    
    <div id="error-message" class="hide">
      <p>Não foi possível encontrar o clima de uma cidade com este nome.</p>
    </div>
    <div id="loader" class="hide">
      <i class="fa-solid fa-spinner"></i>
    </div>
    <div id="suggestions">
      <button id="machado">Machado</button>
      <button id="carvalhópolis">Carvalhópolis</button>
      <button id="turvolândia">Turvolândia</button>
      <button id="poço_fundo">Poço Fundo</button>
    </div>
  </div>
</div>

<!-- End of Main Content -->
<?php
require_once('../layout/footer.php');
?>