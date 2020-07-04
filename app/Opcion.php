<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opcion extends Model
{
    protected $table      = 'opciones';
    protected $primaryKey = "codOpcion";
    protected $fillable   = ['nomOpcion', 'urlWeb', 'urlAPP', 'ordOpcion', 'codMenu'];
}
