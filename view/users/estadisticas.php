<?php
//file: view/users/login.php

require_once __DIR__ . "/../../core/ViewManager.php";
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

<div>
<span> RESERVAS </span>


<canvas id="reservas" ></canvas>


<span> SOCIOS </span>


<canvas id="socios" ></canvas>

<div id="partidos">
<span> PARTIDOS </span>


    <canvas id="bar-chart-horizontal" ></canvas>

</div>

    <span> CAMPEONATOS </span>

<canvas id="campeonato" ></canvas>






<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>


<script>


var ctx = document.getElementById('reservas').getContext('2d');


var horas = [];
var porcent = [];
<?php foreach ($horas as $hora) {?>
    var h = "<?php echo $hora ?>";
    console.log(h);

    horas.push(h);




    <?php $i++;}?>

    <?php foreach ($porcentajes as $porcentaje) {?>
    var p = "<?php echo $porcentaje ?>";
    porcent.push(parseInt(p));


    <?php $i++;}?>


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
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 100, 64, 0.2)'
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
    maintainAspectRatio: true,
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


<?php foreach ($socios as $socio) {?>
    var ps = "<?php echo $socio ?>";
    if(this.psocios.indexOf(ps) === -1) {
          psocios.push(parseInt(ps));

    }

    <?php $i++;}?>




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
    maintainAspectRatio: true,
      title: {
        display: true,
        text: 'Numero de socios'
      }
    }
});





var nombres = [];
var partidos = [];

<?php for ($j = 0; $j < count($partidos); $j = $j + 2) {?>

  var nombre = "<?php echo $partidos[$j] ?>";

  nombres.push(nombre);

  var partido = "<?php echo $partidos[$j + 1] ?>";

  partidos.push(parseInt(partido));

        <?php }?>

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
      responsive: true,
    maintainAspectRatio: true,
      legend: { display: false },
      title: {
        display: true,
        text: 'Partidos Jugandos por jugador'
      }
    }
});

var nombreCampeonatos = [];
var nParticipantes = [];
var nParejas = [];
<?php for($z = 0; $z < count($campeonatos); $z = $z + 2) { ?>
          
  var nombre = "<?php echo $campeonatos[$z+1] ?>";
  nombreCampeonatos.push(nombre);
  var participante = "<?php echo $campeonatos[$z] ?>";

  nParticipantes.push(parseInt(participante));
  nParejas.push(parseInt(participante)*2);    
          console.log(nombreCampeonatos) ;

<?php } ?>

// Bar chart
new Chart(document.getElementById("campeonato"), {
    type: 'bar',
    data: {
      labels: nombreCampeonatos,
      datasets: [
        {
          label: "Parejas",
          backgroundColor: ["#3e95cd"],
          data: nParejas
        },{
          label: "Participantes",
          backgroundColor: "#8e5ea2",
          data: nParticipantes
        }
      ]
    },
    options: {
      responsive: true,
    maintainAspectRatio: true,
      legend: { display: false },
      title: {
        display: true,
        text: 'Participantes Por campeonato'
      }
    }
});

</script>