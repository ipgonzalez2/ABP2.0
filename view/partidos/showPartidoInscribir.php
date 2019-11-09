<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "INSCRIPCION PARTIDO");
$errors = $view->getVariable("errors");
$partido = $view->getVariable("partido");

?>

<div class="row">
<table style="width:100%">
<tr>
  <th>Fecha</th>
  <th>Precio</th>
  <th>Estado</th>
  <th>Límite inscripcion</th>
</tr>
<tr>
  <td><?= $partido->getFechaPartido()?></td>
  <td><?= $partido->getPrecioPartido()?></td>
  <td><?= $partido->getEstadoPartido()?></td>
  <td><?= $partido->getFechaFinInscripcion()?></td>

</tr>
<button><a href="<?="index.php?controller=partidos&action=inscribirPartido&idPartido=".$partido->getIdPartido() ?>">Inscribirse</a></button>
</table> 
   


</div>