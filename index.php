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
$ip = "54.89.25.137";

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

var_dump($_SESSION);
