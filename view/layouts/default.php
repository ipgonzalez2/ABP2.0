<?php
//file: view/layouts/default.php

$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
$userRol = $view->getVariable("userRol");

?>
<!DOCTYPE html>
<html>

<head>
	<title><?=$view->getVariable("title", "no title")?></title>
	<meta charset="utf-8">
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
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- enable ji18n() javascript function to translate inside your scripts -->
	<link rel="canonical" href="https://html5up.net/story">
	<script src="https://apis.google.com/_/scs/apps-static/_/js/k=oz.gapi.es.xhypXBFw-YI.O/m=auth/exm=plusone/rt=j/sv=1/d=1/ed=1/am=wQE/rs=AGLTcCNIYS8P8MA2BPqaol3qYCZ18OvnqA/cb=gapi.loaded_1" async=""></script>


	<script src="https://apis.google.com/_/scs/apps-static/_/js/k=oz.gapi.es.xhypXBFw-YI.O/m=plusone/rt=j/sv=1/d=1/ed=1/am=wQE/rs=AGLTcCNIYS8P8MA2BPqaol3qYCZ18OvnqA/cb=gapi.loaded_0" async=""></script>

	<script src="https://connect.facebook.net/en_US/sdk.js?hash=f26ad3eae2197b8988f4c18e71a52410&amp;ua=modern_es6" async="" crossorigin="anonymous"></script>

	<script type="text/javascript" async="" src="https://apis.google.com/js/plusone.js" gapi_processed="true"></script>

	<script id="facebook-jssdk" src="//connect.facebook.net/en_US/sdk.js#xfbml=1&amp;version=v2.0"></script>

	<script src="js/jquery.min.js"></script>
	<link href="css/all.css" rel="stylesheet">

	<script src="index.php?controller=language&amp;action=i18njs">


<script src="js/jquery.min.js"></script>
			<script src="js/jquery.scrollex.min.js"></script>
			<script src="js/jquery.scrolly.min.js"></script>
			<script src="js/browser.min.js"></script>
			<script src="js/breakpoints.min.js"></script>
			<script src="js/util.js"></script>
			<script src="js/main.js"></script>
	</script>
	<?=$view->getFragment("css")?>
	<?=$view->getFragment("javascript")?>
</head>

<body>


	<!-- header -->
	<header class="header-section">
	<div class="nav-switch">
	<a href="./index.php?"><i class="fa fa-cannabis"></i></a>
			<a href="javascript:history.back()">
			<i class="fas fa-angle-double-left"></i></a>
			

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


	<footer>
		
	</footer>

</body>

</html>