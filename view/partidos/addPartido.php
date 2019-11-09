<?php
//file: view/users/register.php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Crear Partido");

$errors = $view->getVariable("errors");
?>

<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100">
			

			<div class="login100-more" style="background-image: url('./images/padel4.jpg');">
			</div>

			<form class="register100-form validate-form" method="POST" action="./index.php?controller=partidos&action=addPartido">
				<span class="login100-form-title p-b-43">
					Crear un partido
				</span>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="date"  name="fechaPartido"  placeholder="Fecha">
					<span class=" focus-input100"></span>
					<span class="label-input100"></span>
				</div>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="precioPartido" placeholder="Precio">
					<span class="focus-input100"></span>
					<span class="label-input100"></span>
				</div>

				<div class="container-login100-form-btn">
				<button class="login100-form-btn">
							Crear
						</button>
				</div>
				

			</form>
		</div>
	</div>
</div>