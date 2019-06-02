<?php

namespace Laravel\cmatMPOApps\nivelacije;

use Illuminate\Database\Eloquent\Model;

class nivelacijeZalglavljeModel extends Model
{
         public $table = 'cmat.nivelacije_zaglavlje';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
}
