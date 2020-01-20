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


			<div >
				<span class="contact100-form-title">
					Hazte socio
				</span>
				<div>
					<div class="section-inner" >
						<div  class="plans select-unlimited" style="display: flex;">
							<div  class="item-free item-column"   style="padding: 2.5%;margin: 2.5%;/* border-style: solid; */border: 1px groove #03A9F4;background-color: #ffff;border-radius: 50px;">

								<div  class="bear-pic">
									<div class="bear-img-wrap free">
										</div> 
										<h2  class="h2">Gratis</h2>
									</div> 
									<div class="inner-wrap">
										<div  class="inner">
											<div  class="content">
												<p>No tienes ventajas pargelas</p> 
												<ul class="check-list yellow copy">
													<li >Pagas lo maximo en todos los servicio </li>
													<li >0% recomendable ;) Un saludo</li>
												</ul> 
												<a class="btn btn-lg" >
												 Gratis
												</a>
											</div>
										</div>
									</div>
								</div> 
								<div class="item-unlimited item-column" style="padding: 2.5%;margin: 2.5%;/* border-style: solid; */border: 1px groove #03A9F4;background-color: #ffff;border-radius: 50px;">
									<div  class="bear-pic">
										<div class="bear-img-wrap unlimited">
										</div> 
										<h2  class="h2">Anual</h2>
									</div> 
									<div class="inner-wrap">
										<div  class="inner">
											<div  class="content">
												<p>La mejor Opción</p> 
												<ul class="check-list copy">
													<li >Unico Pago</li> 
													<li >Clases mas baratas</li> 
													<li >Descuento en reservas</li>
												</ul> <!----> <div  class="pricing">
													
												</div>
												
												 <a class="btn btn-lg" >
													 <input type="radio" name="pago" value="anual">
												 Desde <span class="amount">199.99 €</span></a>
											</div>
										</div>
									</div>
								</div> 
								<div class="item-teams item-column" style="padding: 2.5%;margin: 2.5%;/* border-style: solid; */border: 1px groove #03A9F4;background-color: #ffff;border-radius: 50px;">		
										<h2  class="h2">Mensual</h2>
									<div  class="inner-wrap">
										<div  class="inner">
											<div  class="content">
												<p >Tienes que pagar todos los meses. Que coñazo</p> 
												<ul  class="check-list copy">
													<li >Clases mas baratas</li> 
													<li >Descuento en reservas</li> 

												</ul> <div  class="pricing"><p >
												</div> 
												<a class="btn btn-lg" >
													 <input type="radio" name="pago" value="anual">
												 Desde <span class="amount">24.99 €</span> /mes</a>
										</div> 
										</div>
									</div>
								</div>
						</div>
					</div>
				</div>
            
                 
				
				</div>
				
			<div>
				<div class="wrap-contact100">

				<span class="contact100-form-title">
					Datos tarjeta
				</span>	
				<form class="contact100-form validate-form" method="POST" action="./index.php?controller=users&action=addSocio">

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text"  name="numTarjeta"  placeholder="Num. tarjeta">
					
				</div>

                <div class="wrap-input100 validate-input">
					<input class="input100" type="text"  name="titular"  placeholder="Nombre">
				
				</div>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="codigo" placeholder="Código seguridad">
					
				</div>

				<span class="input100">Fecha validez</span>

                <div class="wrap-input100 validate-input">
					<input class="input100" type="number" name="mes" placeholder="mes">
					
				</div>
				<div class="wrap-input100 validate-input">

				<input class="input100" type="number" name="año" placeholder="año">
				<div class="container-contact100-form-btn">
				</div>
				
				<div class="container-contact100-form-btn" style=" margin-left: 36%; padding-top: 10%;">

				<button class="contact100-form-btn" >
					<span>
					<i class="fas fa-plus-circle"></i>					
						Pagar
					</span>
				</button>
				</div>
			</div>
				

			</form>
		</div>
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
</div> -->
<?php } ?>