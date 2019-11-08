<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "PARTIDOS");
$errors = $view->getVariable("errors");
$partidos = $view->getVariable("partidos");
$userRol = $view->getVariable("userRol");


?>

<?php if(count($partidos) == 0){ ?>
    <div class="alert alert-warning text-center" style="width:100%; height:7%;" id="success-warning" role="alert">

        No hay partidos abiertos
    </div>
<?php } ?>
<div class="row">
<table style="width:100%">
<tr>
  <th>Fecha</th>
  <th>Precio</th>
  <th>Estado</th>
  <th>Límite inscripcion</th>
</tr>
    <?php foreach($partidos as $partido):?>


<tr>
  <td><?= $partido->getFechaPartido()?></td>
  <td><?= $partido->getPrecioPartido()?></td>
  <td><?= $partido->getEstadoPartido()?></td>
  <td><?= $partido->getFechaFinInscripcion()?></td>
  <?php if($userRol == "ADMINISTRADOR"){?>
    <td><a href="<?="index.php?controller=partidos&action=deletePartido&idPartido=".$partido->getIdPartido() ?>">
    <i class="fa fa-trash-alt"></i>
  </a></td><?php } ?>
</tr>
<?php endforeach; ?>
</table> 
   


</div>