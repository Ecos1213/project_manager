<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    //protected $connection = 'connection-name'; // Cuando necesitas configurar una conexión específica para un modelo en Laravel, puedes utilizar la propiedad $connection en el modelo y establecerla como protegida (protected). La variable $connection te permite especificar el nombre de la conexión que deseas usar para ese modelo en particular. La opción correcta, por lo tanto, es la que menciona protected $connection = 'connection-name';.
    protected $table = 'projects';
    protected $primaryKey = 'project_id';
    public $timestamps = false; //Un detalle interesante es que Eloquent asume que tu tabla tiene los campos created_at y updated_at, así que cada vez que se inserte un valor o se modifique, buscará estos campos para asignarle los valores correspondientes, si no los tienes y no se lo indicas en el modelo, te puede generar un error o simplemente no guardar tus registros, es por eso que debes desactivarlos si no vas a contar con ellos de manera física en la base de datos.
    protected $fillable = [
        "city_id",
        "company_id",
        "user_id",
        "name",
        "execution_date",
        "is_active"
    ];

    //Podemos tener Scopes locales, este lo agregamos en forma de una función dentro del modelo y lo anexamos directamente a la consulta cuando se vaya a realizar, por ejemplo:
    public function scopeActive($query) {
        return $query->where('is_active', 1);
    }

    // Si implementamos esta función y la llamamos en ProjectController justo cuando estamos haciendo una consulta de datos, nos agregará por debajo la condición de que sólo traerá registros cuyo valor en el campo is_active sea igual a 1.

    // La forma de implementarlo sería la siguiente:
    // Project::active()->get(); // como vemos se llama active que es esta misma funcion scopeActive pero lo que hace laravel es simplificar el nombre de scopeActive a active esto se tiene que usar dentro del controlador no dentro del modelo

    // Puedes usar Global Scope o Local Scope dependiendo de tu necesidad, yo te recomendaría que lo hagas cuando sea necesario y de manera local (o sea, dentro del modelo), de esta forma tendrás un control más personalizado del ámbito en el cual controlas tus datos.
}




/**
 *
 * Durante todo el curso hemos estado haciendo transacciones a la base de datos sin escribir ninguna línea de código SQL sobre nuestro ProjectController, hemos estado utilizando una sintaxis que construye las consultas, las inserciones, actualizaciones y eliminación de una manera más limpia y eficaz.

Esto es query builder, una interfaz que nos ofrece Laravel para escribir queries a la base de datos de una mejor forma y, por supuesto, también más seguro, pues nos protege de posibles ataques de SQL injection.

Este es el siguiente nivel de lo que deberías aprender en este camino con Laravel, estas son algunas de las sentencias más usadas con las que te encontrarás usando este “constructor de sentencias”:

Si no usas un modelo para acceder a la base de datos, con query builder igual puedes acceder directamente a una tabla (no es lo más recomendable), lo harías de esta forma:

DB::table('projects')->get();

El método get() será el que nos traiga la información en la mayoría de los casos, pero no es el único.

Podemos pedir solo el primer resultado de las condiciones de una búsqueda de esta forma:

DB::table('projects')->where('name', 'test')->first()

Existe también la forma de consultar directamente por la llave primaria de la tabla pasándola inmediatamente al método find():

DB::table('projects')->find(10);

También tienes la opción de traer solo una columna de una tabla:

DB::table('projects')->pluck('name');

Realmente son muchas las acciones que puedes realizar para “traducir” lo que harías con SQL en query builder, tienes todo lo que necesitas para que no tengas que volver a escribir código plano en tus consultas o sentencias.

Echa un vistazo a la documentación oficial, allí podrás encontrar todo lo que puedes hacer y cómo construir sentencias más óptimas, elegantes y seguras en Laravel.
 *
 */
