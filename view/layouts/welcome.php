<?php
// file: view/layouts/welcome.php

$view = ViewManager::getInstance();

?>
<!DOCTYPE html>
<html>

<head>
	<title><?= $view->getVariable("title", "no title") ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./css/style.css" type="text/css">

	<link rel="stylesheet" href="./css/styleLogin.css" type="text/css">
	<link href="css/all.css" rel="stylesheet">
	<!--load all styles -->
	<link href="css/fontawesome.css" rel="stylesheet">
	<link href="css/brands.css" rel="stylesheet">
	<link href="css/solid.css" rel="stylesheet">


	<?= $view->getFragment("css") ?>
	<?= $view->getFragment("javascript") ?>
</head>

<body>
	<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
</body>

</html>