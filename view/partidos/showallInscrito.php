<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Mis partidos");
$errors = $view->getVariable("errors");
$partidos = $view->getVariable("partidos");
$pistas = $view->getVariable("pistas");
$pos=0;
?>

<?php if(count($partidos) == 0){ ?>
    <div class="alert alert-warning text-center" style="width:100%; height:7%;" id="success-warning" role="alert">

        No tienes ningun partido
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
            <th class="cell100 column4">Hora</th>
            <th class="cell100 column4">Pista</th>
            </tr>
        </thead>
      </table>
    </div>
    <?php foreach($partidos as $partido):?>

      <div class="table100-body js-pscroll">
        <table>
          <tbody>
            <tr class="row100 body">
              <td class="cell100 column1"><?= $partido->getFechaPartido()?></td>
              <td class="cell100 column2"><?= $partido->getPrecioPartido()?></td>
              <td class="cell100 column3"><?= $partido->getEstadoPartido()?></td>
              <td class="cell100 column4"><?= $partido->getHoraPartido()?></td>
              <?php if($pistas[$pos]!=NULL){ ?>
              <td class="cell100 column4"><?= $pistas[$pos]?></td>
              <?php }else {?>
              <td class="cell100 column4"><i class="fas fa-spinner"></i></td>
              <?php }?>
            </tr>
     
          </tbody>
        </table>
      </div>
  <?php $pos++; endforeach; ?>
</div>

