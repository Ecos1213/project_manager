<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';
    protected $primaryKey = 'city_id';
    public $timestamps = false; //Un detalle interesante es que Eloquent asume que tu tabla tiene los campos created_at y updated_at, así que cada vez que se inserte un valor o se modifique, buscará estos campos para asignarle los valores correspondientes, si no los tienes y no se lo indicas en el modelo, te puede generar un error o simplemente no guardar tus registros, es por eso que debes desactivarlos si no vas a contar con ellos de manera física en la base de datos.
    protected $fillable = [
        "name"
    ];
}
