<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model {

    protected $table = 'facturas';
    protected $primaryKey = 'codFactura';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

}
