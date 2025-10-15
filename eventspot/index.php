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
          <a href="#" data-active="0">
            <div class="icon">
              <i class='bx bx-tachometer'></i>
              <i class='bx bxs-tachometer'></i>
            </div>
            <span class="link hide">Home</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="1">
          <a href="login/login.php" data-active="1">
            <div class="icon">
              <i class='bx bx-folder'></i>
              <i class='bx bxs-folder'></i>
            </div>
            <span class="link hide">Meus eventos</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="2">
          <a href="index.php?dir=pages&file=support" data-active="2">
            <div class="icon">
              <i class='bx bx-message-square-detail'></i>
              <i class='bx bxs-message-square-detail'></i>
            </div>
            <span class="link hide">Contato</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="3">
          <a href="login/login.php" data-active="3">
            <div class="icon">
              <i class='bx bx-cog'></i>
              <i class='bx bxs-cog'></i>
            </div>
            <span class="link hide">Configurações</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="4">
          <a href="login/login.php" data-active="4">
            <div class="icon">
              <i class='bx bx-news'></i>
              <i class='bx bxs-news'></i>
            </div>
            <span class="link hide">Cadastrar</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="5">
          <a href="login/login.php" data-active="5">
            <div class="icon">
              <i class='bx bx-at'></i>
              <i class='bx bxs-at'></i>
            </div>
            <span class="link hide">Entrar</span>
          </a>
        </li>
      </ul>
    </div>

    <div class="sidebar-footer">
      <hr>
      <a href="#" class="account tooltip-element" data-tooltip="0">
        <i class='bx bx-user'></i>
      </a>
      <div class="admin-user tooltip-element" data-tooltip="1">
        <div class="admin-profile hide">
          <div class="admin-info">
            <h3>Usuário</h3>
            <h5>Usuário</h5>
          </div>
        </div>
        <a href="" class="log-out">
          <i class='bx bx-log-out'></i>
        </a>
      </div>
      <div class="tooltip">
        <span class="show">Usuário</span>
        <span>Logout</span>
      </div>
    </div>
  </nav>
  <main class="container-fluid d-flex justify-content-center w-75 p-3 m-auto mt-5">
    <?php
    if (isset($_GET['dir']) && isset($_GET['file'])) {
      include(__DIR__ . "/{$_GET['dir']}/{$_GET['file']}.php");
    } else {
      include(__DIR__ . "/pages/event.php");
    }
    ?>
  </main>
  <script src="js/app.js"></script>
</body>

</html>