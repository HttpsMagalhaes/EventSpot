<?php

require_once 'bd/conexao.php';
$connection = newConnection();

$records_p = [];

$sql_p = "SELECT * FROM user where idUser = '" . $_SESSION["idUser"] . "'";
$result_p = $connection->query($sql_p);

if ($result_p->num_rows > 0) {
    while ($row = $result_p->fetch_assoc()) {
        $records_p[] = $row;
    }
} else {
    echo $connection->error;
}
?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="../css/style.css">

<div class="w-100">
    <div class="d-flex flex-row justify-content-between align-items-center">
        <h4 class="subtitle">Perfil</h4>
    </div>
    <?php foreach ($records_p as $record) : ?>
        <form class="row g-3 mt-1">
            <div class="col-md-12 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                <label for="inputEmail4" class="form-label fw-bold">Nome</label>
                <input type="text" class="form-control border-0 bg-transparent" id="inputEmail4" disabled value="<?= $record['name'] ?>">
            </div>
            <div class="col-md-12 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                <label for="inputEmail4" class="form-label fw-bold">Email</label>
                <input type="text" class="form-control border-0 bg-transparent" id="inputEmail4" disabled value="<?= $record['email'] ?>">
            </div>
            <div class="col-md-12 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                <label for="inputEmail4" class="form-label fw-bold">Cidade</label>
                <input type="text" class="form-control border-0 bg-transparent" id="inputEmail4" placeholder="sem cidade" disabled value="<?= $record['city'] ?>">
            </div>
            <div class="col-12 d-flex justify-content-center">
                <a class="btn btn-primary rounded-4" href="base.php?dir=pages&file=up_profile&update=<?= $_SESSION["idUser"] ?>">Atualizar dados</a>
            </div>
        </form>
    <?php endforeach ?>
</div>