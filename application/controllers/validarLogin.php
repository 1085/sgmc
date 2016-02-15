<?php

session_start();
require_once '../controllers/ControllerPrincipal.class.php';
$controllerPrincipal = new ControllerPrincipal();
$controllerPrincipal->validarLogin();