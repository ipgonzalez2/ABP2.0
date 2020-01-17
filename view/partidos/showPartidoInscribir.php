<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Inscripcion partido");
$errors = $view->getVariable("errors");
$partido = $view->getVariable("partido");
$nombres = $view->getVariable("nombres");

?>

<div class="table100 ver2 m-b-110">
    <div class="table100-head">
      <table>
        <thead>
          <tr class="row100 head">
            <th class="cell100 column1">Fecha</th>
            <th class="cell100 column1">Participantes</th>
            <th class="cell100 column2">Precio</th>
            <th class="cell100 column3">Estado</th>
            <th class="cell100 column4">Límite inscripcion</th>
            <th class="cell100 column4">Inscribirse</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="table100-body js-pscroll">
        <table>
          <tbody>
            <tr class="row100 body">
              <td class="cell100 column1"><?= $partido->getFechaPartido() ?></td>
              <td class="cell100 column1">
              <?php foreach($nombres as $nombre){ 
                echo($nombre);?><br>
                <?php
              }
              ?>
              </td>
              <td class="cell100 column2"><?= $partido->getPrecioPartido() ?></td>
              <td class="cell100 column3"><?= $partido->getEstadoPartido() ?></td>
              <td class="cell100 column4"><?= $partido->getFechaFinInscripcion() ?></td>
              <td class="cell100 column4"><a class="cd-popup-trigger" href="<?="index.php?controller=partidos&action=inscribirPartido&idPartido=".$partido->getIdPartido() ?>"><i class="fas fa-plus-circle"></i></a></td>

              </tr>
          </tbody>
        </table>
      </div>
  </div>

  

 <div class="cd-popup" role="alert">
	<div class="cd-popup-container">
		<p>Estas seguro que quieres inscribirse al partido?</p>
		<ul class="cd-buttons">
			<li><a href="<?="index.php?controller=partidos&action=inscribirPartido&idPartido=".$partido->getIdPartido() ?>">Si</a></li>
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


