<?php
//file: view/layouts/default.php

$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");

?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dateTimePicker.css">
    
    <link href="css/all.css" rel="stylesheet">
	<!--load all styles -->
	<link href="css/fontawesome.css" rel="stylesheet">
	<link href="css/brands.css" rel="stylesheet">
	<link href="css/solid.css" rel="stylesheet">

	<link rel="stylesheet" href="./css/magnific-popup.css" type="text/css">

	<link rel="stylesheet" href="./css/owl.carousel.min.css" type="text/css">

	<link rel="stylesheet" href="./css/slicknav.min.css" type="text/css">

	<link rel="stylesheet" href="./css/header.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

</head>
<body>
	<!-- header -->
	<header class="header-section">
		<div class="nav-switch">
			<i class="fa fa-bars"></i>
		</div>
		<div class="header-social">
			<a href=""><i class="fa fa-table-tennis"></i></a>
			<a href=""><i class="far fa-calendar-alt"></i></a>
			<a href=""><i class="far fa-futbol"></i></a>
			<a href=""><i class="fas fa-user"></i></i></a>
			<a href="./index.php?contoller=user&action=logout"><i class="fas fa-sign-out-alt"></i></a>
		</div>
	</header>

	<main>
		<div id="flash">
			<?= $view->popFlash() ?>
		</div>

		<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
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