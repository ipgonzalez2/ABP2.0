<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "RANKING");
$errors = $view->getVariable("errors");
$parejas = $view->getVariable("parejas");
$nombres = $view->getVariable("deportistas");
$i = 0;
?>

<?php if(count($parejas) == 0){ ?>
    <div class="alert alert-warning text-center" style="width:100%; height:7%;" id="success-warning" role="alert">

        No hay ranking todavía
    </div>
<?php } ?>


<div class="table100 ver2 m-b-110">
    <div class="table100-head">
      <table>
        <thead>
          <tr class="row100 head">
            <th class="cell100 column1">Integrante</th>
            <th class="cell100 column2">Integrante</th>
            <th class="cell100 column4">Puntos</th>
            </tr>
        </thead>
      </table>
    </div>
    <?php foreach($parejas as $pareja):?>

      <div class="table100-body js-pscroll">
        <table>
          <tbody>
            <tr class="row100 body">
              <td class="cell100 column1">
              <?= $nombres[$i] ?>
              </td>
              <td class="cell100 column2">
              <?= $nombres[$i+1] ?>
              </td>
              <td class="cell100 column3"><?= $pareja->getPuntos()?></td>

            </tr>
     
          </tbody>
        </table>
      </div>
  <?php $i=$i+2; endforeach; ?>
</div>



