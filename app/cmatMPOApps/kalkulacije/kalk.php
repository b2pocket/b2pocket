<?php

namespace Laravel\cmatMPOApps\kalkulacije;

use Illuminate\Database\Eloquent\Model;

class kalk extends Model
{
     public $table = 'cmat.kalk_portal';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
}
