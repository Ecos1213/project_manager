<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    //     'password' => 'hashed',
    // ];

    /*
    Como lo vimos en la clase anterior, podemos jugar un poco con la forma de nuestro modelo para ejercer cierto control sobre la tabla a la cual estamos apuntando.

    Una de las acciones que podemos realizar es darle valores por defecto a ciertos atributos de la tabla y, de esta manera, cuando se inserten o se modifiquen datos que impliquen el uso de los campos especificados, se guardarán con el valor por defecto que hayamos especificado previamente.

    Para indicar el valor por defecto debemos definir un array de atributos a los cuales le asignaremos un valor de la siguiente manera:
    */

    // protected $attributes = [
    //     'name' => 'hola',
    // ];

    protected $table = 'users';
    // protected $keyType = 'string'; //En caso de que la llave primaria no sea un entero y estés controlando el auto incremento, debes especificar el tipo de dato
    // public $incrementing = false; //Si quieres controlar el auto incremento de la llave primaria puedes controlarlo desde aquí utilizando
    public $timestamps = false; //Un detalle interesante es que Eloquent asume que tu tabla tiene los campos created_at y updated_at, así que cada vez que se inserte un valor o se modifique, buscará estos campos para asignarle los valores correspondientes, si no los tienes y no se lo indicas en el modelo, te puede generar un error o simplemente no guardar tus registros, es por eso que debes desactivarlos si no vas a contar con ellos de manera física en la base de datos.
    // const CREATED_AT = 'creation_date'; //En cambio, si tienes estos valores con otro nombre puedes personalizarlos y referenciarlos al inicio de la clase y de esta forma ya te los tomaría:
    // const UPDATED_AT = 'last_update';
    // protected $connection = 'connection-name'; //Es posible que tengas varias conexiones a bases de datos, pero Eloquent tomará la que tienes definida por defecto, si por alguna razón deseas que este modelo se conecte a otra base de datos (y ya tienes configurada esa conexión), puedes indicarle a cuál apuntar
    protected $primaryKey = 'user_id';
    protected $fillable = [
        "name"
    ];
}
