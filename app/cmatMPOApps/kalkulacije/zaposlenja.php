<?php

namespace Laravel\cmatMPOApps\kalkulacije;

use Illuminate\Database\Eloquent\Model;

class zaposlenja extends Model
{
       public $table = 'cmat.zaposlenja';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
}
