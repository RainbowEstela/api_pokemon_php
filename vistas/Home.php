<?php

namespace PokemonPhp\vistas;

class Home
{
    public static function view($pokemons)
    {
        include_once("./vistas/header.php");
        include_once("./vistas/navBar.php");
?>






        <!-- FILTROS -->
        <div class="flex gap-8 justify-center items-center">

            <!-- TIPOS -->
            <div>

                <form method="POST" action="index.php">

                    <div class="flex gap-2">
                        <select id="tipo" name="tipo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                            <option value="acero">Acero</option>
                            <option value="agua">Agua</option>
                            <option value="bicho">Bicho</option>
                            <option value="dragon">Dragon</option>
                            <option value="electrico">Eléctrico</option>
                            <option value="fantasma">Fantasma</option>
                            <option value="fuego">Fuego</option>
                            <option value="hada">Hada</option>
                            <option value="hielo">Hielo</option>
                            <option value="lucha">Lucha</option>
                            <option value="normal">Normal</option>
                            <option value="planta">Planta</option>
                            <option value="psiquico">Psíquico</option>
                            <option value="roca">Roca</option>
                            <option value="siniestro">Siniestro</option>
                            <option value="tierra">Tierra</option>
                            <option value="volador">Volador</option>
                        </select>
                        <button type="submit" name="accion" value="group" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Buscar</button>

                    </div>
                </form>
            </div>
            <!-- FIN TIPOS -->

            <!-- NOMBRE -->
            <div>

                <form action="./index.php" method="POST">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Pikachu</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" name="name" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="pikachu" required>
                        <button type="submit" name="accion" value="namesearch" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Buscar</button>
                    </div>
                </form>

            </div>
            <!-- FIN NOMBRE -->
        </div>
        <!-- FIN FILTROS -->


<?php
        echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 justify-items-center gap-4 p-8">';
        if ($pokemons) {
            foreach ($pokemons as $pokemon) {
                echo '


<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">

    <img class="rounded-t-lg" src="' . $pokemon->imagen . '" alt="' . $pokemon->nombre . '.png" />
    <div class="p-5">
        
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">' . $pokemon->nombre . '</h5>
        
    
                <p class="mb-3 font-normal text-gray-900">especie:<span class="text-blue-600"> ' . $pokemon->especie . '</span></p>
        <a href="./index.php?accion=details&id=' . $pokemon->_id . '" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            detalles    
             <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </a>
    </div>
</div>


';
            }
        }
        echo '</div>';
        include_once("./vistas/footer.php");
    }
}
