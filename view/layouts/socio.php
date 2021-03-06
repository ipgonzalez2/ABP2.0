<?php

$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
$userRol = $view->getVariable("userRol");

?>
<!DOCTYPE html>
<html>

<head>
	<title><?= $view->getVariable("title", "no title") ?></title>
	<meta charset="utf-8">
	<link href="css/all.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="css/util.css">

	<!--load all styles -->
	<link href="css/fontawesome.css" rel="stylesheet">
	<link href="css/brands.css" rel="stylesheet">
	<link href="css/solid.css" rel="stylesheet">



    
	<link rel="stylesheet" href="./css/style.css" type="text/css">
	<link rel="stylesheet" href="./css/mainTable.css" type="text/css">
	<link rel="stylesheet" href="./css/magnific-popup.css" type="text/css">

	<link rel="stylesheet" href="./css/owl.carousel.min.css" type="text/css">

	<link rel="stylesheet" href="./css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="./css/header.css" type="text/css">

	<link rel="stylesheet" href="./css/tarjeta.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/socio.css">

	<script src="js/jquery.min.js"></script> <!-- Modernizr -->


	<?= $view->getFragment("css") ?>
	<?= $view->getFragment("javascript") ?>
</head>

<body>

<!-- header -->
<header class="header-section">
	<div class="nav-switch">
	<a href="./index.php?"> <img src="images/logo.png"  width="70" height="60"></a>
  	 </i>
	
		</div>
		<div class="header-social">
        <?php if($userRol=="administrador"){?>
        <a href="./index.php?controller=reservas&action=showallReservasActivas"><i class="fa fa-calendar-alt"></i></a>
        <a href="./index.php?controller=partidos&action=showallPartidos"><i class="fa fa-table-tennis"></i></a>
        <a href="./index.php?controller=campeonatos&action=showallCampeonatos"><i class="fa fa-medal"></i></a>
        <a href="./index.php?controller=users&action=edit"><i class="fas fa-user"></i></i></a>
		<a href="./index.php?controller=users&action=logout"><i class="fas fa-sign-out-alt"></i></a>
		<?php }else if($userRol=="deportista"){ ?>
		<a href="./index.php?controller=reservas&action=showallReservasActivas"><i class="fa fa-calendar-alt"></i></a>
        <a href="./index.php?controller=partidos&action=showallPartidosInscrito"><i class="fa fa-table-tennis"></i></a>
        <a href="./index.php?controller=campeonatos&action=showallCampeonatosInscrito"><i class="fa fa-medal"></i></a>
        <a href="./index.php?controller=clases&action=showallClases"><i class="fa fa-chalkboard-teacher"></i></a>
		<a href="./index.php?controller=users&action=notificaciones"><i class="fa fa-envelope"></i></a>
        <a href="./index.php?controller=users&action=edit"><i class="fas fa-user"></i></i></a>
		<a href="./index.php?controller=users&action=logout"><i class="fas fa-sign-out-alt"></i></a>
		<?php }else{ ?>
			<a href="./index.php?controller=clases&action=showallSolicitudes"><i class="fa fa-chalkboard-teacher"></i></a>
			<a href="./index.php?controller=users&action=edit"><i class="fas fa-user"></i></i></a>
		<a href="./index.php?controller=users&action=logout"><i class="fas fa-sign-out-alt"></i></a>
		<?php } ?>
		

		
    </div>
	</header>

	<main style="padding-top: 5%;">
		<div id="flash">
			<?=$view->popFlash()?>
		</div>

		<?=$view->getFragment(ViewManager::DEFAULT_FRAGMENT)?>
	</main>

	<footer>

	</footer>
</body>

</html>


</html>