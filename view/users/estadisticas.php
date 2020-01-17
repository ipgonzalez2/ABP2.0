<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Estadísticas");
$errors = $view->getVariable("errors");
$horas = $view->getVariable("horas");
$porcentajes = $view->getVariable("porcentajes");
$socios = $view->getVariable("numSocios");
$partidos = $view->getVariable("partidos");
$campeonatos = $view->getVariable("campeonatos");
$i = 0;
$j = 0;
$z = 0;
?>


<span> RESERVAS </span>
<p> Porcentaje que supone cada hora sobre el total de reservas </p>
<?php foreach($horas as $hora){ ?>
<p> <?= $hora ?>  <?= $porcentajes[$i] ?> % </p>
<?php $i++; } ?>
<span> SOCIOS </span>
<p> Porcentaje de socios sobre el total de usuarios </p>
<p><?=round($socios[0],2)?> %</p>
<p> De un total de <?= $socios[2] ?> registrados <?= $socios[1] ?> son socios. </p>
<span> PARTIDOS </span>
<p> Número de partidos por deportista </p>
<div class="table100 ver2 m-b-110">
    <div class="table100-head">
      <table>
        <thead>
        <?php for($j = 0; $j < count($partidos); $j = $j + 2) { ?>
          <tr class="row100 head">
            <th class="cell100 column1"><?= $partidos[$j] ?></th>
            <th class="cell100 column2"><?= $partidos[$j+1] ?></th>
          </tr>
        <?php } ?>
        </thead>
      </table>
    </div>
    </div>

    <span> CAMPEONATOS </span>
<p> Número de inscritos por campeonato </p>
<div class="table100 ver2 m-b-110">
    <div class="table100-head">
      <table>
        <thead>
          <tr class="row100 head">
            <th class="cell100 column1">Campeonato</th>
            <th class="cell100 column1">Num. parejas</th>
            <th class="cell100 column2">Num. deportistas</th>
          </tr>
        </thead>
      </table>
    </div>
<div class="table100 ver2 m-b-110">
    <div class="table100-head">
      <table>
        <thead>
        <?php for($z = 0; $z < count($campeonatos); $z = $z + 2) { ?>
          <tr class="row100 head">
            <th class="cell100 column1"><?= $campeonatos[$z+1] ?></th>
            <th class="cell100 column2"><?= $campeonatos[$z] ?></th>
            <th class="cell100 column3"><?= $campeonatos[$z] * 2 ?></th>
          </tr>
        <?php } ?>
        </thead>
      </table>
    </div>
    </div>




