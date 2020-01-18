<?php
//file: view/users/register.php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Solicitar clases");

$errors = $view->getVariable("errors");
?>



			<form class=" validate-form" method="POST" action="./index.php?controller=clases&action=solicitarClase">
				<span class="login100-form-title p-b-43">
					Solicitud de clases
				</span>

                <div class="wrap-input100 validate-input">
                Socios disponen de un 10% de descuento
				<input class="input100" name="duracion" type="text" list="duracion" placeholder="Duración" autocomplete=off/>
				<datalist id="duracion" name="duracion" >
  					<option name="duracion" value="1">1 clase (30€)</option>
  					<option name="duracion" value="5">5 clases (140€)</option>
                    <option name="duracion" value="10">10 clases (260€)</option>
  				</datalist>
				</div>

    <div>
					<textarea  type="text"  name="comentario"  placeholder="Indica de lunes a viernes horarios que tiene disponibles (MAÑANA 9:00-15:00) O (TARDE 15:00-22:30)"></textarea>

</div>
				


				<div class="container-login100-form-btn">
				<button class="login100-form-btn">
							Pagar y solicitar
				</button>
				</div>
				

			</form>
