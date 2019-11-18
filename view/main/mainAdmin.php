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
        <a href="./index.php?controller=reservas&action=showallReservasActivas"><i class="fa fa-calendar-alt"></i></a>
        <a href="./index.php?controller=partidos&action=showallPartidos"><i class="fa fa-table-tennis"></i></a>
        <a href="./index.php?controller=campeonatos&action=showallCampeonatos"><i class="fa fa-medal"></i></a>
        <a href="./index.php?controller=users&action=edit"><i class="fas fa-user"></i></i></a>
        <a href="./index.php?controller=users&action=logout"><i class="fas fa-sign-out-alt"></i></a>
    </div>
</header>


<!-- Wrapper -->
<div id="wrapper" class="divided">

    <!-- One -->
    <section class="banner style1 orient-left content-align-left image-position-right fullscreen onload-image-fade-in onload-content-fade-right">
        <div class="content">
            <h1>PadelBit </h1>
            <p class="major">La mejor web de padel del mundo.</p>
        </div>
        <div class="image">
            <img src="./images/padel6.jpg" alt="" />
        </div>
    </section>

    <!-- Two -->
    <section class="spotlight style1 orient-right content-align-left image-position-center onscroll-image-fade-in" id="first">
        <div class="content">
            <h2>Ver calendario</h2>
            <p>Así podrás ver todos los eventos.</p>
            <ul class="actions stacked">
                <li><a href="./index.php?controller=campeonatos&action=showLigaRegular" class="button">Ver</a></li>
            </ul>
        </div>
        <div class="image">
            <img src="./images/calendar.jpg" alt="" />
        </div>
    </section>

    <!-- Three -->
    <section class="spotlight style1 orient-left content-align-left image-position-center onscroll-image-fade-in">
        <div class="content">
            <h2>Añadir partidos</h2>
            <p></p>
            <ul class="actions stacked">
                <li><a href="./index.php?controller=partidos&action=addPartido" class="button">Añadir</a></li>
            </ul>
        </div>
        <div class="image">
            <img src="./images/partido.jpg" alt="" />
        </div>
    </section>

    <!-- Four -->
    <section class="spotlight style1 orient-right content-align-left image-position-center onscroll-image-fade-in">
        <div class="content">
            <h2>Crear un campeonato</h2>
            <p>Quieres reservar las mejores pista del mundo.</p>
            <ul class="actions stacked">
                <li><a href="./index.php?controller=campeonatos&action=addCampeonato" class="button">Crear</a></li>
            </ul>
        </div>
        <div class="image">
            <img src="./images/icon.jpg" alt="" />
        </div>
    </section>

    <!-- Five -->
    <section class="wrapper style1 align-center">
        <div class="inner">
            <h2>Quiere ver nuestras instalaciones</h2>
            <p>Son las mejores.</p>
        </div>

        <!-- Gallery -->
        <div class="gallery style2 medium lightbox onscroll-fade-in">
            <article>
                <a href="images/gallery/fulls/01.jpg" class="image">
                    <img src="images/gallery/thumbs/01.jpg" alt="" />
                </a>
                <div class="caption">
                    <h3>Pistas</h3>
                    <ul class="actions fixed">
                        <li><span class="button small">Details</span></li>
                    </ul>
                </div>
            </article>
            <article>
                <a href="images/gallery/fulls/02.jpg" class="image">
                    <img src="images/gallery/thumbs/02.jpg" alt="" />
                </a>
                <div class="caption">
                    <h3>Vestuarios</h3>
                    <ul class="actions fixed">
                        <li><span class="button small">Details</span></li>
                    </ul>
                </div>
            </article>
            <article>
                <a href="images/gallery/fulls/03.jpg" class="image">
                    <img src="images/gallery/thumbs/03.jpg" alt="" />
                </a>
                <div class="caption">
                    <h3>Profesores</h3>
                    <ul class="actions fixed">
                        <li><span class="button small">Details</span></li>
                    </ul>
                </div>
            </article>
            <article>
                <a href="images/gallery/fulls/04.jpg" class="image">
                    <img src="images/gallery/thumbs/04.jpg" alt="" />
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

    <!-- Six -->
    <!--<section class="wrapper style1 align-center">
        <div class="inner">
            <h2>Ipsum sed consequat</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id ante sed ex pharetra lacinia sit amet vel massa. Donec facilisis laoreet nulla eu bibendum. Donec ut ex risus. Fusce lorem lectus, pharetra pretium massa et, hendrerit vestibulum
                odio lorem ipsum.</p>
            <div class="items style1 medium onscroll-fade-in">
                <section>
                    <span class="icon style2 major fa-gem"></span>
                    <h3>Lorem</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dui turpis, cursus eget orci amet aliquam congue semper. Etiam eget ultrices risus nec tempor elit.</p>
                </section>
                <section>
                    <span class="icon solid style2 major fa-save"></span>
                    <h3>Ipsum</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dui turpis, cursus eget orci amet aliquam congue semper. Etiam eget ultrices risus nec tempor elit.</p>
                </section>
                <section>
                    <span class="icon solid style2 major fa-chart-bar"></span>
                    <h3>Dolor</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dui turpis, cursus eget orci amet aliquam congue semper. Etiam eget ultrices risus nec tempor elit.</p>
                </section>
                <section>
                    <span class="icon solid style2 major fa-wifi"></span>
                    <h3>Amet</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dui turpis, cursus eget orci amet aliquam congue semper. Etiam eget ultrices risus nec tempor elit.</p>
                </section>
                <section>
                    <span class="icon solid style2 major fa-cog"></span>
                    <h3>Magna</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dui turpis, cursus eget orci amet aliquam congue semper. Etiam eget ultrices risus nec tempor elit.</p>
                </section>
                <section>
                    <span class="icon style2 major fa-paper-plane"></span>
                    <h3>Tempus</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dui turpis, cursus eget orci amet aliquam congue semper. Etiam eget ultrices risus nec tempor elit.</p>
                </section>
                <section>
                    <span class="icon solid style2 major fa-desktop"></span>
                    <h3>Aliquam</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dui turpis, cursus eget orci amet aliquam congue semper. Etiam eget ultrices risus nec tempor elit.</p>
                </section>
                <section>
                    <span class="icon solid style2 major fa-sync-alt"></span>
                    <h3>Elit</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dui turpis, cursus eget orci amet aliquam congue semper. Etiam eget ultrices risus nec tempor elit.</p>
                </section>
                <section>
                    <span class="icon solid style2 major fa-hashtag"></span>
                    <h3>Morbi</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dui turpis, cursus eget orci amet aliquam congue semper. Etiam eget ultrices risus nec tempor elit.</p>
                </section>
                <section>
                    <span class="icon solid style2 major fa-bolt"></span>
                    <h3>Turpis</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dui turpis, cursus eget orci amet aliquam congue semper. Etiam eget ultrices risus nec tempor elit.</p>
                </section>
                <section>
                    <span class="icon solid style2 major fa-envelope"></span>
                    <h3>Ultrices</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dui turpis, cursus eget orci amet aliquam congue semper. Etiam eget ultrices risus nec tempor elit.</p>
                </section>
                <section>
                    <span class="icon solid style2 major fa-leaf"></span>
                    <h3>Risus</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dui turpis, cursus eget orci amet aliquam congue semper. Etiam eget ultrices risus nec tempor elit.</p>
                </section>
            </div>
        </div>
    </section>-->

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
    <!-- Footer -->
    <footer class="wrapper style1 align-center">
        <div class="inner">
		<small class="d-block mb-3 text-muted">&copy; 2016-2020</small>
    </div>
    <div class="col-6 col-md">
      <h5>Mejoras</h5>
      <ul class="list-unstyled text-small">
        <li><a class="text-muted" href="#">Imagenes Bonitas</a></li>
        <li><a class="text-muted" href="#">Implementacion Nuevas Funciones</a></li>
        <li><a class="text-muted" href="https://i.pinimg.com/originals/9f/bd/64/9fbd647f14c399ee80b6050adb761a9e.jpg">Algo mas</a></li>
        <li><a class="text-muted" href="#">Cosas de Informaticos</a></li>
        <li><a class="text-muted" href="https://weather.com/es-ES/tiempo/hoy/l/251cec6a9bb33f4b37d385cc0642b9a63928ded87b33f79e2041fadbbf504070">El tiempo</a></li>
      </ul>

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