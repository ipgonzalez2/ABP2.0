<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
?>


<div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method = "POST" action="./index.php?controller=users&action=login">
                    <span class="login100-form-title p-b-43">
						Login
					</span>

                    <div class="wrap-input100 validate-input" >
                        <input class="input100" type="text" name="username" placeholder="Login">
                        <!--<span class="label-input100">Email</span>-->
                    </div>


                    <div class="wrap-input100 validate-input" >
                        <input class="input100" type="password" name="passwd" placeholder="Contraseña">
                        <!--<span class="label-input100">Password</span>-->
                    </div>

                    <div class="flex-sb-m w-full p-t-3 p-b-32" >
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me" 
                             <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?>>
                            <label class="label-checkbox100" for="ckb1">
								Recordarme
							</label>
                        </div>
	

                        <div>
                            <a href="#" class="txt1">
								Olvidaste Contraseña
							</a>
                        </div>
                    </div>


                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
							Login
						</button>
                    </div>

                    <div class="text-center p-t-46 p-b-20">
                        <span class="txt2">
                        <a href="./index.php?controller=users&action=register" style="text-decoration: none;">
                        o regístrate
                        </a>
							
						</span>
                    </div>

                    <div class="login100-form-social flex-c-m">
                        <a href="/dashboard" class="login100-form-social-item flex-c-m bg1 m-r-5" style="
    text-decoration: none;">
                        <i class="fab fa-facebook"></i></i>
                        </a>

                        <a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5" style="
    text-decoration: none;">
                        <i class="fab fa-twitter"></i></i>
                        </a>
                    </div>
                </form>

                <div class="login100-more" style="background-image: url('./images/padel4.jpg');">
                </div>
            </div>
        </div>
    </div>




