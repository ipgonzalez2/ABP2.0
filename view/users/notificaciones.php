<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Mis notificaciones");
$errors = $view->getVariable("errors");
$notificaciones = $view->getVariable("notificaciones");

?>

<?php if(count($notificaciones) == 0){ ?>
    <div class="alert alert-warning text-center" style="width:100%; height:7%;" id="success-warning" role="alert">

        No tienes ninguna notificacion
    </div>
<?php } ?>
<div class="row">
<table style="width:100%">
    <?php foreach($notificaciones as $notificacion):?>

<tr>
  <?= $notificacion?>
</tr>
<?php endforeach; ?>
</table> 
   


</div>