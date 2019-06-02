<?php

namespace Laravel\adminModels\zapisi;

use Illuminate\Database\Eloquent\Model;

class sql_logger extends Model
{
        public $table = 'ibm.sql_logger';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
}
