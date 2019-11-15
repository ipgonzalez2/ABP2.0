<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "PARTIDOS INSCRITO");
$errors = $view->getVariable("errors");
$reservasActivas = $view->getVariable("reservasActivas");
$userRol = $view->getVariable("userRol");

?>

<?php if(count($reservasActivas) == 0){ ?>
    <div class="alert alert-warning text-center" style="width:100%; height:7%;" id="success-warning" role="alert">

        No tienes ninguna reserva activa
    </div>
<?php } ?>
<div class="row">
<table style="width:100%">
<tr>
  <th>Fecha</th>
  <th>Hora</th>
  <th>Precio</th>
  <th>Pista</th>
</tr>
    <?php foreach($reservasActivas as $reserva):?>


<tr>
  <td><?= date("d-m-Y",strtotime($reserva->getFecha()))?></td>
  <td><?= date("H:i",strtotime($reserva->getHora()))?></td>
  <td><?= $reserva->getPrecio()?> </td>
  <td><?= $reserva->getPistaReserva()?></td>
  <?php 
  $fecha_actual = new DateTime(date("Y-m-d"));
  $fecha = new DateTime($reserva->getFecha());
  $interval = ($fecha_actual->diff($fecha))->format("%a");
  if($interval == 1){
    $hora_actual = (new DateTime(date("H:i:s",time())))->format("H");
    $minutos_actual = (new DateTime(date("H:i:s",time())))->format("i");
    $hora = (new DateTime($reserva->getHora()))->format("H");
    $minutos = (new DateTime($reserva->getHora()))->format("i");
    if($hora>$hora_actual || ($hora==$hora_actual && $minutos>$minutos_actual)){?>
    <td><a href="<?= "index.php?controller=reservas&action=deleteReserva&idReserva=" . $reserva->getIdReserva() ?>">
                    <i class="fa fa-trash-alt"></i>
                  </a></td>
    <?php } }else if($interval>1){ ?>
    <td><a href="<?= "index.php?controller=reservas&action=deleteReserva&idReserva=" . $reserva->getIdReserva()  ?>">
        <i class="fa fa-trash-alt"></i>
        </a></td>
    <?php } ?>


</tr>
<?php endforeach; ?>
</table> 
   


</div>