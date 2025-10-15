<?php

require_once 'bd/conexao.php';
$connection = newConnection();

if (isset($_GET['update'])) {
    if (count($_POST) > 0) {
        $dados = $_POST;

        $sql = "UPDATE event SET name = ? , description = ?, organizers = ? , initial_date = ?, final_date = ?, hours = ?, state = ?, 
        city = ?, street = ?, NBHD = ?, number = ?, value = ?, contact = ?, vacancies = ?, idCategory = ?, idModality = ? WHERE idEvent = ?";

        $connection = newConnection();
        $stmt = $connection->prepare($sql);

        if (empty($dados['vacancies'])) {
            $dados['vacancies'] = "ilimitado";
        }
        if (empty($dados['value'])) {
            $dados['value'] = "gratuito";
        }

        $params = [
            $dados['name'],
            $dados['description'],
            $dados['organizers'],
            $dados['initial_date'],
            $dados['final_date'],
            $dados['hours'],
            $dados['state'],
            $dados['city'],
            $dados['street'],
            $dados['NBHD'],
            $dados['number'],
            $dados['value'],
            $dados['contact'],
            $dados['vacancies'],
            $dados['category'],
            $dados['modality'],
            $_GET['update']
        ];
        echo ($sql);

        $stmt->bind_param("ssssssssssisssiii", ...$params);
        $stmt->execute();

?>
        <script>
            window.location.href = "base.php?dir=pages&file=my_events";
        </script>
<?php
    }
}

$name_c = "SELECT * FROM event inner join category on category.idCategory = event.idCategory where idEvent = " . $_GET['update'];
$name_c = $connection->query($name_c);
$name_c = $name_c->fetch_assoc();

$name_m = $sql_m = "SELECT * FROM event inner join modality on modality.idModality = event.idModality where idEvent = " . $_GET['update'];
$name_m = $connection->query($name_m);
$name_m = $name_m->fetch_assoc();

if (isset($_GET['update'])) { //botão
    $records_e = [];
    $sql_e = "SELECT * FROM event where idEvent = " . $_GET['update'];
    $result_e = $connection->query($sql_e);

    if ($result_e->num_rows > 0) {
        while ($row = $result_e->fetch_assoc()) {
            $records_e[] = $row;
        }
    } else {
        echo $connection->error;
    }
}

$records_m = [];
$sql_m = "SELECT * FROM modality";
$result_m = $connection->query($sql_m);

if ($result_m->num_rows > 0) {
    while ($row = $result_m->fetch_assoc()) {
        $records_m[] = $row;
    }
} else {
    echo $connection->error;
}

$records_c = [];
$sql_c = "SELECT * FROM category";
$result_c = $connection->query($sql_c);

if ($result_c->num_rows > 0) {
    while ($row = $result_c->fetch_assoc()) {
        $records_c[] = $row;
    }
} else {
    echo $connection->error;
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="../css/style.css">

<div class="w-100">
    <div class="d-flex flex-row justify-content-between align-items-center">
        <h4 class="subtitle">Editar evento</h4>
    </div>
    <form class="row g-3 mt-1" method="post" action="#">
        <?php foreach ($records_e as $record) : ?>
            <div class="col-md-12 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                <label for="inputEmail4" class="form-label fw-bold">Nome</label>
                <input type="text" class="form-control border-0 bg-transparent shadow-none" name="name" id="inputEmail4" value="<?= $record['name'] ?>">
            </div>
            <div class="col-md-12 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                <label for="inputEmail4" class="form-label fw-bold">Descrição</label>
                <textarea type="text" class="form-control border-0 bg-transparent shadow-none" rows="4" name="description"><?= $record['description'] ?></textarea>
            </div>
            <div class="d-flex p-0 justify-content-between">
                <div class="col-md-4 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                    <label for="inputEmail4" class="form-label fw-bold">Data inicial</label>
                    <input type="date" class="form-control border-0 bg-transparent shadow-none" name="initial_date" id="inputEmail4" value="<?= $record['initial_date'] ?>">
                </div>
                <div class="col-md-4 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                    <label for="inputEmail4" class="form-label fw-bold">Data final</label>
                    <input type="date" class="form-control border-0 bg-transparent shadow-none" name="final_date" id="inputEmail4" value="<?= $record['final_date'] ?>">
                </div>
                <div class="col-md-3 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                    <label for="inputEmail4" class="form-label fw-bold">Horario</label>
                    <input type="time" class="form-control border-0 bg-transparent shadow-none" name="hours" id="inputEmail4" value="<?= $record['hours'] ?>">
                </div>
            </div>
            <div class="col-md-12 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                <label for="inputEmail4" class="form-label fw-bold">Organizador</label>
                <input type="text" class="form-control border-0 bg-transparent shadow-none" name="organizers" id="inputEmail4" value="<?= $record['organizers'] ?>">
            </div>
            <div class="col-md-12 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                <label for="inputEmail4" class="form-label fw-bold">Contato</label>
                <input type="text" class="form-control border-0 bg-transparent shadow-none" name="contact" id="inputEmail4" value="<?= $record['contact'] ?>">
            </div>
            <div class="d-flex p-0 justify-content-between">
                <div class="col-md-6 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                    <label for="inputEmail4" class="form-label fw-bold">Categoria</label>
                    <select class="form-select rounded-4 p-2 shadow-none border-0" style="background-color: #f0f0f0 !important;" name="category">
                        <option selected value="<?= $name_c['idCategory'] ?>"><?= $name_c['name'] ?></option>
                        <?php foreach ($records_c as $record) : ?>
                            <option value="<?= $record['idCategory'] ?>"><?= $record['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-5 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                    <label for="inputEmail4" class="form-label fw-bold">Modalidade</label>
                    <select class="form-select rounded-4 p-2 shadow-none border-0" style="background-color: #f0f0f0 !important;" name="modality">
                        <option selected value="<?= $name_m['idModality'] ?>"><?= $name_m['name'] ?></option>
                        <?php foreach ($records_m as $record) : ?>
                            <option value="<?= $record['idModality'] ?>"><?= $record['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        <?php endforeach ?>
        <?php foreach ($records_e as $record) : ?>
            <div class="d-flex p-0 justify-content-between">
                <div class="col-md-6 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                    <label for="inputEmail4" class="form-label fw-bold">Estado</label>
                    <select class="form-select rounded-4 p-2 shadow-none border-0" style="background-color: #f0f0f0 !important;" name="state">
                        <option selected><?= $record['state'] ?></option>
                        <option value="Acre">Acre</option>
                        <option value="Alagoas">Alagoas</option>
                        <option value="Amapá">Amapá</option>
                        <option value="Amazonas">Amazonas</option>
                        <option value="Bahia">Bahia</option>
                        <option value="Ceará">Ceará</option>
                        <option value="Distrito Federal">Distrito Federal</option>
                        <option value="Espírito Santo">Espírito Santo</option>
                        <option value="Goiás">Goiás</option>
                        <option value="Maranhão">Maranhão</option>
                        <option value="Mato Grosso">Mato Grosso</option>
                        <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                        <option value="Minas Gerais">Minas Gerais</option>
                        <option value="Pará">Pará</option>
                        <option value="Paraíba">Paraíba</option>
                        <option value="Paraná">Paraná</option>
                        <option value="Pernambuco">Pernambuco</option>
                        <option value="Piauí">Piauí</option>
                        <option value="Rio de Janeiro">Rio de Janeiro</option>
                        <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                        <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                        <option value="Rondônia">Rondônia</option>
                        <option value="Roraima">Roraima</option>
                        <option value="Santa Catarina">Santa Catarina</option>
                        <option value="São Paulo">São Paulo</option>
                        <option value="Sergipe">Sergipe</option>
                        <option value="Tocantins">Tocantins</option>
                    </select>
                </div>
                <div class="col-md-5 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                    <label for="inputEmail4" class="form-label fw-bold">Cidade</label>
                    <input type="text" class="form-control border-0 bg-transparent shadow-none" name="city" id="inputEmail4" value="<?= $record['city'] ?>">
                </div>
            </div>
            <div class="d-flex p-0 justify-content-between">
                <div class="col-md-4 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                    <label for="inputEmail4" class="form-label fw-bold">Bairro</label>
                    <input type="text" class="form-control border-0 bg-transparent shadow-none" name="NBHD" id="inputEmail4" value="<?= $record['NBHD'] ?>">
                </div>
                <div class="col-md-5 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                    <label for="inputEmail4" class="form-label fw-bold">Rua</label>
                    <input type="text" class="form-control border-0 bg-transparent shadow-none" name="street" id="inputEmail4" value="<?= $record['street'] ?>">
                </div>
                <div class="col-md-2 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                    <label for="inputEmail4" class="form-label fw-bold">Numero</label>
                    <input type="number" class="form-control border-0 bg-transparent shadow-none" name="number" id="inputEmail4" value="<?= $record['number'] ?>">
                </div>
            </div>
            <div class="form-check form-switch col-md-7">
                <input class="form-check-input" onclick="disabled_vacacies('sim')" type="checkbox" role="switch" id="validate_vacancies" checked>
                <label class="form-check-label" for="flexSwitchCheckChecked">Possui limite de vagas?</label>
            </div>
            <div class="form-check form-switch col-md-5">
                <input class="form-check-input" onclick="disabled_value('sim')" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                <label class="form-check-label" for="flexSwitchCheckChecked">Possui valor para participar?</label>
            </div>
            <div class="d-flex p-0 justify-content-between">
                <div class="col-md-5 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                    <label for="inputEmail4" class="form-label fw-bold">Vagas</label>
                    <input type="text" class="form-control border-0 bg-transparent shadow-none" name="vacancies" id="vacancies" value="<?= $record['vacancies'] ?>">
                </div>
                <div class="col-md-5 rounded-4 p-2" style="background-color: #f0f0f0 !important;">
                    <label for="inputEmail4" class="form-label fw-bold">Valor</label>
                    <input type="text" class="form-control border-0 bg-transparent shadow-none" name="value" id="value" value="<?= $record['value'] ?>">
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary rounded-4">Atualizar</button>
            </div>
        <?php endforeach ?>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function disabled_vacacies(valor) {
            var status = document.getElementById('vacancies').disabled;

            if (valor == 'sim' && !status) {
                document.getElementById('vacancies').disabled = true;
            } else {
                document.getElementById('vacancies').disabled = false;
            }
        }

        function disabled_value(valor) {
            var status = document.getElementById('value').disabled;

            if (valor == 'sim' && !status) {
                document.getElementById('value').disabled = true;
            } else {
                document.getElementById('value').disabled = false;
            }
        }
    </script>