<?php
//file: view/users/register.php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Edit");

$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
?>

<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100">
			<table>
            <tr>
            <th> <?= $user->getUsername() ?></th>
            </tr>
            </table>

				<div class="container-login100-form-btn">
				<a href = "./index.php?controller=users&action=delete">
							Borrar
				</a>
				</div>
				

			

			<div class="login100-more" style="background-image: url('/images/banadas.jpeg');">
			</div>
		</div>
	</div>
</div>