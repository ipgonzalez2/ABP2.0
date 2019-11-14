<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Reservar");
$errors = $view->getVariable("errors");
$fechas = $view->getVariable("fechas");
$arrayHoras = $view->getVariable("horas");

$i =0;
$pos =0;
?>


<section class='calendar'>
  <h2>Noviembre 2019</h2>
  <form action='#'>
   

    <?php foreach($fechas as $fecha): ?>
    <label class='day' data-day=<?=$fecha?> onclick="openForm(<?=date('d' , strtotime($fecha))?> , <?=$pos?>)">
    
    <?php if($i <7 ) {?>
      <span><?=date("D" , strtotime($fecha))?> </span>
      
      <?$i++; }?>
      <?php $pos++;?>
      <span><?=date("d" , strtotime($fecha))?> </span>
      <em></em>
    </label>
    <?php endforeach ;?>
   
    <div class='clearfix'></div>
  </form>
  <div class="appointment" id="myForm" dia="" posicion = ""> 

  <form action="" class="form-container">
        <label for="appt-time">Reserva (10:00 a 23:00) </label>
        <select>  
        <?php 
        foreach($arrayHoras[$variable] as $hdia): ?>
        
              <option value=<?=$hdia?>><?=$hdia?></option>
        <?php endforeach ;?>
        
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




function openForm(d,pos) {
  document.getElementById("myForm").style.display = "block";
  document.getElementById("myForm").setAttribute("dia",""+d);
  document.getElementById("myForm").setAttribute("posicion",""+pos);
  document.getElementById("p").setAttribute("id",""+pos);
  document.cookie="posicion = " + pos;
  document.cookie="dia = " + d;
  



  
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>

</body>
</html>