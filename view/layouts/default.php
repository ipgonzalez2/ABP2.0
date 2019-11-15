<?php
//file: view/layouts/default.php

$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");

?>
<!DOCTYPE html>
<html>

<head>
	<title><?=$view->getVariable("title", "no title")?></title>
	<meta charset="utf-8">
	<link href="css/all.css" rel="stylesheet">
	<!--load all styles -->
	<link href="css/fontawesome.css" rel="stylesheet">
	<link href="css/brands.css" rel="stylesheet">
	<link href="css/solid.css" rel="stylesheet">

	<link rel="stylesheet" href="./css/magnific-popup.css" type="text/css">

	<link rel="stylesheet" href="./css/owl.carousel.min.css" type="text/css">

	<link rel="stylesheet" href="./css/slicknav.min.css" type="text/css">

	<link rel="stylesheet" href="./css/main.css" type="text/css">
	<link rel="stylesheet" href="./css/header.css" type="text/css">
	<link href="styles/kendo.common.min.css" rel="stylesheet" type="text/css" />
	<link href="styles/kendo.default.min.css" rel="stylesheet" type="text/css" />
	<!-- enable ji18n() javascript function to translate inside your scripts -->


	<script src="js/jquery.min.js"></script>
	<script src="js/kendo.web.min.js"></script>

	<script src="index.php?controller=language&amp;action=i18njs">
	</script>
	<?=$view->getFragment("css")?>
	<?=$view->getFragment("javascript")?>
</head>

<body>


	<!-- header -->
	<header class="header-section">
		<div class="nav-switch">
			<i class="fa fa-bars"></i>
		</div>
		<div class="header-social">
        <a href=""><i class="fa fa-calendar-alt"></i></a>
        <a href="./index.php?controller=partidos&action=showallPartidosInscrito"><i class="fa fa-table-tennis"></i></a>
        <a href=""><i class="fa fa-medal"></i></a>
        <a href="./index.php?controller=users&action=notificaciones"><i class="fa fa-envelope"></i></a>
        <a href="./index.php?controller=users&action=edit"><i class="fas fa-user"></i></i></a>
        <a href="./index.php?controller=users&action=logout"><i class="fas fa-sign-out-alt"></i></a>
    </div>
	</header>

	<main>
		<div id="flash">
			<?=$view->popFlash()?>
		</div>

		<?=$view->getFragment(ViewManager::DEFAULT_FRAGMENT)?>
	</main>

	<footer>
		<footer>
			<p>Posted by: Nacho Quintas</p>
			<p>Helpled by: Ines Prieto</p>
			<p>Jorge no hagas nada :)</a>.</p>
		</footer>
	</footer>

</body>

</html>