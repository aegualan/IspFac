<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table = 'contratos';
    protected $primaryKey = 'codContrato';
    public $incrementing  = false;
    protected $keyType    = 'string';
    public $timestamps    = false;
}
