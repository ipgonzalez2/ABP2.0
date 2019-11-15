<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "INSCRIPCION PARTIDO");
$errors = $view->getVariable("errors");
$partido = $view->getVariable("partido");

?>

<div class="table100 ver2 m-b-110">
    <div class="table100-head">
      <table>
        <thead>
          <tr class="row100 head">
            <th class="cell100 column1">Fecha</th>
            <th class="cell100 column2">Precio</th>
            <th class="cell100 column3">Estado</th>
            <th class="cell100 column4">Límite inscripcion</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="table100-body js-pscroll">
        <table>
          <tbody>
            <tr class="row100 body">
              <td class="cell100 column1"><?= $partido->getFechaPartido() ?></td>
              <td class="cell100 column2"><?= $partido->getPrecioPartido() ?></td>
              <td class="cell100 column3"><?= $partido->getEstadoPartido() ?></td>
              <td class="cell100 column4"><?= $partido->getFechaFinInscripcion() ?></td>
              <td> <a href="<?="index.php?controller=partidos&action=inscribirPartido&idPartido=".$partido->getIdPartido() ?>">Inscribirse</a></td>

              </tr>
</tbody>
        </table>
      </div>
  </div>

  
