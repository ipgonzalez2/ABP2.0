<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "CAMPEONATOS");
$errors = $view->getVariable("errors");
$campeonatos = $view->getVariable("campeonatos");
$userRol = $view->getVariable("userRol");


?>

<?php if(count($campeonatos) == 0){ ?>
    <div class="alert alert-warning text-center" style="width:100%; height:7%;" id="success-warning" role="alert">

        No hay campeonatos abiertos
    </div>
<?php } ?>
<div class="row">
<table style="width:100%">
<tr>
  <th>Nombre</th>
  <th>Fecha inicio</th>
  <th>Fecha fin</th>
  <th>Precio</th>
  <th>Fecha limite inscripcion</th>
  <th>Estado</th>
</tr>
    <?php foreach($campeonatos as $campeonato):?>


<tr>
  <td><?= $campeonato->getNombreCampeonato()?></td>
  <td><?= $campeonato->getFechaInicio()?></td>
  <td><?= $campeonato->getFechaFin()?></td>
  <td><?= $campeonato->getPrecioCampeonato()?></td>
  <td><?= $campeonato->getFechaLimiteInscripcion()?></td>
  <td><?= $campeonato->getEstadoCampeonato()?></td>
  <?php if($userRol == "ADMINISTRADOR" && $campeonato->getEstadoCampeonato() == "ABIERTO"){?>
    <td><a href="<?="index.php?controller=campeonatos&action=deleteCampeonato&idCampeonato=".$campeonato->getIdCampeonato() ?>">
    <i class="fa fa-trash-alt"></i>
  </a></td><?php }else if($userRol == "DEPORTISTA"){ ?>
    <td><a href="<?="index.php?controller=campeonatos&action=showCampeonatoInscribir&idCampeonato=".$campeonato->getIdCampeonato() ?>">
    <i class="fa fa-user-plus"></i>
  <?php } ?>
</tr>
<?php endforeach; ?>
</table> 
   


</div>