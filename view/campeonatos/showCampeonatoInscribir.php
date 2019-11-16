<?php
//file: view/users/register.php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Incripción Campeonato");

$errors = $view->getVariable("errors");
$campeonato = $view->getVariable("campeonato");
?>

<div class="container-contact100">

	<div class="wrap-contact100">

		<form class="contact100-form validate-form" method="POST" action="./index.php?controller=campeonatos&action=inscribirCampeonato">
			
				<span class="contact100-form-title">
					Incríbete
				</span>

                <div style="display:none" class="wrap-input100 validate-input">
					<input class="input100" type="text" name="idCampeonato" value="<?=$campeonato->getIdCampeonato()?>">	
				</div>

                <div class="wrap-input100 validate-input">
				<select name="categoria" class="input100">
  					<option name="categoria" value="masculina">Masculina</option>
  					<option name="categoria" value="femenina">Femenina</option>
                    <option name="categoria" value="mixto">Mixta</option>
  				</select>
				  <span ></span>
					<span class="label-input100">Categoria</span>
				</div>

				<div class="wrap-input100 validate-input">
				<select name="nivel" class="input100">
  					<option name="nivel" value="1">1</option>
  					<option name="nivel" value="2">2</option>
                    <option name="nivel" value="3">3</option>
  				</select>
				  <span ></span>
					<span class="label-input100">Nivel</span>
				</div>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="loginPareja" placeholder="Login Pareja">
					
				</div>

				<div class="container-contact100-form-btn">
				<button class="contact100-form-btn">
					<span>
					<i class="fas fa-plus-circle"></i>					
						Inscríbete
					</span>
				</button>
			</div>
				

			</form>
		</div>
	</div>
</div>