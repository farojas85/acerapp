<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $table="REGISTRO";

    protected $primaryKey ='COD_REG';

    public $timestamps = false;

    protected $fillable =[
        'COD_REG', 'COD_USR','COD_A','REG_REG','FECHA_REG','HORA_REG'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','COD_USR','id');
    }

    public function registro_detalles()
    {
        return $this->hasMany('App\Model\ResgistroDetalle', 'COD_REG', 'COD_REG');
    }
}
