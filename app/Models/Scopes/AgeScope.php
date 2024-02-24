<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AgeScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {

        /**Otra de las posibilidades que tenemos con los modelos es que podemos definir el alcance de las operaciones que realicemos con los modelos a través de los Scopes.

        Esto quiere decir que podemos restringir la cantidad o los valores que nuestro modelo retornará a una condición específica. Un caso de uso para los Query Scopes sería, por ejemplo, si quisiéramos restringir la consulta de datos a solo los que tengan el project_id mayor a 100, esto quiere decir que aún si se consultan todos los registros de la tabla projects a través del modelo Project, se le listarán todos los proyectos con project_id mayor a 100 y los 100 primeros no aparecerán aún cuando estén activos y existentes en la tabla.

        Por supuesto, son más los aspectos en los cuales los podemos usar, pero también dependerá de ciertas condiciones que nos de el proyecto en el cual estemos trabajando. */

        // para crear un scope se necesita el siguiente comando php artisan make:scope AgeScope y creara una carpeta dentro de models con el scope creado que es AgeScope


        // Este ejemplo se implementaría llamando este Scope en nuestro controlador, su función apply recibe dos parámetros, el primero es el builder o la sentencia que escribimos para ejecutar acciones (el código que usamos para realizar acciones sin usar SQL) y luego el modelo, lo que hará este método será agregarle a la sentencia del builder la condición de que la edad sea mayor a 200 (para efectos de este ejemplo).
        $builder->where('age', '>', 200);
    }

    // para usar el global scope necesitamos implementar la siguiente funcion en el modelo donde dentro de la funcion estatica addGlobalScope como parametro lleva el nombre de el scope que creamos
    /**
     * protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new SoftDeletedScope);
    }
     *
     *
     * para ver el local scope mira dentro del modelo
     */
}
