<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table      = 'menus';
    protected $primaryKey = 'codMenu';
    protected $fillable   = ['nomMenu', 'ordMenu', 'icoMenu'];
}
