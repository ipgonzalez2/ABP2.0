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
  <td><?= $reserva->getFecha()?></td>
  <td><?= $reserva->getHora()?></td>
  <td><?= $reserva->getPrecio()?></td>
  <td><?= $reserva->getPistaReserva()?></td>
  
</tr>
<?php endforeach; ?>
</table> 
   


</div>