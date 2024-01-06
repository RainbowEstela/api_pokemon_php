<?php

//$uri = "https://www.googleapis.com/books/v1/volumes?q=".urlencode($_GET['titulo']); 
$uri = "http://172.18.0.0:3000/api/pokemon/65991a41a2105aa8ce8358b7";
$reqPrefs['http']['method'] = 'GET';
$reqPrefs['http']['header'] = 'X-Auth-Token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY1OTkxOWQzYTIxMDVhYThjZTgzNThiNCIsImVtYWlsIjoibWlxb3RhMkBnbWFpbC5jb20iLCJpYXQiOjE3MDQ1MzI0MzUsImV4cCI6MTcwNDYxODgzNX0.8wPZRUcC54JaJS6Ezlwjt34ZKctjCKePzKuF2E35Efc';
$stream_context = stream_context_create($reqPrefs);
$resultado = file_get_contents($uri, false, $stream_context);

//Pasar de json a objeto php y recorrer los resultados
if ($resultado != false) {
    $respPHP = json_decode($resultado);

    var_dump($respPHP);
}
