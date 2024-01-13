<?php

namespace PokemonPhp\controladores;

use PokemonPhp\vistas\Detail;
use PokemonPhp\vistas\Home;
use PokemonPhp\vistas\Login;

class ApiController
{


    // PINTA LOGIN
    public static function login()
    {
        Login::view();
    }

    // GESTIONA PETICIONES DE LOGIN
    public static function loginRequest($request, $ip)
    {

        $client = new \GuzzleHttp\Client();

        $token = "";

        try {
            $response = $client->request('POST', 'http://' . $ip . ':3000/api/login', [
                'headers' => [
                    'accept' => 'application/json',
                ],
                'form_params' => $request
            ]);

            $responseObject = json_decode($response->getBody());

            $token = $responseObject->token;
        } catch (\Throwable $th) {
        }


        if ($token) {
            $_SESSION['token'] = $token;

            header('Location: ./index.php');
            die;
        } else {
            Login::view();
        }
    }

    // GESTIONA PETICIONES DE REGISTRO
    public static function registerRequest($request, $ip)
    {
        $client = new \GuzzleHttp\Client();

        $token = "";

        try {
            $response = $client->request('POST', 'http://' . $ip . ':3000/api/register', [
                'headers' => [
                    'accept' => 'application/json',
                ],
                'form_params' => $request
            ]);

            $responseObject = json_decode($response->getBody());

            $token = $responseObject->token;
        } catch (\Throwable $th) {
        }


        if ($token) {
            $_SESSION['token'] = $token;

            header('Location: ./index.php');
            die;
        } else {
            Login::view();
        }
    }


    //PINTA TODOS LOS POKEMON EN LA VISTA PRINCIPAL
    public static function vistaPrincipal($ip)
    {
        $client = new \GuzzleHttp\Client();

        $pokemons = "";

        try {
            $response = $client->request('GET', 'http://' . $ip . ':3000/api/pokemon', [
                'headers' => [
                    'Authorization' => $_SESSION["token"],
                ],
            ]);

            $pokemons = json_decode($response->getBody());
        } catch (\Throwable $th) {
        }

        Home::view($pokemons);
    }

    // CIERRA SESION
    public static function logout()
    {
        session_destroy();

        ApiController::login();
    }

    //PINTA LOS POKEMONS DEL TIPO PASADO
    public static function groupBy($type, $ip)
    {
        $client = new \GuzzleHttp\Client();

        $pokemons = "";
        $response = "";

        try {
            $response = $client->request('GET', 'http://' . $ip . ':3000/api/pokemon/tipo/' . $type, [
                'headers' => [
                    'Authorization' => $_SESSION["token"],
                ],
            ]);

            $response = json_decode($response->getBody());

            if (isset($response[0])) {
                $pokemons = $response[0]->elementos;
            }
        } catch (\Throwable $th) {
        }

        Home::view($pokemons);
    }

    //PINTA LOS POKEMONS QUE COINCIDEN CON EL NOMBRE
    public static function searchByName($name, $ip)
    {
        $client = new \GuzzleHttp\Client();

        $pokemons = "";

        try {
            $response = $client->request('GET', 'http://' . $ip . ':3000/api/pokemon/buscar/' . $name, [
                'headers' => [
                    'Authorization' => $_SESSION["token"],
                ],
            ]);

            $pokemons = json_decode($response->getBody());
        } catch (\Throwable $th) {
        }

        Home::view($pokemons);
    }

    public static function details($id, $ip)
    {
        $client = new \GuzzleHttp\Client();

        $pokemon = "";

        try {
            $response = $client->request('GET', 'http://' . $ip . ':3000/api/pokemon/' . $id, [
                'headers' => [
                    'Authorization' => $_SESSION["token"],
                ],
            ]);

            $pokemon = json_decode($response->getBody());
        } catch (\Throwable $th) {
        }

        Detail::view($pokemon);
    }
}
