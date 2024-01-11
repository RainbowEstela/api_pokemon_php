<?php

namespace PokemonPhp\controladores;

use PokemonPhp\vistas\Home;
use PokemonPhp\vistas\Login;

class ApiController
{


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

    public static function logout()
    {
        session_destroy();

        ApiController::login();
    }
}
