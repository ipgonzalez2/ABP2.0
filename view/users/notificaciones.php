<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Mis notificaciones");
$errors = $view->getVariable("errors");
$notificaciones = $view->getVariable("notificaciones");

?>

<?php if(count($notificaciones) == 0){ ?>
    <div class="alert alert-warning text-center" style="width:100%;height:7%" id="success-warning" role="alert">

        No tienes ninguna notificacion
    </div>
<?php } ?>
<div class="table100 ver2 m-b-110">
    <div class="table100-head">
      <table>
        <thead>
          <tr class="row100 head">
            <th class="cell100 column1" style="text-align: center;">Notificaciones</th>
             </tr>
        </thead>
      </table>
    </div>
    <?php foreach($notificaciones as $notificacion):?>

        <div class="table100-body js-pscroll">
        <table>
          <tbody>
            <tr class="row100 body">
              <td class="cell100 column1"><?= $notificacion?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>

      </div>

</div>