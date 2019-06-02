<?php

namespace Laravel\cmatMPOApps\nivelacije;

use Illuminate\Database\Eloquent\Model;

class nivelacije extends Model
{
        public $table = 'cmat.nivelacije';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
}
