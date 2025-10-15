<?php

require_once 'bd/conexao.php';
$connection = newConnection();

$records_p = [];

$password = "SELECT password from user where idUser = '" . $_SESSION["idUser"] . "'";
$password = $connection->query($password);
$password = $password->fetch_assoc();

if (isset($_GET['update'])) { //botão
    if (count($_POST) > 0) {

        $dados = $_POST;

        if (!empty($dados['password']) || !empty($dados['newpassword']) || !empty($dados['newpassword2'])) {

            if (hash('sha256', $dados['password']) == $password['password'] && $dados['newpassword'] == $dados['newpassword2']) {

                $updSQL = "UPDATE user SET name = ?, email = ?, password = ?, city = ? WHERE idUser = ?";
                $stmt = $connection->prepare($updSQL);
                $params = [
                    $dados['name'],
                    $dados['email'],
                    hash('sha256', $dados['newpassword']),
                    $dados['city'],
                    $_GET['update']
                ];
                $stmt->bind_param("ssssi", ...$params);
            } else {
                die('Senha atual incorreta ou senha nova incorrespondente' . $connection->connect_error);
            }
        } else {
            $updSQL = "UPDATE user SET name = ?, email = ? , city = ? WHERE idUser = ?";

            $stmt = $connection->prepare($updSQL);
            $params = [
                $dados['name'],
                $dados['email'],
                $dados['city'],
                $_GET['update']
            ];
            $stmt->bind_param("sssi", ...$params);
        }
        $stmt->execute();

?>
        <script>
            window.location.href = "base.php?dir=pages&file=profile";
        </script>
<?php
    }
}

if (isset($_GET['update'])) { //botão

    $sql_p = "SELECT * FROM user where idUser = '" . $_SESSION["idUser"] . "'";
    $result_p = $connection->query($sql_p);

    if ($result_p->num_rows > 0) {
        while ($row = $result_p->fetch_assoc()) {
            $records_p[] = $row;
        }
    } else {
        echo $connection->error;
    }
}
?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="../css/style.css">

<div class="w-100">
    <div class="d-flex flex-row justify-content-between align-items-center">
        <h4 class="subtitle">Atualizar dados</h4>
        <a class="btn btn-primary rounded-4" href="base.php?dir=pages&file=profile"><i class='bx bx-chevron-left'></i></a>
    </div>
    <?php foreach ($records_p as $record) : ?>
        <form class="row g-3 mt-1" method="post" action="#">
            <div class="col-md-12 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                <label for="inputEmail4" class="form-label fw-bold">Nome</label>
                <input type="text" class="form-control border-0 bg-transparent shadow-none" name="name" id="inputEmail4" value="<?= $record['name'] ?>">
            </div>
            <div class="col-md-12 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                <label for="inputEmail4" class="form-label fw-bold">Email</label>
                <input type="text" class="form-control border-0 bg-transparent shadow-none" name="email" id="inputEmail4" value="<?= $record['email'] ?>">
            </div>
            <div class="d-flex p-0 justify-content-between">
                <div class="col-md-3 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                    <label for="inputEmail4" class="form-label fw-bold">Senha atual</label>
                    <input type="password" class="form-control border-0 bg-transparent shadow-none" name="password" id="inputEmail4">
                </div>
                <div class="col-md-4 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                    <label for="inputEmail4" class="form-label fw-bold">Nova senha</label>
                    <input type="password" class="form-control border-0 bg-transparent shadow-none" name="newpassword" id="inputEmail4">
                </div>
                <div class="col-md-4 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                    <label for="inputEmail4" class="form-label fw-bold">Confirmar</label>
                    <input type="password" class="form-control border-0 bg-transparent shadow-none" name="newpassword2" id="inputEmail4">
                </div>
            </div>
            <div class="col-md-12 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                <label for="inputEmail4" class="form-label fw-bold">Cidade</label>
                <input type="text" class="form-control border-0 bg-transparent shadow-none" name="city" id="inputEmail4" placeholder="sem cidade" value="<?= $record['city'] ?>">
            </div>
            <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary rounded-4">Atualizar</button>
            </div>
        </form>
    <?php endforeach ?>
</div>