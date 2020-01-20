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
<div class="reserva">
<canvas id="reservas" ></canvas>
</div>

<span> SOCIOS </span>
<p> Porcentaje de socios sobre el total de usuarios </p>
<p><?=round($socios[0],2)?> %</p>
<p> De un total de <?= $socios[2] ?> registrados <?= $socios[1] ?> son socios. </p>

<canvas id="socios" ></canvas>






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

    <canvas id="bar-chart-horizontal" ></canvas>



    
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

    <canvas id="polar-chart" width="800" height="450"></canvas>



    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>


    
<script>
  

var ctx = document.getElementById('reservas').getContext('2d');


var horas = [];
var porcent = [];
<?php foreach($horas as $hora){ ?>
    var h = "<?php echo $hora ?>";  
    console.log(h);

    horas.push(h);

    
   
    
    <?php $i++; } ?>

    <?php foreach($porcentajes as $porcentaje){ ?>
    var p = "<?php echo $porcentaje ?>";  
    porcent.push(parseInt(p));

  
    <?php $i++; } ?>


var reservas = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: horas,
        datasets: [{
            label: '# de horas',
            data: porcent,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
      responsive: true,
    maintainAspectRatio: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});





var psocios =[];


<?php foreach($socios as $socio){ ?>
    var ps = "<?php echo $socio ?>";  
    if(this.psocios.indexOf(ps) === -1) {
          psocios.push(parseInt(ps));

    }

    <?php $i++; } ?>
   



    new Chart(document.getElementById("socios"), {
    type: 'doughnut',
    data: {
      labels: ["Socios","No socios"],
      datasets: [
        {
          label: "Socios ",
          backgroundColor: ["#3e95cd", "#e8c3b9"],
          data: psocios
        }
      ]
    },
    options: {
      responsive: true,
    maintainAspectRatio: false,
      title: {
        display: true,
        text: 'Numero de socios'
      }
    }
});





var nombres = [];
var partidos = [];

<?php for($j = 0; $j < count($partidos); $j = $j + 2) { ?>

  var nombre = "<?php echo $partidos[$j] ?>";  
    
  nombres.push(nombre);

  var partido = "<?php echo $partidos[$j+1] ?>";
         
  partidos.push(parseInt(partido));

        <?php } ?>

new Chart(document.getElementById("bar-chart-horizontal"), {
    type: 'horizontalBar',
    data: {
      labels: nombres,
      datasets: [
        {
          label: "Partidos Jugados",
          backgroundColor: ["#3e95cd","#E8428A", "#6842E8","#42E8E2","#42E847","#DDE842","#E89A42","#EB1616"],
          data: partidos
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Partidos Jugandos por jugador'
      }
    }
});



<?php for($z = 0; $z < count($campeonatos); $z = $z + 2) { ?>
        
           <?= $campeonatos[$z+1] ?>
        <?= $campeonatos[$z] ?>
       <?= $campeonatos[$z] * 2 ?>
        <?php } ?>

new Chart(document.getElementById("polar-chart"), {
    type: 'polarArea',
    data: {
      labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
      datasets: [
        {
          label: "Population (millions)",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: [2478,5267,734,784,433]
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Predicted world population (millions) in 2050'
      }
    }
});

</script>