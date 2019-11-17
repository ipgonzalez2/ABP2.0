<?php
//file: view/users/register.php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Editar Resultado");

$errors = $view->getVariable("errors");
$enfrentamiento = $view->getVariable("enfrentamiento");
$deportistas = $view->getVariable("deportistas");
?>

<div class="container-contact100">

	<div class="wrap-contact100">

		<form class="contact100-form validate-form" method="POST" action="./index.php?controller=campeonatos&action=editarResultado">
			
				<span class="contact100-form-title">
					Resultado
				</span>

                <div style="display:none" class="wrap-input100 validate-input">
					<input class="input100" type="text" name="idEnfrentamiento" value="<?=$enfrentamiento->getIdEnfrentamiento()?>">	
				</div>

                <div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="resultado1" placeholder="<?=$deportistas[0]?>  <?=$deportistas[1]?>">	
				</div>

                <div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="resultado2" placeholder="<?=$deportistas[2]?>  <?=$deportistas[3]?>">	
				</div>

				<div class="container-contact100-form-btn">
				<button class="contact100-form-btn">
					<span>
					<i class="fas fa-check-circle"></i>					
						Guardar
					</span>
				</button>
			</div>
				

			</form>
		</div>
	</div>
</div>