<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Clases pendientes");
$errors = $view->getVariable("errors");
$clases = $view->getVariable("clasesPendientes");
$i=0;

?>

<?php if(count($clases) == 0){ ?>
    <div class="alert alert-warning text-center" style="width:100%;height:7%" id="success-warning" role="alert">

        No tienes ninguna solicitud de clases
    </div>
<?php } ?>

        <div class="table100 ver2 m-b-110">
    <div class="table100-head">
      <table>
        <thead>
          <tr class="row100 head">
            <th class="cell100 column1">Deportista</th>
            <th class="cell100 column2">Clases pendientes</th>
            <th class="cell100 column3">Horario</th>
            <th class="cell100 column4">Clases</th>
            </tr>
        </thead>
      </table>
    </div>
    <?php for($i=0; $i<count($clases); $i = $i+5){?>

        <div class="table100-body js-pscroll">
        <table>
          <tbody>
            <tr class="row100 body">
              <td class="cell100 column1"><?= $clases[$i+1]?></td>
              <td class="cell100 column2"><?= $clases[$i+3]?></td>
              <td class="cell100 column3"><?= $clases[$i+4]?></td>
              <?php for($j = 1; $j <= $clases[$i+3]; $j++){ ?>
                <td class="cell100"><a href="<?="index.php?controller=clases&action=reservarClase&idClase=".$clases[$i] ?>">
              <?=$j?><i class="fas fa-calendar-alt"></i>
              </a></td>

              <?php } ?>
            </tr>
    <?php } ?>
        </tbody>
        </table>

</div>