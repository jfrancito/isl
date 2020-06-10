<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WEBTrabajador extends Model
{
    protected $table = 'WEB.trabajadores';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';


}
