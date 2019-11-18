<?php
require_once __DIR__ . "/../../core/ViewManager.php";
$view = ViewManager::getInstance();
$view->setVariable("title", "PadelBit");
$errors = $view->getVariable("errors");
?>

<header class="header-section">
    <div class="nav-switch">
    </div>
    <div class="header-social">
        <a href="./index.php?controller=users&action=login"><i class="fas fa-user"></i></i></a>
    </div>
</header>


<!-- Wrapper -->
<div id="wrapper" class="divided">

    <!-- One -->
    <section class="banner style1 orient-left content-align-left image-position-right fullscreen onload-image-fade-in onload-content-fade-right">
        <div class="content">
            <h1>PadelBit</h1>
            <p class="major">La mejor web de padel del mundo.</p>
            <ul class="actions stacked">
                <li><a href="./index.php?controller=users&action=login" class="button big wide smooth-scroll-middle">¿Qué quiere hacer?</a></li>
            </ul>
        </div>
        <div class="image">
            <img src="./images/padel6.jpg" alt="" />
        </div>
    </section>

    <!-- Four -->
    <section class="spotlight style1 orient-right content-align-left image-position-center onscroll-image-fade-in">
        <div class="content">
            <h2>Pistas</h2>
            <p>Quieres reservar las mejores pista del mundo.</p>
            <ul class="actions stacked">
                <li><a href="./index.php?controller=users&action=login" class="button">Adelante 🏓 </a></li>
            </ul>
        </div>
        <div class="image">
            <img src="./images/01.jpg" alt="" />
        </div>
    </section>

     <!-- Four -->
     <section class="spotlight style1 orient-right content-align-left image-position-center onscroll-image-fade-in">

        <div class="image">
            <img src="./images/010.jpg" alt="" />
        </div>
        <div class="content">
            <h2>Calendario</h2>
            <p>Calendario</p>
            <ul class="actions stacked">
                <li><a href="./index.php?controller=users&action=login" class="button">Let´s go! </a></li>
            </ul>
        </div>
    </section>

    <!-- Five -->
    <section class="wrapper style1 align-center">
        <div class="inner">
            <h2>Ven a ver nuestras instalaciones</h2>
            <p>Son las mejores.</p>
        </div>

        <!-- Gallery -->
        <div class="gallery style2 medium lightbox onscroll-fade-in">
            <article>
                <a href="images/01.jpg" class="image">
                    <img src="images/01.jpg" alt="" />
                </a>
                <div class="caption">
                    <h3>Pistas</h3>
                    <ul class="actions fixed">
                        <li><span class="button small">Details</span></li>
                    </ul>
                </div>
            </article>
            <article>
                <a href="images/02.jpg" class="image">
                    <img src="images/02.jpg" alt="" />
                </a>
                <div class="caption">
                    <h3>Vestuarios</h3>
                    <ul class="actions fixed">
                        <li><span class="button small">Details</span></li>
                    </ul>
                </div>
            </article>
            <article>
                <a href="images/03.jpg" class="image">
                    <img src="images/03.jpg" alt="" />
                </a>
                <div class="caption">
                    <h3>Profesores</h3>
                    <ul class="actions fixed">
                        <li><span class="button small">Details</span></li>
                    </ul>
                </div>
            </article>
            <article>
                <a href="images/04.jpg" class="image">
                    <img src="images/04.jpg" alt="" />
                </a>
                <div class="caption">
                    <h3>Bar</h3>
                    <p>Quieres unas copas.</p>
                    <ul class="actions fixed">
                        <li><span class="button small">Details</span></li>
                    </ul>
                </div>
            </article>
            <article>
                <a href="images/gallery/fulls/05.jpg" class="image">
                    <img src="images/gallery/thumbs/05.jpg" alt="" />
                </a>
                <div class="caption">
                    <h3>Servicio de Alquiler</h3>
                    <p>Palas y pelotas.</p>
                    <ul class="actions fixed">
                        <li><span class="button small">Details</span></li>
                    </ul>
                </div>
            </article>
            <article>
                <a href="images/gallery/fulls/06.jpg" class="image">
                    <img src="images/gallery/thumbs/06.jpg" alt="" />
                </a>
                <div class="caption">
                    <h3>Quieres tu posibles colegas</h3>
                    <ul class="actions fixed">
                        <li><span class="button small">Details</span></li>
                    </ul>
                </div>
            </article>

        </div>

    </section>

     <!-- Seven -->
     <section class="wrapper style1 align-center">
        <div class="inner medium">
            <h2>Contactanos 🐒</h2>
            <form method="post" action="#">
                <div class="fields">
                    <div class="field half">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" value="" />
                    </div>
                    <div class="field half">
                        <label for="email">E-mail ✉️</label>
                        <input type="email" name="email" id="email" value="" />
                    </div>
                    <div class="field">
                        <label for="message">Mensaje</label>
                        <textarea name="message" id="message" rows="6"></textarea>
                    </div>
                </div>
                <ul class="actions special">
                    <li><input type="submit" name="submit" id="submit" value="Envia" /></li>
                </ul>
            </form>

        </div>
    </section>

  <!-- Footer -->
  <footer class="wrapper style1 align-center">
        <div class="inner">
		<small class="d-block mb-3 text-muted">&copy; 2016-2020</small>
    </div>
    <div class="col-6 col-md">
      <h5>Horario</h5>
      <ul class="list-unstyled text-small">
        <li><a class="text-muted" href="#">Lunes a viernes : 09:00 -- 21:00</a></li>
        <li><a class="text-muted" href="#">Sabados : 09:00 - 14:00 </br> 18:00 - 21:00</a></li>
        <li><a class="text-muted" href="#">Domingos : 09:00 -- 14:00 </a></li>
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
