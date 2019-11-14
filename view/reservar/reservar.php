<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Reservar");
$errors = $view->getVariable("errors");
$fechas = $view->getVariable("fechas");
$arrayHoras = $view->getVariable("horas");

$i =0;
?>

<section class='calendar'>
  <h2>Noviembre 2019</h2>
  <form action='#'>
   

    <?php foreach($fechas as $fecha): ?>
    <label class='day' data-day=<?=$fecha?> onclick="openForm(<?=date('d' , strtotime($fecha))?>,<?=date('m' , strtotime($fecha))?>,<?=date('y' , strtotime($fecha))?>)">
    
    <?php if($i <7 ) {?>
      <span><?=date("D" , strtotime($fecha))?> </span>
      
      <?$i++; }?>
      <span><?=date("d" , strtotime($fecha))?> </span>
      <em></em>
    </label>
    <?php endforeach ;?>
   
    <div class='clearfix'></div>
  </form>

  <div class="appointment" id="myForm" dia=""> 
        <form action="" class="form-container">
        <label for="appt-time">Reserva (10:00 a 23:00) </label>
        <select>
        
        </select>
         <span class="validity"></span>
         <div>
                <input type="submit" value="Guarda Reserva">
                <label type="button"  onclick="closeForm()" >cerrar </label>
         </div>
        </form>     
      </div>


   



<script>

var startTime = document.getElementById("startTime");
var valueSpan = document.getElementById("value");

startTime.addEventListener("input", function() {
  valueSpan.innerText = startTime.value;
}, false);




function openForm(d,m,y) {
  document.getElementById("myForm").style.display = "block";
  document.getElementById("myForm").setAttribute("dia",""+d+m+y)
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>

</body>
</html>

</section>

 