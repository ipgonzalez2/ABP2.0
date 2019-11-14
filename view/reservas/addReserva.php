<?php
//file: view/users/register.php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Reservar");
$fechas = $view->getVariable("fechas");
$horas = $view->getVariable("horas");
$fechaSel = $view->getVariable("fecha");

$errors = $view->getVariable("errors");
?>


<div class="table100 ver2 m-b-110">
    <form action="./index.php?controller=reservas&action=addReserva" method="POST">
    <select type="submit" name="fecha">
    <?php foreach ($fechas as $fecha) : ?>
    <option onclick="this.form.submit()" value=<?=$fecha?>><?= date("d-m-y",strtotime($fecha)) ?></option>
    <?php endforeach; ?>
    </select>
    <?php if(isset($horas)){?>
      <p> <?=$fechaSel?> </p>
    <select name="hora">
    <?php foreach ($horas as $hora) : ?>
    <option value=<?=$hora?>><?= $hora ?></option>
    <?php endforeach; ?>
    </select>
    <button type="submit"> Reservar </button>
    <?php } ?>

</div>



