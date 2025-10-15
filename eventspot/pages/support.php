<?php

require_once 'bd/conexao.php';
$connection = newConnection();

if (count($_POST) > 0) {
    $dados = $_POST;

    $sql = "INSERT INTO contact (email, topic, message) VALUES (?, ?, ?)";

    $connection = newConnection();
    $stmt = $connection->prepare($sql);

    $params = [
        $dados['email'],
        $dados['topic'],
        $dados['message']
    ];

    $stmt->bind_param("sss", ...$params);

    if ($stmt->execute()) {
        unset($dados);
    }
}
?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="../css/style.css">

<div class="w-100">
    <div class="d-flex flex-row justify-content-between align-items-center">
        <h4 class="subtitle">Contato</h4>
    </div>
    <form class="row g-3 mt-1" method="post" action="#">
        <div class="col-md-12 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
            <label for="inputEmail4" class="form-label fw-bold">Email</label>
            <input type="text" class="form-control border-0 bg-transparent shadow-none" id="inputEmail4" name="email">
        </div>
        <div class="col-md-12 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
            <label for="inputEmail4" class="form-label fw-bold">Assunto</label>
            <input type="text" class="form-control border-0 bg-transparent shadow-none" id="inputEmail4" name="topic">
        </div>
        <div class="col-md-12 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
            <label for="inputEmail4" class="form-label fw-bold">Descrição</label>
            <textarea type="text" class="form-control border-0 bg-transparent shadow-none" name="message" ></textarea>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary rounded-4">Enviar</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>