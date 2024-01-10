<?php

namespace PokemonPhp\controladores;

use PokemonPhp\vistas\Login;

class ApiController
{


    public static function login()
    {
        Login::view();
    }

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
}
