<?php
//file: view/users/login.php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "PARTIDOS");
$errors = $view->getVariable("errors");
$partidos = $view->getVariable("partidos");
$userRol = $view->getVariable("userRol");


?>


<div>



  <?php if (count($partidos) == 0) { ?>
    <div class="alert alert-warning text-center" style="width:100%; height:7%;" id="success-warning" role="alert">

      No hay partidos abiertos
    </div>
  <?php } ?>


  <div class="table100 ver2 m-b-110">
    <div class="table100-head">
      <table>
        <thead>
          <tr class="row100 head">
            <th class="cell100 column1">Fecha</th>
            <th class="cell100 column2">Precio</th>
            <th class="cell100 column3">Estado</th>
            <th class="cell100 column4">Límite inscripcion</th>
            <th class="cell100 column4">Borrar</th>
          </tr>
        </thead>
      </table>
    </div>
    <?php foreach ($partidos as $partido) : ?>

      <div class="table100-body js-pscroll">
        <table>
          <tbody>
            <tr class="row100 body">
              <td class="cell100 column1"><?= $partido->getFechaPartido() ?></td>
              <td class="cell100 column2"><?= $partido->getPrecioPartido() ?></td>
              <td class="cell100 column3"><?= $partido->getEstadoPartido() ?></td>
              <td class="cell100 column4"><?= $partido->getFechaFinInscripcion() ?></td>
              <?php if ($userRol == "administrador" && $partido->getEstadoPartido() == "abierto") { ?>
                <td><a href="<?= "index.php?controller=partidos&action=deletePartido&idPartido=" . $partido->getIdPartido() ?>">
                    <i class="fa fa-trash-alt"></i>
                  </a></td><?php } else if ($userRol == "deportista") { ?>
                <td><a href="<?= "index.php?controller=partidos&action=showPartidoInscribir&idPartido=" . $partido->getIdPartido() ?>">
                    <i class="fa fa-user-plus"></i></a>
                  <?php }else{ ?>
                    <td> <i class="far fa-times-circle"></i></td>
                  <?php }?>
            </tr>
          <?php endforeach; ?>

        </tbody>
        </table>
      </div>
  </div>

  
</div>