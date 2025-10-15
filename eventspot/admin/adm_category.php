<?php

require_once 'bd/conexao.php';
$connection = newConnection();

//criar
if (count($_POST) > 0) {
    $dados = $_POST;

    $sql = "INSERT INTO category (name) VALUES (?)";

    $connection = newConnection();
    $stmt = $connection->prepare($sql);

    $params = [
        $dados['name'],
    ];

    $stmt->bind_param("s", ...$params);

    if ($stmt->execute()) {
        unset($dados);
    }
}

// deletar
if (isset($_GET['delete'])) { //botão
    $delSQL = "DELETE FROM category WHERE idCategory = ?";
    $stmt = $connection->prepare($delSQL);
    $stmt->bind_param("i", $_GET['delete']);
    $stmt->execute();
}

// selecionar 
$records_c = [];
$sql_c = "SELECT * FROM category ORDER BY name asc";
$result_c = $connection->query($sql_c);

if ($result_c->num_rows > 0) {
    while ($row = $result_c->fetch_assoc()) {
        $records_c[] = $row;
    }
} else {
    echo $connection->error;
}

?>

<!-- html -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="../css/style.css">

<div class="w-100">
    <h4 class="subtitle">Gerenciar categorias</h4>
    <form class="form" method="post" action="#">
        <div class="d-flex justify-content-between">
            <div class="col-md-10 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                <input type="text" class="form-control border-0 bg-transparent shadow-none" id="inputEmail4" name="name" placeholder="nome categoria">
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary rounded-4">Adicionar</button>
            </div>
        </div>
    </form>
    <table class="table text-center mt-4">
        <thead>
            <tr>
                <th scope="col">Categoria</th>
                <th scope="col">Editar</th>
                <th scope="col">Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records_c as $record) : ?>
                <tr>
                    <td><?= $record['name'] ?></th>
                    <td><a href="admin.php?dir=admin&file=adm_up_category&update=<?= $record['idCategory'] ?>" class="btn btn-primary" name="update"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg></a></td>
                    <td><a href="admin.php?dir=admin&file=adm_category&delete=<?= $record['idCategory'] ?>" class="btn btn-primary" name="delete"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                            </svg></a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>