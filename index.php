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
$ip = "34.203.188.111";

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
    // ACCION HOME
    if (strcmp($_REQUEST["accion"], "home") == 0) {
        ApiController::vistaPrincipal($ip);
    }

    // ACCION LOGOUT
    if (strcmp($_REQUEST["accion"], "logout") == 0) {
        ApiController::logout();
    }

    // ACCION GROUP BY TIPO
    if (strcmp($_REQUEST["accion"], "group") == 0) {
        $type = $_REQUEST["tipo"];
        ApiController::groupBy($type, $ip);
    }

    // ACCION SEARCH BY NAME
    if (strcmp($_REQUEST["accion"], "namesearch") == 0) {
        $name = $_REQUEST["name"];

        ApiController::searchByName($name, $ip);
    }

    // ACCION VER DETALLES
    if (strcmp($_REQUEST["accion"], "details") == 0) {
        $id = $_REQUEST["id"];

        ApiController::details($id, $ip);
    }
} else {
    ApiController::vistaPrincipal($ip);
}
