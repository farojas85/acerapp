<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $table="alumno";

    protected $primaryKey ='COD_A';

    public $timestamps = false;

    protected $fillable =[
        'COD_A', 'CODE_A','DNI_A','PSW_A','APP_A','APM_A','NOM_A',
        'CEL_A','ESC_A','DIR_A','DIS_A'
    ];

    public function registros()
    {
        return $this->hasMany('App\Models\Registro', 'COD_A', 'COD_A');
    }
}
