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

<form class="contact100-form validate-form" method="POST" action="./index.php?controller=users&action=addSocio">

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
													 <input type="radio" name="pago" value="mensual">
												 Desde <span class="amount">24.99 €</span> /mes</a>
										</div> 
										</div>
									</div>
								</div>
						</div>
          </div>
          <div class="botones">
          <a id="bpagar" type="pagar" class="myButton" onclick="card()" style="cursor: pointer;
          margin :0;
    display: inline-block;
    font-weight: 400;
    letter-spacing: 0.125em;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    white-space: nowrap;
    font-size: 0.75rem;
    max-width: 20rem;
    height: 3.75em;
    line-height: 3.75em;
    border-radius: 3.75em;
    padding: 0 2.5em;
    text-overflow: ellipsis;
    overflow: hidden;">Pagar</a>
    </div>
				</div>
            
                 
				
				</div>
				
			

    </div>
  


  <div class="container" id="tarjeta" style="display: none">
  <div class="col1">
    <div class="card">
      <div class="front">
        <div class="type">
          <img class="bankid"/>
        </div>
        <span class="chip"></span>
        <span class="card_number">&#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; </span>
        <div class="date"><span class="date_value">MM / AAAA</span></div>
        <span class="fullname">Nombre Completo</span>
      </div>
      <div class="back">
        <div class="magnetic"></div>
        <div class="bar"></div>
        <span class="seccode">&#x25CF;&#x25CF;&#x25CF;</span>
        <span class="chip"></span><span class="disclaimer">Ten cuidado. <br> No me protestes si falla </span>
      </div>
    </div>
  </div>
  <div class="col2">
    <label>Numero de tarjeta</label>
    <input class="number" type="text" ng-model="ncard" maxlength="19" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
    <label>Nombre del titular </label>
    <input class="inputname" type="text" placeholder=""/>
    <label>Fecha de caducidad</label>
    <input class="expire" type="text" placeholder="MM / YYYY"/>
    <label>Numero De Seguridad</label>
    <input class="ccv" type="text" placeholder="CVC" maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
    <button type="submit" class="buy">Pagar</button>
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
			<?php if($pago->getPrecio() == 204){ ?>
				<div class="item-unlimited item-column" style="padding: 2.5%;margin: 2.5%;/* border-style: solid; */border: 1px groove #03A9F4;background-color: #ffff;border-radius: 50px;">
									<div  class="bear-pic">
										<div class="bear-img-wrap unlimited">
										</div> 
										<h2  class="h2" style="
    text-align: center;
"> Anual</h2>
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
											
											</div>
										</div>
									</div>
								</div> 
			<?php }else{ ?>
        <div class="item-teams item-column" style="padding: 2.5%;margin: 2.5%;/* border-style: solid; */border: 1px groove #03A9F4;background-color: #ffff;border-radius: 50px;">		
										<h2  class="h2" style="
    text-align: center;
">Mensual</h2>
									<div  class="inner-wrap">
										<div  class="inner">
											<div  class="content">
												<p >Tienes que pagar todos los meses. Que coñazo</p> 
												<ul  class="check-list copy">
													<li >Clases mas baratas</li> 
													<li >Descuento en reservas</li> 

												</ul> <div  class="pricing"><p >
												</div> 
												
										</div> 
										</div>
									</div>
								</div>
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



<script>
function card(){
  document.getElementById("tarjeta").style.display = "flex";
  document.getElementById("myForm").style.display = "none";
 
  document.getElementById("tarjeta").setAttribute("class"," cd-popup is-visible");

}


// 4: VISA, 51 -> 55: MasterCard, 36-38-39: DinersClub, 34-37: American Express, 65: Discover, 5019: dankort


$(function(){
  
  var cards = [{
    nome: "mastercard",
    colore: "#0061A8",
    src: "https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png"
  }, {
    nome: "visa",
    colore: "#E2CB38",
    src: "https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/2000px-Visa_Inc._logo.svg.png"
  }, {
    nome: "dinersclub",
    colore: "#888",
    src: "http://www.worldsultimatetravels.com/wp-content/uploads/2016/07/Diners-Club-Logo-1920x512.png"
  }, {
    nome: "americanExpress",
    colore: "#108168",
    src: "https://upload.wikimedia.org/wikipedia/commons/thumb/3/30/American_Express_logo.svg/600px-American_Express_logo.svg.png"
  }, {
    nome: "discover",
    colore: "#86B8CF",
    src: "https://lendedu.com/wp-content/uploads/2016/03/discover-it-for-students-credit-card.jpg"
  }, {
    nome: "dankort",
    colore: "#0061A8",
    src: "https://upload.wikimedia.org/wikipedia/commons/5/51/Dankort_logo.png"
  }];
  
  var month = 0;
  var html = document.getElementsByTagName('html')[0];
  var number = "";
  
  var selected_card = -1;
  
  $(document).click(function(e){
    if(!$(e.target).is(".ccv") || !$(e.target).closest(".ccv").length){
      $(".card").css("transform", "rotatey(0deg)");
      $(".seccode").css("color", "var(--text-color)");
    }
    if(!$(e.target).is(".expire") || !$(e.target).closest(".expire").length){
      $(".date_value").css("color", "var(--text-color)");
    }
    if(!$(e.target).is(".number") || !$(e.target).closest(".number").length){
      $(".card_number").css("color", "var(--text-color)");
    }
    if(!$(e.target).is(".inputname") || !$(e.target).closest(".inputname").length){
      $(".fullname").css("color", "var(--text-color)");
    }
  });
  
  
  //Card number input
  $(".number").keyup(function(event){
    $(".card_number").text($(this).val());
    number = $(this).val();
    
    if(parseInt(number.substring(0, 2)) > 50 && parseInt(number.substring(0, 2)) < 56){
      selected_card = 0;
    }else if(parseInt(number.substring(0, 1)) == 4){
      selected_card = 1;  
    }else if(parseInt(number.substring(0, 2)) == 36 || parseInt(number.substring(0, 2)) == 38 || parseInt(number.substring(0, 2)) == 39){
      selected_card = 2;     
    }else if(parseInt(number.substring(0, 2)) == 34 || parseInt(number.substring(0, 2)) == 37){
      selected_card = 3; 
    }else if(parseInt(number.substring(0, 2)) == 65){
      selected_card = 4; 
    }else if(parseInt(number.substring(0, 4)) == 5019){
      selected_card = 5; 
    }else{
      selected_card = -1; 
    }
    
    if(selected_card != -1){
      html.setAttribute("style", "--card-color: " + cards[selected_card].colore);  
      $(".bankid").attr("src", cards[selected_card].src).show();
    }else{
      html.setAttribute("style", "--card-color: #cecece");
      $(".bankid").attr("src", "").hide();
    }
    
    if($(".card_number").text().length === 0){
      $(".card_number").html("&#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF;");
    }

  }).focus(function(){
    $(".card_number").css("color", "white");
  }).on("keydown input", function(){
    
    $(".card_number").text($(this).val());
    
    if(event.key >= 0 && event.key <= 9){
      if($(this).val().length === 4 || $(this).val().length === 9 || $(this).val().length === 14){
        $(this).val($(this).val() +  " ");
      }
    }
  })
  
  //Name Input
  $(".inputname").keyup(function(){  
    $(".fullname").text($(this).val());  
    if($(".inputname").val().length === 0){
        $(".fullname").text("FULL NAME");
    }
    return event.charCode;
  }).focus(function(){
    $(".fullname").css("color", "white");
  });
  
  //Security code Input
  $(".ccv").focus(function(){
    $(".card").css("transform", "rotatey(180deg)");
    $(".seccode").css("color", "white");
  }).keyup(function(){
    $(".seccode").text($(this).val());
    if($(this).val().length === 0){
      $(".seccode").html("&#x25CF;&#x25CF;&#x25CF;");
    }
  }).focusout(function() {
      $(".card").css("transform", "rotatey(0deg)");
      $(".seccode").css("color", "var(--text-color)");
  });
    
  
  //Date expire input
  $(".expire").keypress(function(event){
    if(event.charCode >= 48 && event.charCode <= 57){
      if($(this).val().length === 1){
          $(this).val($(this).val() + event.key + " / ");
      }else if($(this).val().length === 0){
        if(event.key == 1 || event.key == 0){
          month = event.key;
          return event.charCode;
        }else{
          $(this).val(0 + event.key + " / ");
        }
      }else if($(this).val().length > 2 && $(this).val().length < 9){
        return event.charCode;
      }
    }
    return false;
  }).keyup(function(event){
    $(".date_value").html($(this).val());
    if(event.keyCode == 8 && $(".expire").val().length == 4){
      $(this).val(month);
    }
    
    if($(this).val().length === 0){
      $(".date_value").text("MM / YYYY");
    }
  }).keydown(function(){
    $(".date_value").html($(this).val());
  }).focus(function(){
    $(".date_value").css("color", "white");
  });
});
</script>