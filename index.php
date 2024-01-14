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
$ip = "35.153.23.41";

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

    // ACCION SHOW CREATE FORM
    if (strcmp($_REQUEST["accion"], "createForm") == 0) {
        ApiController::createForm();
    }

    // ACCION CREATE POKEMON
    if (strcmp($_REQUEST["accion"], "createPokemon") == 0) {
        $data = [
            "nombre" => $_REQUEST["nombre"],
            "especie" => $_REQUEST["especie"],
            "imagen" => $_REQUEST["imagen"],
            "tipo" => [],
            "evolucion" => null,
            "preevolucion" => null,
            "vida" => intval($_REQUEST["vida"]),
            "altura" => intval($_REQUEST["altura"]),
            "peso" => intval($_REQUEST["peso"]),
            "habilidades" => []
        ];

        array_push($data["tipo"], $_REQUEST["tipo"]);

        if (isset($_REQUEST["subtipo"])) {
            array_push($data["tipo"], $_REQUEST["subtipo"]);
        }

        if ($_REQUEST["evolucion"] != "") {
            $data["evolucion"] = $_REQUEST["evolucion"];
        }

        if ($_REQUEST["preevolucion"] != "") {
            $data["preevolucion"] = $_REQUEST["preevolucion"];
        }

        $attack1 = [
            "nombre" => $_REQUEST["attack1"],
            "damage" => $_REQUEST["damage1"]
        ];
        $attack2 = [
            "nombre" => $_REQUEST["attack2"],
            "damage" => $_REQUEST["damage2"]
        ];
        $attack3 = [
            "nombre" => $_REQUEST["attack3"],
            "damage" => $_REQUEST["damage3"]
        ];
        $attack4 = [
            "nombre" => $_REQUEST["attack4"],
            "damage" => $_REQUEST["damage4"]
        ];

        array_push($data["habilidades"], $attack1);
        array_push($data["habilidades"], $attack2);
        array_push($data["habilidades"], $attack3);
        array_push($data["habilidades"], $attack4);



        ApiController::createPokemon($data, $ip);
    }
} else {
    ApiController::vistaPrincipal($ip);
}
