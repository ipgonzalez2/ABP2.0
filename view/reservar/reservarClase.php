<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Reservar clase");
$errors = $view->getVariable("errors");
$fechas = $view->getVariable("fechas");
$arrayHoras = $view->getVariable("horas");
$idClase = $view->getVariable("idClase");
$arrayHoras[7] = array();
$i =0;
$pos =0;
$z =0;
?>


<section class='calendar'>
<div class="cabecera">
<?php foreach($fechas as $fecha):
  if($z<1){?>
  <h2><i class="fab fa-angellist"></i>&nbsp&nbsp&nbsp&nbsp&nbsp<?=date('d-m-Y' , strtotime($fecha))?>&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-calendar-alt"></i>&nbsp&nbsp&nbsp&nbsp&nbsp
  <?php } 
  $z++;
  endforeach ;?>

<?=date('d-m-Y' , strtotime($fecha))?>&nbsp&nbsp&nbsp&nbsp&nbsp<i class="fab fa-angellist"></i></h2>
  </div>
  <form method="POST" action="<?="./index.php?controller=clases&action=reservarClase&idClase=".$idClase?>">

  <?php foreach($fechas as $fecha): ?>
    <?php if(!empty($arrayHoras[$pos])){?>
   
      <div class="cuadrado" onclick="openForm(<?=date('d' , strtotime($fecha))?> ,'<?=date('Y-m-d' , strtotime($fecha))?>'  ,<?=$pos?>)">
      <span value=<?=$fecha?> data-day=<?=$fecha?> name ="fecha"><?=date("l" , strtotime($fecha))?> </span>

        <label class='day' value=<?=$fecha?>  data-day=<?=$fecha?>>
    
          <input style="display:none" class="todasFechas" name id=<?=date('Y-m-d' , strtotime($fecha))?> value=<?=$fecha?>>
          <span><?=date("d" , strtotime($fecha))?> </span>
         </input>
         <em></em>
        </label>
      </div>

  <?php } else{?>
    <div class="cuadrado-no-valido">
      <span value=<?=$fecha?> data-day=<?=$fecha?> name ="fecha"><?=date("l" , strtotime($fecha))?> </span>

        <label class='day' value=<?=$fecha?>  data-day=<?=$fecha?>>
    
          <input style="display:none" class="todasFechas" name id=<?=date('Y-m-d' , strtotime($fecha))?> value=<?=$fecha?>>
          <span><?=date("d" , strtotime($fecha))?> </span>
         </input>
         <em></em>
        </label>
      </div>
  <?php } ?>


    <?php $pos++;?>

  

    <?php endforeach; ?>

    <div class='clearfix'></div>
    </section>

    <div class="appointment" id="myForm" dia="" posicion = ""> 

    <label id="dia" for="appt-time"></label>

    <?php for ($i = 0; $i < 14; $i++) {?>

      <select class="horas" name id=<?=$i?> style="display:none;">  
      <?php foreach($arrayHoras[$i] as $hdia): ?>
        <option value=<?=$hdia?>><?=$hdia?></option>
      <?php endforeach; ?>
      </select>

    <?php } ?>

    <div class="botones">
          <button type="submit">Guardar</button>
          <button type="button" onclick="closeForm()" >cerrar </button>
    </div>

    </div>
  
  </form>


<script>
  
function openForm(d, anho ,pos) {
  var fechas = document.getElementsByClassName("todasFechas");
  var list = document.getElementsByClassName("horas");

  for(var i = 0;i<14;i++){
    list[i].style.display="none";
    list[i].removeAttribute("name");
    fechas[i].removeAttribute("name");
  }
  
  var selectAsd = document.getElementById( pos );
  selectAsd.style.display = 'block';

  document.getElementById(pos).setAttribute("name","hora");
  document.getElementById(anho).setAttribute("name","fecha");


  document.getElementById("myForm").style.display = "block";
  document.getElementById("myForm").setAttribute("dia",""+d);
  document.getElementById("myForm").setAttribute("posicion",""+pos);
  document.getElementById("dia").innerHTML = "Reserva del dia " +d+"  (09:00 a 21:00)<br>" ;





  
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";


}
</script>

