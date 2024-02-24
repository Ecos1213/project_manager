<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use App\Models\Project;
use App\Models\User;
use Faker\Factory as Faker;

class ProjectController extends Controller
{
    //
    public function getAllProjects() {
        // $projects = Project::all();
        // $projects = Project::where('is_active', 0)
        //         ->orderBy('name', 'asc')
        //         ->take(2)
        //         ->get();
        $projects = Project::orderBy('project_id', 'desc')->take(10)->get();
        return $projects;

        /*Project::chunk(200, function ($projects) {
            foreach ($projects as $project) {
                //Aquí escribimos lo que haremos con los datos (operar, modificar, etc)
            }

            En la clase anterior aprendimos a usar el modelo Project para traer datos de la tabla projects de una manera bastante simple, ahora imagina que esta tabla creció en registros y ahora se tarda mucho tiempo trayendo, por ejemplo, 900 registros, el rendimiento de la aplicación baja, se puede morir el servidor y ya no logramos tener todos los datos.

            Para evitar este problema tenemos un comando que nos va a traer los registros por secciones, este es chunk, al cual le pediremos un bloque menor de registros y fragmentará la cantidad de valores hasta tenerlos todos.

            Esto lo logramos implementando un Closure que procesará los datos en los bloques que van llegando.

            Esto lo podemos leer de la siguiente manera:

            Traer del modelo Project (que traduce a la tabla projects) bloques de 200 registros y guardarlos temporalmente en la variable $projects como un array, luego recorre este array con los 200 registros y por cada uno ejecuta lo que está dentro del foreach, repite esta acción hasta que lleguen todos los registros de Project.
        });*/



        /*
        Cuando vimos cómo implementar los modelos para hacer uso de la información utilizamos un controlador llamado ProjectController, desde donde escribimos las funciones y hacemos el llamado del modelo Project para hacer toda la consulta. Pero existe la posibilidad de que, por alguna razón, el modelo se haya movido o tenga un error, esto automáticamente nos dañaría el flujo de trabajo de la consulta y no tendríamos cómo capturarlo de forma inmediata.

        Para esto tenemos dos métodos que nos ayudan a manejar una excepción. En caso de no encontrar el modelo, nos retornarán un objeto de tipo ModelNotFoundException y podemos operar con él en caso de error.

        findOrFail 🔍
        $project = Project::findOrFail(1); //Esto nos retornaría en la variable $project el registro cuyo id (project_id) sea igual 1, en caso de no encontrar el modelo Project, retornará un error que también quedará en la variable $project.

        $project = Project::where('is_active', '=', 1)->firstOrFail(); //Este método es bastante similar al anterior, sin embargo, este nos retornará el primer resultado que coincida con la condición que le pedimos, pero también nos retornará una excepción de no encontrar el modelo Project.
        //  En este ejemplo tendríamos una petición que traería el primer registro de proyectos cuyo campo is_active sea 1, si no encuentra el modelo, nos devuelve una excepción sin romperse.

        //Ten en cuenta que si no capturas la excepción, se enviará un error 404 al usuario y ahí sí se rompería tu flujo de trabajo.
        */
    }


    public function insertProject() {
        //Lo primero que hacemos es crear una instancia del modelo Project y lo almacenamos en una variable, de ahí tomamos esa misma variable e indicamos cada campo de la tabla y le asignamos el valor que va a guardar. Finalmente, le indicamos la acción, que en este caso será save() para guardar.
        $project = new Project;
        $project->city_id = 1;
        $project->company_id = 1;
        $project->user_id = 1;
        $project->name = 'Nombre del proyecto';
        $project->execution_date = '2020-04-30';
        $project->is_active = 1;
        $project->save();

        return "Guardado";
    }

    /*
    //Recuerda que no siempre vamos a guardar los registros de esta forma estática y, por lo general, vendrán de algún formulario o una fuente que nos dirá cuáles serán los valores de los registros, en ese caso, tendríamos que asignar $request pero la estructura se mantendría exactamente igual:
    public function insertProject(Request $request) {
        $project = new Project;
        $project->city_id = $request->cityId;
        $project->company_id = $request->companyId;
        $project->user_id = $request->userId;
        $project->name = $request->name;
        $project->execution_date = $request->executionDate;
        $project->is_active = $request->isActive;
        $project->save();
    }

    */

    public function insertThirteenProject() {
        $faker = Faker::create();
        // $fecha = $faker->dateTimeBetween($startDate = $fechaInicio, $endDate = $fechaFin)->format('Y-m-d'); //fecha formateada entre una fecha especifa a otra
        for($i=0; $i < 30; $i++) {
            Project::create([
                "city_id" => $faker->numberBetween(1,31),
                "company_id" => $faker->numberBetween(1,31),
                "user_id" => $faker->numberBetween(1,31),
                "name" => $faker->unique()->text(20),
                "execution_date" => $faker->date('Y-m-d'),
                "is_active" => $faker->numberBetween(0,1)
            ]);
        }
        return "guardado";
    }

    public function insertThirteenCity() {
        $faker = Faker::create();
        for($i=0; $i < 30; $i++) {
            City::create([
                "name" => $faker->unique()->city
            ]);
        }
        return "guardado";
    }

    public function insertThirteenCompany() {
        $faker = Faker::create();
        for($i=0; $i < 30; $i++) {
            Company::create([
                "name" => $faker->unique()->text(20)
            ]);
        }
        return "guardado";
    }

    public function insertThirteenUser() {
        $faker = Faker::create();
        for($i=0; $i < 30; $i++) {
            User::create([
                "name" => $faker->unique()->text(20)
            ]);
        }
        return "guardado";
    }

    public function updateProject() {
        $project = Project::find(2); //En esta función estamos buscando primero el proyecto con project_id igual a 2 y luego le asignamos un nuevo nombre Proyecto de tecnología, la llave primaria ya la configuramos al principio cuando creamos el modelo, por eso ahora no necesitamos indicarle más que el valor y ya la encontrará usando el método find().
        $project->name = 'Proyecto de tecnología';
        $project->save();

        //Podemos actualizar registros en bloques que cumplan condiciones específicas de acuerdo a sus campos en la base de datos, por ejemplo, si quisiéramos actualizar la fecha de ejecución de todos los proyectos que estén activos y que además tengan el id de ciudad igual a 4, tendríamos algo así:
        Project::where('is_active', 1)
        ->where('city_id', 4)
        ->update(['execution_date' => '2020-02-03']);

        Project::where('is_active', 0)
        ->update(['name' => 'Tecnologia Obsoleta']);

        return "Actualizado";
    }

    public function deleteProject() {
        // $project = Project::find(1);
        // $project->delete();
        // Contamos realmente con varias formas de realizar esta acción, otra aún más simple es donde usamos el método destroy() (cuando tenemos la llave primaria de los registros que vamos a eliminar directamente) y lo podemos implementar de la siguiente manera:
        // Project::destroy(1);
        // Project::destroy(1, 2, 3);
        // Project::destroy([1, 2, 3]);
        // Pero, aún así, tenemos otra opción para eliminar registros basado en múltiples condiciones en caso de que no tengamos un id o que deseemos eliminar un grupo de registros específicos:
        // Project::where('is_active', 0)->delete();
        $project = Project::where('project_id', '>', 15)->delete();
        return "Registros eliminados";

    }
}
