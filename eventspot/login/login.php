<!-- site de baixar imagens: https://br.freepik.com/search?format=search&query=cadastro -->
<?php

session_start();

require_once '../bd/conexao.php';
$connection = newConnection();

function trueLogin($email, $pass)
{
  $connection = newConnection();

  $status = 0;

  $email = addcslashes(addslashes($email), "%_");
  $pass = addcslashes(addslashes($pass), "%_");

  $sql = "SELECT idUser FROM user WHERE email = '" . $email . "' and password = '" . hash('sha256',  $pass) . "'";

  $result = $connection->query($sql);

  if ($result->num_rows > 0) {
    if ($email == 'admin@gmail.com' && hash('sha256',  $pass) == hash('sha256', 'eventspotadmin')) {
      $status = 2;
    } else {
      $status = 1;
    }
  } else {
    $status = 0;
  }

  $id = $result->fetch_assoc();
  $_SESSION["idUser"] = $id['idUser'];

  return $status;
}

if (isset($_POST['singin'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];

  $statusLogin = trueLogin($email, $password);
  if (!$statusLogin) {
    die('Erro: Login' . $connection->connect_error);
  } else if ($statusLogin == 1) {
    if (!empty($_POST['singin']["remember"])) {
      setcookie("email", $_POST['singin']["email"], time() + 3600);
      setcookie("email", $_POST['singin']["email"],);
      setcookie("password", $_POST['singin']["password"], time() + 3600);
    } else {
      setcookie("email", "");
      setcookie("password", "");
    }
    $_SESSION['time'] = time();
    header("Location: ../base.php");
  }
  if (!$statusLogin) {
    die('Erro: Login' . $connection->connect_error);
  } else if ($statusLogin == 2) {
    if (!empty($_POST['singin']["remember"])) {
      setcookie("email", $_POST['singin']["email"], time() + 3600);
      setcookie("email", $_POST['singin']["email"],);
      setcookie("password", $_POST['singin']["password"], time() + 3600);
    } else {
      setcookie("email", "");
      setcookie("password", "");
    }
    $_SESSION['time'] = time();
    header("Location: ../admin.php");
  }
}

if (isset($_POST['singup'])) {

  $sql = "INSERT INTO user (name, email, password, city) VALUES (?, ?, ?, ?)";

  $connection = newConnection();
  $stmt = $connection->prepare($sql);
  $params = [
    $_POST['name'],
    $_POST['email'],
    hash("sha256", $_POST['password']),
    $_POST['city'],
  ];

  $stmt->bind_param("ssss", ...$params);

  if ($stmt->execute()) {
    unset($_POST);
  } else {
    die('Erro: Login' . $connection->connect_error);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="login/img/logo.png" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="#" class="sign-in-form" method="post">
          <h2 class="title">Entrar</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="email" placeholder="Email" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Senha" />
          </div>
          <button name="singin" type="submit" class="btn">
            Enviar
          </button>
        </form>
        <form action="#" class="sign-up-form" method="post">
          <h2 class="title">Cadastrar</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="name" placeholder="Nome" />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="text" name="email" placeholder="Email" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Senha" />
          </div>
          <div class="input-field">
            <i class="fas fa-map-marker"></i>
            <input type="text" name="city" placeholder="Cidade" />
          </div>
          <button name="singup" type="submit" class="btn2">
            Salvar
          </button>
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>Seja bem-vindo novamente</h3>
          <p>
            Faça login para começar a sua jornada e aproveitar ao máximo todas as experiências incríveis que temos a oferecer. Não é cadastrado, cadastra-se agora!
          </p>
          <button class="btn transparent" id="sign-up-btn">
            cadastrar
          </button>
        </div>
        <img src="img/entrar.png" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>Cadastre-se para criar e descobrir eventos incríveis!</h3>
          <p>
            Aqui, você pode facilmente criar e explorar uma variedade de eventos emocionantes. Junte-se a nós e mergulhe em um mundo de oportunidades de eventos inesquecíveis!
            Já possui uma conta, é só entrar!
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Entrar
          </button>
        </div>
        <img src="img/cadastrar.png" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="app.js"></script>
</body>

</html>