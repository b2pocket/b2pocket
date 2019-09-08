<?php

namespace Laravel\adminModels;

use Illuminate\Database\Eloquent\Model;

class helena_setovanje extends Model
{
      public $table = 'sis.helena_setovanje';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
    public $tabelaBezSeme = 'helena_setovanje';
    public $samoSema = 'sis';

    function nazivTabele()
        {
             return helena_setovanje::$table;
        }
        function nazivTabeleBezSeme()
        {
             return helena_setovanje::$tabelaBezSeme;
        }
        function nazivSeme()
        {
             return helena_setovanje::$samoSema;
        }
}


