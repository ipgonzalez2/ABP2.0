<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Reservar");
$errors = $view->getVariable("errors");
$fechas = $view->getVariable("fechas");
$arrayHoras = $view->getVariable("horas");

$i =0;
$pos =0;
$z =0;
?>


<section class='calendar'>
<?php foreach($fechas as $fecha):
  

  endforeach ;?>

<h2><?=date('M' , strtotime($fecha))?></h2>

  <form method="POST" action="./index.php?controller=reservas&action=addReserva">

  <?php foreach($fechas as $fecha): ?>

    <?php if($i<7){ ?>
      
      <span value=<?=$fecha?> data-day=<?=$fecha?> name ="fecha"><?=date("D" , strtotime($fecha))?> </span>
      
    <?php $i++;} ?>

    <?php $pos++;?>

    <label class='day' value=<?=$fecha?>  data-day=<?=$fecha?> onclick="openForm(<?=date('d' , strtotime($fecha))?>  ,<?=$pos?>)"  >
    <input style="display:none" class="todasFechas" name id=<?=date('d' , strtotime($fecha))?> value=<?=$fecha?>>
    <span><?=date("d" , strtotime($fecha))?> </span>
    </input>
    <em></em>
    </label>

  

    <?php endforeach; ?>

    <div class='clearfix'></div>
    </section>

    <div class="appointment" id="myForm" dia="" posicion = ""> 

    <label for="appt-time">Reserva (10:00 a 23:00) </label>

    <?php for ($i = 0; $i <= 7; $i++) {?>

      <select class="horas" name id=<?=$i?> style="display:none;">  
      <?php foreach($arrayHoras[$i] as $hdia): ?>
        <option value=<?=$hdia?>><?=$hdia?></option>
      <?php endforeach; ?>
      </select>

    <?php } ?>

    <div>
          <button type="submit">Guardar</button>
          <label type="button" onclick="closeForm()" >cerrar </label>
    </div>

    </div>
  
  </form>


<script>
  
function openForm(d ,pos) {
  var fechas = document.getElementsByClassName("todasFechas");
  var list = document.getElementsByClassName("horas");

  for(var i = 0;i<8;i++){
    list[i].style.display="none";
    list[i].removeAttribute("name");
    fechas[i].removeAttribute("name");
  }
  
  var selectAsd = document.getElementById( pos );
  selectAsd.style.display = 'block';

  document.getElementById(pos).setAttribute("name","hora");
  document.getElementById(d).setAttribute("name","fecha");


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

