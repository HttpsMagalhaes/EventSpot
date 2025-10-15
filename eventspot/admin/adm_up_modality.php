<?php
require_once 'bd/conexao.php';
$connection = newConnection();

//criar
if (isset($_POST)) {
    if (count($_POST) > 0) {
        $dados = $_POST;

        $sql = "UPDATE modality SET name = ? WHERE idModality = ?";

        $connection = newConnection();
        $stmt = $connection->prepare($sql);

        $params = [
            $dados['name'],
            $_GET['update']
        ];

        $stmt->bind_param("si", ...$params);
        $stmt->execute();

?>
        <script>
            window.location.href = "admin.php?dir=admin&file=adm_modality";
        </script>
<?php
    }
}


if (isset($_GET['update'])) { //botão
    $sql = "SELECT * FROM modality WHERE idModality = " . $_GET['update'];
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
    } else {
        echo $connection->error;
    }
}

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="../css/style.css">
<div class="container p-4 m-4">
    <h4 class="subtitle">Editar modalidade</h4>
    <form class="form" method="post" action="#">
        <?php foreach ($records as $record) : ?>
            <div class="d-flex justify-content-between">
                <div class="col-md-10 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                    <input type="text" class="form-control border-0 bg-transparent shadow-none" id="inputEmail4" name="name" value="<?= $record['name'] ?>">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary rounded-4">Atualizar</button>
                </div>
            </div>
        <?php endforeach ?>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>