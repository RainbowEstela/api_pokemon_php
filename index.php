<?php

namespace PokemonPhp;

use PokemonPhp\controladores\ApiController;

session_start();
//session_destroy();


require_once './vendor/autoload.php';
//Autocargar las clases --------------------------
spl_autoload_register(function ($class) {
    //echo substr($class, strpos($class,"\\")+1);
    $ruta = substr($class, strpos($class, "\\") + 1);
    $ruta = str_replace("\\", "/", $ruta);
    include_once "./" . $ruta . ".php";
});

//ip de aws
$ip = "34.201.116.250";

//comprobar si hay un token en la sesion
if (!isset($_SESSION["token"])) {

    if (isset($_REQUEST["accion"])) {

        //comprobar acciones de login y registro
        if (strcmp($_REQUEST["accion"], "loginForm") == 0) {
            $body = $_REQUEST;

            ApiController::loginRequest($body, $ip);
            die;
        }

        if (strcmp($_REQUEST["accion"], "registerForm") == 0) {
            $body = $_REQUEST;

            ApiController::registerRequest($body, $ip);
            die;
        }
    }

    ApiController::login();
    die;
}

//manejar las peticiones de pokemons

if (isset($_REQUEST["accion"])) {
    if (strcmp($_REQUEST["accion"], "home") == 0) {
        ApiController::vistaPrincipal($ip);
    }

    if (strcmp($_REQUEST["accion"], "logout") == 0) {
        ApiController::logout();
    }
} else {
    ApiController::vistaPrincipal($ip);
}
