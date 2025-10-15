<?php

// event
$records_e = [];
$sql_e = "SELECT * FROM event where idEvent = " . $_GET['event'];
$result_e = $connection->query($sql_e);

if ($result_e->num_rows > 0) {
    while ($row = $result_e->fetch_assoc()) {
        $records_e[] = $row;
    }
} else {
    echo $connection->error;
}

//category
$records_c = [];
$sql_c = "SELECT * FROM event inner join category on category.idCategory = event.idCategory where idEvent = " . $_GET['event'];
$result_c = $connection->query($sql_c);

if ($result_c->num_rows > 0) {
    while ($row = $result_c->fetch_assoc()) {
        $records_c[] = $row;
    }
} else {
    echo $connection->error;
}

//modality
$records_m = [];
$sql_m = "SELECT * FROM event inner join modality on modality.idModality = event.idModality where idEvent = " . $_GET['event'];
$result_m = $connection->query($sql_m);

if ($result_m->num_rows > 0) {
    while ($row = $result_m->fetch_assoc()) {
        $records_m[] = $row;
    }
} else {
    echo $connection->error;
}

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="../css/style.css">

<section class="w-100">
    <!-- Page Features-->
    <div class="d-flex flex-row justify-content-end align-items-center">
        <a class="btn btn-primary rounded-4" href="base.php?dir=pages&file=event"><i class='bx bx-chevron-left'></i></a>
    </div>
    <?php foreach ($records_e as $record) : ?>
        <div class="card w-100 border-0 box shadow-sm rounded-4">
            <div class="card-body m-1 p-1">
                <div>
                    <h2 class="d-flex fs-2 fw-bold justify-content-center"><?= $record['name'] ?></h2>
                    <p class="card-text"><b>Descrição:</b> <?= $record['description'] ?></p>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-2">
                        <p class="card-text"><b>Organizador:</b> <?= $record['organizers'] ?></p>
                        <p class="card-text"><b>Contato:</b> <?= $record['contact'] ?></p>
                        <p class="card-text"><b>Valor:</b> <?= $record['value'] ?></p>
                        <p class="card-text"><b>Vagas:</b> <?= $record['vacancies'] ?></p>
                    <?php endforeach ?>
                    <?php foreach ($records_c as $record) : ?>
                        <p class="card-text"><b>Categoria:</b> <?= $record['name'] ?></p>
                    <?php endforeach ?>
                    <?php foreach ($records_m as $record) : ?>
                        <p class="card-text"><b>Modalidade:</b> <?= $record['name'] ?></p>
                    <?php endforeach ?>
                    <?php foreach ($records_e as $record) : ?>

                        <p class="card-text"><b>Data inicial: </b><?=
                                                                    date('d/m/y', strtotime($record['initial_date'])); //tratar as datas
                                                                    ?></p>
                        <p class="card-text"><b>Data final: </b><?=
                                                                date('d/m/y', strtotime($record['final_date'])); //tratar as datas
                                                                ?></p>
                        <p class="card-text"><b>Horário:</b> <?= $record['hours'] ?></p>
                        <?php if ($record['idModality'] == 1) : ?>
                        <?php else : ?>
                            <p class="card-text"><b>Estado:</b> <?= $record['state'] ?></p>
                            <p class="card-text"><b>Cidade:</b> <?= $record['city'] ?></p>
                            <p class="card-text"><b>Bairro:</b> <?= $record['NBHD'] ?></p>
                            <p class="card-text"><b>Rua:</b> <?= $record['street'] ?></p>
                            <p class="card-text"><b>Número:</b> <?= $record['number'] ?></p>
                    </div>
                    <div class="col-md-6 mt-2">
                        <iframe class="rounded-3 w-100 h-100" width="450" height="250" frameborder="0" style="border:0" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDV4Hb6q8oFxmiTMRiQmAl-a1tjYlWOR2g&q=<?= $record['city'] ?>,<?= $record['state'] ?>,<?= $record['NBHD'] ?>, <?= $record['street'] ?>+<?= $record['number'] ?>" allowfullscreen>
                        </iframe>
                    </div>
                <?php endif ?>
                </div>
            </div>
        <?php endforeach ?>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>