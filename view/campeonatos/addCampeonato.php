<?php
//file: view/users/register.php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Crear Campeonato");

$errors = $view->getVariable("errors");
?>

<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100">
			

			<div class="login100-more" style="background-image: url('./images/padel4.jpg');">
			</div>

			<form class="register100-form validate-form" method="POST" action="./index.php?controller=campeonatos&action=addCampeonato">
				<span class="login100-form-title p-b-43">
					Crear un campeonato
				</span>

                <div class="wrap-input100 validate-input">
					<input class="input100" type="text"  name="nombreCampeonato"  placeholder="Nombre">
					<span class=" focus-input100"></span>
					<span class="label-input100"></span>
				</div>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="date"  name="fechaInicio"  placeholder="Fecha Inicio">
					<span class=" focus-input100"></span>
					<span class="label-input100"></span>
				</div>

                <div class="wrap-input100 validate-input">
					<input class="input100" type="date"  name="fechaFin"  placeholder="Fecha Fin">
					<span class=" focus-input100"></span>
					<span class="label-input100"></span>
				</div>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="precioCampeonato" placeholder="Precio">
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