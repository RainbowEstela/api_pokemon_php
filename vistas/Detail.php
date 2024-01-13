<?php

namespace PokemonPhp\vistas;

class Detail
{
    public static function view($pokemon)
    {
        include_once("./vistas/header.php");
        include_once("./vistas/navBar.php");
?>
        <div class=" lg:flex gap-4 p-4">
            <div class="flex justify-center">
                <img class="max-w-96" src="<?= $pokemon->imagen; ?>" alt="<?= $pokemon->nombre; ?>.png">
            </div>
            <div class="bg-blue-50 w-full rounded-lg border-4 border-slate-950">
                <div class="bg-red-600 rounded-t p-4 border-b-4 border-slate-950">
                    <h3 class=" text-4xl text-slate-950 font-semibold text-center"><?= $pokemon->nombre ?></h3>
                </div>
                <div class="grid justify-items-center gap-4 p-4 border-b-4 border-slate-50 text-2xl">
                    <p>Tipo:
                        <span class="text-blue-600">
                            <?php
                            foreach ($pokemon->tipo as $tipo) {
                                echo $tipo . " ";
                            }
                            ?>
                        </span>
                    </p>
                </div>
                <div class="grid grid-cols-2 justify-items-center gap-4 p-4 border-b-4 border-slate-50 text-lg">
                    <p>especie: <span class="text-blue-600"><?= $pokemon->especie ?></span></p>
                    <p>vida: <span class="text-blue-600"> <?= $pokemon->vida ?> ps</span></p>
                    <p>altura: <span class="text-blue-600"><?= $pokemon->altura ?> cm</span></p>
                    <p>peso: <span class="text-blue-600"><?= $pokemon->peso ?> kg</span></p>
                </div>

                <?php
                if (isset($pokemon->preevolucion) || isset($pokemon->evolucion)) {


                    echo '<div class="grid grid-cols-2 justify-items-center gap-4 p-4 border-b-4 border-slate-50 text-lg">';

                    if (isset($pokemon->preevolucion)) {
                        echo '<p>pre-evolucion: <span class="text-blue-600">' . $pokemon->preevolucion . '</span></p>';
                    }

                    if (isset($pokemon->evolucion)) {
                        echo '<p>evolucion: <span class="text-blue-600">' . $pokemon->evolucion . '</span></p>';
                    }


                    echo '</div>';
                }
                echo '<div class="grid grid-cols-2 justify-items-center gap-4 p-4 text-lg">';
                foreach ($pokemon->habilidades as $habilidad) {
                    echo '<div class="bg-blue-500 p-2 rounded" >';
                    echo '  <p>ataque: <span class="text-blue-50">' . $habilidad->nombre . '</span></p>';
                    echo '  <p>potencia: <span class="text-blue-50">' . $habilidad->damage . '</span></p>';
                    echo '</div>';
                }

                echo '</div>';
                ?>




            </div>
        </div>







<?php

        include_once("./vistas/footer.php");
    }
}
