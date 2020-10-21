<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroDetalle extends Model
{
    use HasFactory;

    protected $table="DETREGISTRO";

    protected $primaryKey ='COD_DETREG';

    public $timestamps = false;

    protected $fillable =[
        'COD_DETREG','COD_REG','PROD_DETREG'
    ];

    public function registro()
    {
        return $this->belongsTo('App\Model\Registro', 'COD_REG', 'COD_REG');
    }
}
