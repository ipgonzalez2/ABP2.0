<?php
//file: view/users/register.php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Register");

$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
?>

<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100">
			

			<div class="login100-more" style="background-image: url('./images/padel4.jpg');">
			</div>

			<form class="register100-form validate-form" method="POST" action="./index.php?controller=users&action=register">
				<span class="login100-form-title p-b-43">
					Regístrate
				</span>

				<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
					<input class="input100" type="text"  name="username"  placeholder="Login">
					<span class=" focus-input100"></span>
					<span class="label-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="Password is required">
					<input class="input100" type="password" name="passwd" placeholder="Contraseña">
					<span class="focus-input100"></span>
					<span class="label-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
					<input class="input100" type="text" name="nombre" placeholder="Nombre">
					<span class="focus-input100"></span>
					<span class="label-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
					<input class="input100" type="email" name="email" placeholder="Email">
					<span class="focus-input100"></span>
					<span class="label-input100"></span>
				</div>

				

				<div class="wrap-input100 validate-input">
				<select name="sexo" class="input100">
  					<option name="sexo" value="hombre">Hombre</option>
  					<option name="sexo" value="mujer">Mujer</option>
  				</select>
				  <span class="focus-input100"></span>
					<span class="label-input100">Sexo</span>
				</div>

				<div class="container-login100-form-btn">
				<button class="login100-form-btn">
							Register
						</button>
				</div>
				

			</form>
		</div>
	</div>
</div>