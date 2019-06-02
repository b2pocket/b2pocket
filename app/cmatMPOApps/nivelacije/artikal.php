<?php

namespace Laravel\cmatMPOApps\nivelacije;

use Illuminate\Database\Eloquent\Model;

class artikal extends Model
{
     public $table = 'cmat.artikal';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
}
