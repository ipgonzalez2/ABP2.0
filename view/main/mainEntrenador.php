<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "PadelBit");
$errors = $view->getVariable("errors");
?>

<header class="header-section">
    <div class="nav-switch">
    <img src="images/logo.png" width="70" height="60">
   </div>
    <div class="header-social">
    <a href="./index.php?controller=clases&action=showallSolicitudes"><i class="fa fa-chalkboard-teacher"></i></a>
        <a href="./index.php?controller=users&action=edit"><i class="fas fa-user"></i></i></a>
        <a href="./index.php?controller=users&action=logout"><i class="fas fa-sign-out-alt"></i></a>
    </div>
</header>
    <div id="wrapper" class="divided">

    <!-- One -->
    <section class="banner style1 orient-left content-align-left image-position-right fullscreen onload-image-fade-in onload-content-fade-right">
        <div class="content">
            <h1>PadelBit</h1>
            <p class="major">ENTRENADOR</p>
            <ul class="actions stacked">
                <li><a href="./index.php?controller=clases&action=showClasesEntrenador" class="button">Ver horario de clases</a></li>
            </ul>
        </div>
        <div class="image">
            <img src="./images/padel6.jpg" alt="" />
        </div>
    </section>
    </div>
    


    <!-- Footer -->
    <!-- Footer -->
    <footer class="wrapper style1 align-center">
        <div class="inner">
		<small class="d-block mb-3 text-muted">&copy; 2016-2020</small>
    </div>
    <div class="col-6 col-md">
     

      <h5>Horario</h5>
      <ul class="list-unstyled text-small">
        <li><a class="text-muted" href="#">Lunes a Domingo : 09:00 -- 22:30</a></li>
        <li><a class="text-muted" href="https://i.pinimg.com/originals/9f/bd/64/9fbd647f14c399ee80b6050adb761a9e.jpg">Algo mas</a></li>
        <li><a class="text-muted" href="https://weather.com/es-ES/tiempo/hoy/l/251cec6a9bb33f4b37d385cc0642b9a63928ded87b33f79e2041fadbbf504070">El tiempo</a></li>
      </ul>
    </div>
    


            <ul class="icons">
                <li><a href="#" class="icon brands style2 fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="#" class="icon brands style2 fa-facebook-f"><span class="label">Facebook</span></a></li>
                <li><a href="https://www.instagram.com/ig2na/" class="icon brands style2 fa-instagram"><span class="label">Instagram</span></a></li>
                <li><a href="#" class="icon brands style2 fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
                <li><a href="#" class="icon style2 fa-envelope"><span class="label">Email</span></a></li>
            </ul>
        </div>
    </footer>

</div>