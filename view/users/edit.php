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
            <form class="contact100-form validate-form" method="POST" action = "./index.php?controller=users&action=edit">
                <span class="contact100-form-title">
                    Perfil  Deportista
                </span>

                <div class="wrap-input100 validate-input">
                    <span class="label-input100"></span>
                    <input class="input100" type="text" name="username" value="<?= $user->getUsername() ?>">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input">
                    <span class="label-input100"></span>
                    <input class="input100" type="password" name="passwd" placeholder = "*****" value="">
                    <span class="focus-input100"></span>
                </div>
                <?php if($user->getRol()== "DEPORTISTA"){ ?>
                <div class="wrap-input100">
                    <span class="label-input100"></span>
                    <input class="input100" type="text" name="nombre" value="<?= $user->getNombre() ?>">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100">
                    <span class="label-input100"></span>
                    <input class="input100" type="email" name="email" value="<?= $user->getEmail() ?>">
                    <span class="focus-input100"></span>
                </div>
                <?php } ?>

                <div class="container-login100-form-btn">
                    
                        <button class="login100-form-btn">
                            Send
                        </button>
                    </div>
                </div>
            </form>
    
            <div class="container-login100-form-btn">
                    
                    <button class="login100-form-btn">
                         <a href= "./index.php?controller=users&action=delete">Borrar</a>  
                    </button>
            </div>
                
        </div>
    </div>



    <div id="dropDownSelect1"></div>

