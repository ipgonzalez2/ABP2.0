<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Clases reservadas");
$errors = $view->getVariable("errors");
$clases = $view->getVariable("clases");
$i=0;

?>

<?php if(count($clases) == 0){ ?>
    <div class="alert alert-warning text-center" style="width:100%;height:7%" id="success-warning" role="alert">

        No tienes ninguna clase reservada
    </div>
<?php } ?>

        <div class="table100 ver2 m-b-110">
    <div class="table100-head">
      <table>
        <thead>
          <tr class="row100 head">
            <th class="cell100 column1">Deportista</th>
            <th class="cell100 column2">Fecha</th>
            <th class="cell100 column3">Hora</th>
            <th class="cell100 column4">Pista</th>
            <th class="cell100 column4">Eliminar</th>
            </tr>
        </thead>
      </table>
    </div>
    <?php for($i=0; $i<count($clases); $i = $i+6){?>

        <div class="table100-body js-pscroll">
        <table>
          <tbody>
            <tr class="row100 body">
              <td class="cell100 column1"><?= $clases[$i]?></td>
              <td class="cell100 column2"><?= $clases[$i+1]?></td>
              <td class="cell100 column3"><?= $clases[$i+2]?></td>
              <td class="cell100 column4"><?= $clases[$i+3]?></td>

              <td class="cell100 column4"><a href="<?="index.php?controller=clases&action=cancelarClase&idClase=".$clases[$i+4]."&idReserva=".$clases[$i+5] ?>">
              <i class="fas fa-times-circle"></i>
              </a></td>
            </tr>
    <?php } ?>
        </tbody>
        </table>

</div>