<?php
//file: view/users/register.php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Edit");

$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
?>

<div class="container-contact100">

    <div class="wrap-contact100">
        <form class="contact100-form validate-form" method="POST" action="./index.php?controller=users&action=edit">
            <span class="contact100-form-title">
                Perfil Deportista
            </span>

            
            <div class="wrap-input100 validate-input">
                <input class="input100" type="text" name="username" value="<?= $user->getUsername() ?>">
            </div>

            <div class="wrap-input100 validate-input">
                <input class="input100" type="password" name="passwd" placeholder="*****" value="">
            </div>
            <?php if ($user->getRol() == "deportista") { ?>
                <div class="wrap-input100">
                    <input class="input100" type="text" name="nombre" value="<?= $user->getNombre() ?>">
                </div>

                <div class="wrap-input100">
                    <input class="input100" type="email" name="email" value="<?= $user->getEmail() ?>">
                </div>
            <?php } ?>

            <div class="container-contact100-form-btn">

                <button class="contact100-form-btn">
                    Guardar
                </button>

                <button class="contact100-form-btn">
                <a style="text-decoration:none;font-family: Ubuntu-Bold;font-size: 16px;color: #fff;line-height: 1.2;text-transform: uppercase;" href="./index.php?controller=users&amp;action=delete">Borrar</a></button>
            </div>

        </form>

    </div>
</div>



<div id="dropDownSelect1"></div>