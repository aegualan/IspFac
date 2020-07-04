<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table      = 'personas';
    protected $primaryKey = 'codPersona';
    public $incrementing  = false;
    protected $keyType    = 'string';
    public $timestamps    = false;
    protected $fillable   = ['codPersona', 'apePersona', 'nomPersona', 'celPersona', 'telPersona', 'emaPersona', 'codRol'];
}
