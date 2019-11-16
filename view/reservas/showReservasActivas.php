<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "PARTIDOS INSCRITO");
$errors = $view->getVariable("errors");
$reservasActivas = $view->getVariable("reservasActivas");
$userRol = $view->getVariable("userRol");

?>

<?php if(count($reservasActivas) == 0){ ?>
    <div class="alert alert-warning text-center" style="width:100%; height:7%;" id="success-warning" role="alert">

        No tienes ninguna reserva activa
    </div>
<?php } ?>

<div class="table100 ver2 m-b-110">
    <div class="table100-head">
      <table>
        <thead>
          <tr class="row100 head">
            <th class="cell100 column1">Fecha</th>
            <th class="cell100 column2">Hora</th>
            <th class="cell100 column3">Precio</th>
            <th class="cell100 column4">Pista</th>
            <th class="cell100 column4"></th>
          </tr>
            </thead>
      </table>
    </div>
    <?php foreach($reservasActivas as $reserva):?>

      <div class="table100-body js-pscroll">
      <table>
          <tbody>
            <tr class="row100 body">
              <td class="cell100 column1"><?= date("d-m-Y",strtotime($reserva->getFecha()))?></td>
              <td class="cell100 column2"><?= date("H:i",strtotime($reserva->getHora()))?></td>
              <td class="cell100 column3"><?= $reserva->getPrecio()?></td>
              <td class="cell100 column4"><?= $reserva->getPistaReserva()?></td>
                <?php 
                  $fecha_actual = new DateTime(date("Y-m-d"));
                  $fecha = new DateTime($reserva->getFecha());
                  $interval = ($fecha_actual->diff($fecha))->format("%a");
                  if($interval == 1){
                    $hora_actual = (new DateTime(date("H:i:s",time())))->format("H");
                    $minutos_actual = (new DateTime(date("H:i:s",time())))->format("i");
                    $hora = (new DateTime($reserva->getHora()))->format("H");
                    $minutos = (new DateTime($reserva->getHora()))->format("i");
                    if($hora>$hora_actual || ($hora==$hora_actual && $minutos>$minutos_actual)){?>
                                 <td class="cell100 column4"><a class="cd-popup-trigger" href="<?= "index.php?controller=reservas&action=deleteReserva&idReserva=" . $reserva->getIdReserva() ?>">
                                 <i class="fa fa-trash-alt"></i>
                                  </a></td>
                                  <?php } }else if($interval>1){ ?>
                                 <td class="cell100 column4"><a class="cd-popup-trigger" href="<?= "index.php?controller=reservas&action=deleteReserva&idReserva=" . $reserva->getIdReserva()  ?>">
                                 <i class="fa fa-trash-alt"></i>
                                 </a></td>
                                 <?php } ?>
              </tr>
        </table> 
        </div>
      <?php endforeach; ?>
      </div>

<div class="cd-popup" role="alert">
	<div class="cd-popup-container">
		<p>Estas seguro que quieres borrar</p>
		<ul class="cd-buttons">
			<li><a href="<?= "index.php?controller=reservas&action=deleteReserva&idReserva=" . $reserva->getIdReserva() ?>">Si</a></li>
			<li><a  href="#0">No</a></li>
		</ul>
		<a href="#0" class="cd-popup-close img-replace"></a>
	</div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->

      <script>
      
      jQuery(document).ready(function($){
	//open popup
	$('.cd-popup-trigger').on('click', function(event){
		event.preventDefault();
		$('.cd-popup').addClass('is-visible');
	});
	
	//close popup
	$('.cd-popup').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') ) {
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('.cd-popup').removeClass('is-visible');
	    }
    });
});

</script>


