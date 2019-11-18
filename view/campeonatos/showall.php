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
             <th class="cell100 column2">Nombre</th>
             <th class="cell100 column2">Fecha inicio</th>
             <th class="cell100 column2">Fecha fin</th>
             <th class="cell100 column2">Precio</th>
             <th class="cell100 column4">Límite inscripción</th>
             <th class="cell100 column2">Estado</th>
             <?php if($userRol == "administrador"){ ?>
             <th class="cell100 column2">Borrar</th>
             <th class="cell100 column2">Cerrar</th>
             <?php }else if($userRol == "deportista"){ ?>
             <th class="cell100 column4">Inscribirse</th>
             <?php } ?>
           </tr>
         </thead>
        </table>
      </div>
    <?php foreach($campeonatos as $campeonato):?>


      <div class="table100-body js-pscroll">
      <table>
          <tbody>
            <tr class="row100 body">
  <td class="cell100 column2"><?= $campeonato->getNombreCampeonato()?></td>
  <td class="cell100 column2"><?= $campeonato->getFechaInicio()?></td>
  <td class="cell100 column2"><?= $campeonato->getFechaFin()?></td>
  <td class="cell100 column2"><?= $campeonato->getPrecioCampeonato()?></td>
  <td class="cell100 column4"><?= $campeonato->getFechaLimiteInscripcion()?></td>
  <td class="cell100 column2"><?= $campeonato->getEstadoCampeonato()?></td>
  <?php if($userRol == "administrador" && $campeonato->getEstadoCampeonato()=="abierto"){?>
    <td class="cell100 column2"><a href="<?="index.php?controller=campeonatos&action=deleteCampeonato&idCampeonato=".$campeonato->getIdCampeonato() ?>">
    <i class="fa fa-trash-alt"></i>
  </a></td> <?php } if($userRol == "administrador" && $campeonato->getEstadoCampeonato()=="abierto"){ ?>
    <td class="cell100 column2"><a href="<?="index.php?controller=campeonatos&action=cerrarCampeonato&idCampeonato=".$campeonato->getIdCampeonato() ?>">
    <i class="far fa-times-circle"></i>
    </a></td>
    <?php } if($userRol == "administrador" && $campeonato->getEstadoCampeonato() == "cerrado"){ ?>
      <td class="cell100 column2"><a href="<?="index.php?controller=campeonatos&action=showallGrupos&idCampeonato=".$campeonato->getIdCampeonato() ?>">
    <i class="fas fa-eye"></i>
    <td class="cell100 column2"> <i class="far fa-stop-circle"></i></td>
    </a></td>
  <?php }else if($userRol == "deportista"){ ?>
    <td class="cell100 column2"><a href="<?="index.php?controller=campeonatos&action=inscribirCampeonato&idCampeonato=".$campeonato->getIdCampeonato() ?>">
    <i class="fas fa-user-plus"></i>
  <?php }else{ ?>
    <td class="cell100 column2"> 
  <?php }?>
</tr>
<?php endforeach; ?>
</table> 
   


</div>