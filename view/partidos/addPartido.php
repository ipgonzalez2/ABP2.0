<?php
//file: view/users/register.php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Crear Partido");

$errors = $view->getVariable("errors");
?>


<div class="container-contact100">

	<div class="wrap-contact100">

		<form class="contact100-form validate-form" method="POST" action="./index.php?controller=partidos&action=addPartido">
			<span class="contact100-form-title">
				Crear un partido
			</span>

			<div class="wrap-input100 validate-input">
				<input class="input100" type="date" name="fechaPartido" placeholder="Fecha">

			</div>

			<div class="wrap-input100 validate-input">
				<input class="input100" type="text" name="precioPartido" placeholder="Precio">

			</div>

			<div class="container-contact100-form-btn">
				<button class="contact100-form-btn">
					<span>
					<i class="fas fa-plus-circle"></i>					
						Crear
					</span>
				</button>
			</div>

		</form>
	</div>
</div>



