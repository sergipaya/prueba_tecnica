# prueba_tecnica
Información sobre los ejercicios.

## Problema Rangos
Este ejercicio está simplemente aplicado en el código, cambiar el array de números con
otras series para probar y ejecutar para ver las soluciones.

## Problema POO
Este ejercicio está hecho con docker, ejecutar el siguiente comando para verlo en
localhost.

`docker-compose up -d`

## Problema UI
Este ejercicio está implementado con mysql para generar la base de datos.
Ejecutar symfony y una BBDD MySQL como XAMPP.

Para iniciar symfony y podes acceder a localhost:8000:

`symfony server:start`

En otro terminal, para crear la BBDD:

`php bin/console doctrine:database:create`

Para ejecutar las migraciones:

`php bin/console doctrine:migrations:migrate`

Para rellenar la base de datos con los usuarios de
las fixtures:

`php bin/console doctrine:fixtures:load `
