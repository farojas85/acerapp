<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $table="registro";

    protected $primaryKey ='COD_REG';

    public $timestamps = false;

    protected $fillable =[
        'COD_REG', 'COD_USR','COD_A','REG_REG','FECHA_REG','HORA_REG'
    ];

    public function alumno()
    {
        return $this->belongsTo('App\Models\Alumno', 'COD_A', 'COD_A');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','COD_USR','COD_USR');
    }

    public function registro_detalles()
    {
        return $this->hasMany('App\Models\RegistroDetalle', 'COD_REG', 'COD_REG');
    }
}
