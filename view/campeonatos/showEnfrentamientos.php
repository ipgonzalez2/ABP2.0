<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Enfrentamientos");
$errors = $view->getVariable("errors");
$enfrentamientos = $view->getVariable("enfrentamientos");
$nombres = $view->getVariable("deportistas");
$confirmaciones = $view->getVariable("confirmaciones");
$pistas = $view->getVariable("pistas");
$i=0;
$j=0;
?>

<?php if(count($enfrentamientos) == 0){ ?>
    <div class="alert alert-warning text-center" style="width:100%; height:7%;" id="success-warning" role="alert">

        No tienes enfrentamientos
    </div>
<?php } ?>


<div class="table100 ver2 m-b-110">
    <div class="table100-head">
      <table>
        <thead>
          <tr class="row100 head">
            <th class="cell100 column2">Pareja1</th>
            <th class="cell100 column2">Pareja2</th>
            <th class="cell100 column2">Fecha</th>
            <th class="cell100 column4">Hora</th>
            <th class="cell100 column4">Resultado</th>
            <th class="cell100 column3">Pista</th>
            <th class="cell100 column4">Confirmación</th>
            </tr>
        </thead>
      </table>
    </div>
    <?php foreach($enfrentamientos as $enfrentamiento):?>

      <div class="table100-body js-pscroll">
        <table>
          <tbody>
            <tr class="row100 body">
              <td class="cell100 column2">
              <?= $nombres[$i] ?> <br>
              <?= $nombres[$i+1] ?>
              </td>
              <td class="cell100 column2">
              <?= $nombres[$i+2] ?> <br>
              <?= $nombres[$i+3] ?>
              </td>
              <td class="cell100 column2"><?= $enfrentamiento->getFechaEnfrentamiento()?></td>
              <td class="cell100 column4"><?= $enfrentamiento->getHoraEnfrentamiento()?></td>
              <td class="cell100 column4"><?= $enfrentamiento->getResultado1()?> - <?= $enfrentamiento->getResultado2()?></td>
              <?php if($enfrentamiento->getEstadoEnfrentamiento()=="cerrado"){?>
                <td class="cell100 column3">Pista <?= $pistas[$j]?></td>
              <?php } ?>
              <?php if($confirmaciones[$j]){ ?>
                <td class="cell100 column4"><i class="fas fa-check-double fa-2x"></i></td>
              <?php }else{ ?>
              <td class="cell100 column4"><a href="<?="index.php?controller=campeonatos&action=confirmarEnfrentamiento&idEnfrentamiento=".$enfrentamiento->getIdEnfrentamiento() ?>">
                <i class="fas fa-check-circle fa-2x"></i>
                </a></td>
              <?php } ?>

            </tr>
     
          </tbody>
        </table>
      </div>
  <?php $i=$i+4;$j++; endforeach; ?>
</div>



