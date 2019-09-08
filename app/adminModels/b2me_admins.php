<?php

namespace Laravel\adminModels;

use Illuminate\Database\Eloquent\Model;

class b2me_admins extends Model
{
      public $table = 'sis.b2me_admins';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
    public $tabelaBezSeme = 'b2me_admins';
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


