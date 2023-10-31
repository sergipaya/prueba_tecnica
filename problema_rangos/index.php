<?php
$numeros = "1 8 3 5 6 2 11 12";

function ordenarRangos(string $numeros) {
    // Eliminamos posibles espacios al inicio o al final y separamos y ordenamos el string.
    trim($numeros);
    $numeros = explode(" ", $numeros);
    sort($numeros);
    $output = [];
    $inicio = $numeros[0];
    $fin = $numeros[0];

    // Con el primer número fijado ya como inicial y final, comprobaremos que los siguientes sean contiguos
    // En caso positivo avanzaremos de posición nuestro número final
    // En caso negativo añadiremos la serie a output.
    // Si inicio y fin son iguales no agregaremos ninguna línea separatoria.
    for ($i = 1; $i < count($numeros); $i ++) {
        if ($numeros[$i] - 1 == $numeros[$i - 1]) {
            $fin = $numeros[$i];
        } else {
            $inicio == $fin ? array_push($output, $inicio) : array_push($output, $inicio . "-" . $fin);
            $inicio = $numeros[$i];
            $fin = $numeros[$i];
        };
    };

    // Añadimos la última serie o número que quedó por insertar y juntamos output con comas.
    $inicio == $fin ? array_push($output, $inicio) : array_push($output, $inicio . "-" . $fin);

    return join(", ", $output);
};

echo(ordenarRangos($numeros));
?>