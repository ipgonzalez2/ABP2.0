<?php
//file: view/layouts/default.php

$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
$userRol = $view->getVariable("userRol");

?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="utf-8">



    <link href="css/all.css" rel="stylesheet">
	<!--load all styles -->
	<link href="css/fontawesome.css" rel="stylesheet">
	<link href="css/brands.css" rel="stylesheet">
	<link href="css/solid.css" rel="stylesheet">

	<link rel="stylesheet" href="./css/magnific-popup.css" type="text/css">

	<link rel="stylesheet" href="./css/owl.carousel.min.css" type="text/css">

	<link rel="stylesheet" href="./css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="./css/header.css" type="text/css">
	<link rel="stylesheet" href="./css/calendar.css" type="text/css">

	<link rel="stylesheet" href="./css/main.css" type="text/css">
	<link rel="stylesheet" href="./css/mainForms.css" type="text/css">

	<link rel="stylesheet" href="./css/mainTable.css" type="text/css">
	<link rel="stylesheet" href="./css/style.css" type="text/css">
	<link rel="stylesheet" href="./css/v4-shims.css" type="text/css">

	<!-- POPUP	 -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<script src="js/jquery.min.js"></script> <!-- Modernizr -->

</style>
</head>
<body>
	<!-- header -->
	<header class="header-section">
	<div class="nav-switch">
			<a href="javascript:history.back()">
			<i class="fas fa-angle-double-left"></i>
		</div>
		<div class="header-social">
        <?php if($userRol=="administrador"){?>
        <a href="./index.php?controller=reservas&action=showallReservasActivas"><i class="fa fa-calendar-alt"></i></a>
        <a href="./index.php?controller=partidos&action=showallPartidos"><i class="fa fa-table-tennis"></i></a>
        <a href="./index.php?controller=campeonatos&action=showallCampeonatos"><i class="fa fa-medal"></i></a>
        <a href="./index.php?controller=users&action=edit"><i class="fas fa-user"></i></i></a>
		<a href="./index.php?controller=users&action=logout"><i class="fas fa-sign-out-alt"></i></a>
		<?php }else{ ?>
		<a href="./index.php?controller=reservas&action=showallReservasActivas"><i class="fa fa-calendar-alt"></i></a>
        <a href="./index.php?controller=partidos&action=showallPartidosInscrito"><i class="fa fa-table-tennis"></i></a>
        <a href="./index.php?controller=campeonatos&action=showallCampeonatosInscrito"><i class="fa fa-medal"></i></a>
        <a href="./index.php?controller=users&action=notificaciones"><i class="fa fa-envelope"></i></a>
        <a href="./index.php?controller=users&action=edit"><i class="fas fa-user"></i></i></a>
		<a href="./index.php?controller=users&action=logout"><i class="fas fa-sign-out-alt"></i></a>
		<?php } ?>
    </div>
	</header>

	<main>
		<div id="flash">
			<?=$view->popFlash()?>
		</div>

		<?=$view->getFragment(ViewManager::DEFAULT_FRAGMENT)?>
	</main>


</body>

</html>