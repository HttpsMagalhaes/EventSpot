<?php

session_start();

require_once 'bd/conexao.php';
$connection = newConnection();

if (time() > $_SESSION['time'] + (60 * 60) or isset($_POST["logout"])) {
  session_unset();
  session_destroy();
  header("Location: login/login.php");
}

$name = "SELECT name from user where idUser = '" .$_SESSION["idUser"]. "'";
$name = $connection->query($name);
$name = $name->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EventSpot</title>
  <link rel="icon" href="img/event.png">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <nav>
    <div class="sidebar-top">
      <span class="shrink-btn">
        <i class='bx bx-chevron-left'></i>
      </span>
      <img src="img/logo.png" class="logo" alt="">
      <h3 class="hide">Event Spot</h3>
    </div>
    <hr>
    <div class="sidebar-links">
      <ul class="p-0">
        <div class="active-tab"></div>
        <li class="tooltip-element" data-tooltip="0">
          <a href="admin.php?dir=admin&file=adm_analysis" data-active="0">
            <div class="icon">
              <i class='bx bx-tachometer'></i>
              <i class='bx bxs-tachometer'></i>
            </div>
            <span class="link hide">Eventos em andamento</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="1">
          <a href="admin.php?dir=admin&file=adm_approved" data-active="1">
            <div class="icon">
              <i class='bx bx-folder'></i>
              <i class='bx bxs-folder'></i>
            </div>
            <span class="link hide">Eventos aceitos</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="2">
          <a href="admin.php?dir=admin&file=adm_refused" data-active="2">
            <div class="icon">
              <i class='bx bx-x'></i>
              <i class='bx bxs-x'></i>
            </div>
            <span class="link hide">Eventos negados</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="3">
          <a href="admin.php?dir=admin&file=adm_category" data-active="3">
            <div class="icon">
              <i class='bx bx-qr'></i>
              <i class='bx bxs-qr'></i>
            </div>
            <span class="link hide">Categorias</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="4">
          <a href="admin.php?dir=admin&file=adm_modality" data-active="4">
            <div class="icon">
              <i class='bx bx-qr'></i>
              <i class='bx bxs-qr'></i>
            </div>
            <span class="link hide">Modalidades</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="5">
          <a href="admin.php?dir=admin&file=profile" data-active="5">
            <div class="icon">
              <i class='bx bx-cog'></i>
              <i class='bx bxs-cog'></i>
            </div>
            <span class="link hide">Configurações</span>
          </a>
        </li>
      </ul>
    </div>

    <div class="sidebar-footer">
      <hr>
      <a class="account tooltip-element" data-tooltip="0">
        <i class='bx bx-user'></i>
      </a>
      <div class="admin-user tooltip-element" data-tooltip="1">
        <div class="admin-profile hide">
          <div class="admin-info">
            <h3><?= $name['name'] ?></h3>
            <h5>Usuário</h5>
          </div>
        </div>
        <form method="post">
          <button type="submit" class="log-out" name="logout">
            <i class='bx bx-log-out'></i>
          </button>
        </form>
      </div>
    </div>
  </nav>
  <main class="container-fluid d-flex justify-content-center w-75 p-3 m-auto mt-5">
    <?php
    if (isset($_GET['dir']) && isset($_GET['file'])) {
      include(__DIR__ . "/{$_GET['dir']}/{$_GET['file']}.php");
    } else {
      include(__DIR__ . "/admin/adm_analysis.php");
    }
    ?>
  </main>
  <script src="js/app.js"></script>
</body>

</html>