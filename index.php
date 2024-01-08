<?php

//$uri = "https://www.googleapis.com/books/v1/volumes?q=".urlencode($_GET['titulo']); 
$uri = "http://44.201.151.176:3000/api/pokemon/659c52eeb4bbf5d725db836e";
$reqPrefs['http']['method'] = 'GET';
$reqPrefs['http']['header'] = 'Authorization:eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY1OWM1MThlYjRiYmY1ZDcyNWRiODM2YiIsImVtYWlsIjoibWlxb3RhMkBnbWFpbC5jb20iLCJpYXQiOjE3MDQ3NDMzMTAsImV4cCI6MTcwNDgyOTcxMH0.sUyX3YVhzY9OEngJdE0QSNb4EuFV8FroISRl7fmt4I8';
$stream_context = stream_context_create($reqPrefs);
$resultado = file_get_contents($uri, false, $stream_context);

//Pasar de json a objeto php y recorrer los resultados
if ($resultado != false) {
    $respPHP = json_decode($resultado);

    var_dump($respPHP);
}
