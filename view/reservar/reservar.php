<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Reservar");
$errors = $view->getVariable("errors");
$fechas = $view->getVariable("fechas");
$arrayHoras = $view->getVariable("horas");

$i=0;
?>


<section class='calendar'>
  <h2>Noviembre 2019</h2>
  <form method="POST" action="./index.php?controller=reservas&action=addReserva">
   

    <?php foreach($fechas as $fecha): ?>
    <label class='day' value=<?=$fecha?> name ="fecha" data-day=<?=$fecha?> onclick="openForm(<?=$fecha?> ,<?=$pos?>)"  >
    
    <?php if($i <7 ) {?>
      <span value=<?=$fecha?> name ="fecha"><?=date("D" , strtotime($fecha))?> </span>
      
      <?$i++; }?>
      <?php $pos++;?>
      <span><?=date("d" , strtotime($fecha))?> </span>
      <em></em>
    </label>
    <?php endforeach;?>
   
    <div class='clearfix'></div>
  


  <div class="appointment" id="myForm" dia="" posicion = ""> 

 
        <label for="appt-time">Reserva (10:00 a 23:00) </label>
        <?php 

        for ($i = 0; $i <= 6; $i++) {?>
            <select name="hora" id=<?=$i?> class="horas" style="display:none;">  
                <?php   foreach($arrayHoras[$i] as $hdia): ?>

              <option value=<?=$hdia?>><?=$hdia?></option>
              <?php endforeach ;?>

            </select>

              
        <?}?>
         <span class="validity"></span>
        
  
      </div>
      <div>
          <button type="submit">Guardas</button>
          <label type="button"  onclick="closeForm()" >cerrar </label>
         </div>
        
</form>


</section>

<script>
  

var startTime = document.getElementById("startTime");
var valueSpan = document.getElementById("value");

startTime.addEventListener("input", function() {
  valueSpan.innerText = startTime.value;
}, false);


function test(){


}

function openForm(d ,pos) {
  var list = document.getElementsByClassName("horas");
  for(var i = 0;i<7;i++){
    list[i].style.display="none";
  }
  var selectAsd = document.getElementById( pos );
  selectAsd.style.display = 'block';
  document.getElementById("myForm").style.display = "block";
  document.getElementById("myForm").setAttribute("dia",""+d);
  document.getElementById("myForm").setAttribute("posicion",""+pos);
  document.cookie="posicion = " + pos;
  document.cookie="dia = " + d;





  
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>

</section>



</body>
</html>