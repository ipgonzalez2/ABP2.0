<?php
//file: view/users/register.php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Socio");
$esSocio = $view->getVariable("esSocio");
$pago = $view->getVariable("pago");
?>

<?php if(!$esSocio){ ?>
<div class="container-contact100">

	<div class="wrap-contact100">

		<form class="contact100-form validate-form" method="POST" action="./index.php?controller=users&action=addSocio">
			
				<span class="contact100-form-title">
					Hazte socio
				</span>

                <div>
                    <input type="radio" name="pago" value="anual"> Anual (204€)<br>
                    <input type="radio" name="pago" value="mensual"> Mensual (25€/mes)<br>
				
				</div>
                PAGO
				<div class="wrap-input100 validate-input">
					<input class="input100" type="text"  name="numTarjeta"  placeholder="Num. tarjeta">
					
				</div>

                <div class="wrap-input100 validate-input">
					<input class="input100" type="text"  name="titular"  placeholder="Nombre">
				
				</div>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="codigo" placeholder="Código seguridad">
					
				</div>

                <div class="wrap-input100 validate-input">
                <span class="input100">Fecha validez</span>
					<input class="input100" type="number" name="mes" placeholder="mes">
					<input class="input100" type="number" name="año" placeholder="año">
				</div>

				<div class="container-contact100-form-btn">
				<button class="contact100-form-btn">
					<span>
					<i class="fas fa-plus-circle"></i>					
						Pagar
					</span>
				</button>
			</div>
				

			</form>
		</div>
	</div>
</div>
<?php }else { ?>
	<div class="container-contact100">

<div class="wrap-contact100">

	<form class="contact100-form validate-form" method="POST" action="./index.php?controller=users&action=removeSocio">
		
			<span class="contact100-form-title">
				Cancela tu suscripción
			</span>

			<div>
			TARIFA
			<?php if($pago->getPrecio() == 204){ ?>
			<span class="input100">Tarifa anual 204€</span>
			<?php }else{ ?>
			<span class="input100">Tarifa mensual 25€ / mes</span>
			<?php } ?>
			</div>

			<div class="container-contact100-form-btn">
			<button class="contact100-form-btn">
				<span>
				<i class="fas fa-plus-circle"></i>					
					Cancelar suscripción
				</span>
			</button>
		</div>
			

		</form>
	</div>
</div>
</div>
<?php } ?>