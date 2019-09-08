<?php

namespace Laravel\adminModels;

use Illuminate\Database\Eloquent\Model;

class wp_web_meni_grupe extends Model
{
      public $table = 'wp.web_meni_grupe';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
    public $tabelaBezSeme = 'web_meni_grupe';
    public $samoSema = 'wp';

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
