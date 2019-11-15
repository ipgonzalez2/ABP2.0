<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "CAMPEONATOS");
$errors = $view->getVariable("errors");
$campeonatos = $view->getVariable("campeonatos");
$userRol = $view->getVariable("userRol");


?>

<?php if(count($campeonatos) == 0){ ?>
    <div class="alert alert-warning text-center" style="width:100%; height:7%;" id="success-warning" role="alert">

        No hay campeonatos abiertos
    </div>
<?php } ?>

<div class="table100 ver2 m-b-110">
<div class="table100-head">
      <table>
        <thead>
          <tr class="row100 head">
             <th class="cell100 column1">Nombre</th>
             <th class="cell100 column2">Fecha inicio</th>
             <th class="cell100 column3">Fecha fin</th>
             <th class="cell100 column4">Precio</th>
             <th class="cell100 column4">Fecha limite inscripcion</th>
             <th class="cell100 column4">Estado</th>
           </tr>
         </thead>
        </table>
      </div>
    <?php foreach($campeonatos as $campeonato):?>


      <div class="table100-body js-pscroll">
      <table>
          <tbody>
            <tr class="row100 body">
  <td class="cell100 column1">><?= $campeonato->getNombreCampeonato()?></td>
  <td class="cell100 column2">><?= $campeonato->getFechaInicio()?></td>
  <td class="cell100 column3">><?= $campeonato->getFechaFin()?></td>
  <td class="cell100 column4">><?= $campeonato->getPrecioCampeonato()?></td>
  <td class="cell100 column5">><?= $campeonato->getFechaLimiteInscripcion()?></td>
  <td class="cell100 column6">><?= $campeonato->getEstadoCampeonato()?></td>
  <?php if($userRol == "administrador" && $campeonato->getEstadoCampeonato() == "abierto"){?>
    <td><a href="<?="index.php?controller=campeonatos&action=deleteCampeonato&idCampeonato=".$campeonato->getIdCampeonato() ?>">
    <i class="fa fa-trash-alt"></i>
  </a></td><?php }else if($userRol == "deportista"){ ?>
    <td><a href="<?="index.php?controller=campeonatos&action=showCampeonatoInscribir&idCampeonato=".$campeonato->getIdCampeonato() ?>">
    <i class="fa fa-user-plus"></i>
  <?php } ?>
</tr>
<?php endforeach; ?>
</table> 
   


</div>