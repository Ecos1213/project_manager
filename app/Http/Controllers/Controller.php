<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}

/*

Tinker es una consola de comandos única de Laravel donde podremos hacer pruebas funcionamiento sin tener que ejecutar toda la aplicación e interactuar con los métodos y clases de nuestro proyecto. En este caso, solo verificaremos que estamos conectados a la base de datos.

Para iniciar la consola de Tinker debemos estar ubicados en la carpeta del proyecto desde la consola de comandos e ingresar: php artisan tinker.

A continuación, debe salirte un mensaje en azul que diga algo como:

Psy Shell v0.9.12 (PHP 7.1.33 — cli) by Justin Hileman

>>>
Allí ya estarás listo para escribir: DB::connection()->getPdo();.

Si la conexión es exitosa, te desplegará un objeto tipo PDO con la descripción de los atributos que componen la conexión, si la conexión es errónea, te saldrá un mensaje en rojo mostrándote cuál será el código de error.

Para salir de Tinker sólo tendrás que escribir exit y enter.

En caso que hayas hecho varios intentos con cambios y no los veas reflejados ¡no entres en pánico!, siempre puedes limpiar caché para que las variables de entorno sean leídas nuevamente: php artisan cache:clear.

Y ahora debes volver a ingresar a Tinker y repetir el anterior comando. Tinker no se actualiza automáticamente cuando a variables de entorno se refiere así que es importante ejecutar este comando primero.
*/
