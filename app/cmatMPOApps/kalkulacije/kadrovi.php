<?php

namespace Laravel\cmatMPOApps\kalkulacije;

use Illuminate\Database\Eloquent\Model;

class kadrovi extends Model
{
    public $table = 'cmat.kadrovi';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
}
