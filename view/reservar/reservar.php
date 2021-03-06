<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Reservar");
$errors = $view->getVariable("errors");
$fechas = $view->getVariable("fechas");
$arrayHoras = $view->getVariable("horas");
$arrayHoras[7] = array();
$i =0;
$pos =0;
$z =0;
?>


<section class='calendar'>
<div class="cabecera">
<?php foreach($fechas as $fecha):
  if($z<1){?>
  <h2><i class="fab fa-angellist"></i>&nbsp&nbsp&nbsp&nbsp&nbsp<?=date('d-m-Y' , strtotime($fecha))?>&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-calendar-alt"></i>&nbsp&nbsp&nbsp&nbsp&nbsp
  <?php } 
  $z++;
  endforeach ;?>

<?=date('d-m-Y' , strtotime($fecha))?>&nbsp&nbsp&nbsp&nbsp&nbsp<i class="fab fa-angellist"></i></h2>
  </div>
  <form method="POST" action="./index.php?controller=reservas&action=addReserva">

  <?php foreach($fechas as $fecha): ?>
    <?php if(!empty($arrayHoras[$pos])){?>
   
      <div class="cuadrado" id="cuadrado" onclick="openForm(<?=date('d' , strtotime($fecha))?> ,'<?=date('Y-m-d' , strtotime($fecha))?>'  ,<?=$pos?>)">
      <span value=<?=$fecha?> data-day=<?=$fecha?> name ="fecha"><?=date("l" , strtotime($fecha))?> </span>

        <label class='day' value=<?=$fecha?>  data-day=<?=$fecha?>>
    
          <input style="display:none" class="todasFechas" name id=<?=date('Y-m-d' , strtotime($fecha))?> value=<?=$fecha?>>
          <span><?=date("d" , strtotime($fecha))?> </span>
         </input>
         <em></em>
        </label>
      </div>

  <?php } else{?>
    <div class="cuadrado-no-valido" id="cuadrado-no-valido">
      <span value=<?=$fecha?> data-day=<?=$fecha?> name ="fecha"><?=date("l" , strtotime($fecha))?> </span>

        <label class='day' value=<?=$fecha?>  data-day=<?=$fecha?>>
    
          <input style="display:none" class="todasFechas" name id=<?=date('Y-m-d' , strtotime($fecha))?> value=<?=$fecha?>>
          <span><?=date("d" , strtotime($fecha))?> </span>
         </input>
         <em></em>
        </label>
      </div>
  <?php } ?>


    <?php $pos++;?>

  

    <?php endforeach; ?>

    <div class='clearfix'></div>
    </section>

    <div class="appointment" id="myForm" dia="" posicion = ""> 

    <label id="dia" for="appt-time"></label>

    <?php for ($i = 0; $i < 14; $i++) {?>

      <select class="horas" name id=<?=$i?> style="display:none;">  
      <?php foreach($arrayHoras[$i] as $hdia): ?>
        <option value=<?=$hdia?>><?=$hdia?></option>
      <?php endforeach; ?>
      </select>

    <?php } ?>

    <div class="botones">
          <a id="bpagar" type="pagar" onclick="card()">Pagar</a>
          <button id="bcerrar" type="button" onclick="closeForm()" >cerrar </button>
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



<script>
  
function openForm(d, anho ,pos) {
  var fechas = document.getElementsByClassName("todasFechas");
  var list = document.getElementsByClassName("horas");

  for(var i = 0;i<14;i++){
    list[i].style.display="none";
    list[i].removeAttribute("name");
    fechas[i].removeAttribute("name");
  }
  
  var selectAsd = document.getElementById( pos );
  selectAsd.style.display = 'block';

  document.getElementById(pos).setAttribute("name","hora");
  document.getElementById(anho).setAttribute("name","fecha");


  document.getElementById("myForm").style.display = "block";
  document.getElementById("myForm").setAttribute("dia",""+d);
  document.getElementById("myForm").setAttribute("posicion",""+pos);
  document.getElementById("dia").innerHTML = "Reserva del dia " +d+"  (09:00 a 21:00)<br> Precio de la reserva es de 22€ ( Socios 12€ )" ;





  
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";


}


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

