<?php

namespace Laravel\adminModels;

use Illuminate\Database\Eloquent\Model;
 use Laravel\Traits\BindsDynamically;
class gk_racia extends Model
{
  use BindsDynamically;
     // public $table = 'gk.racia';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
    public $tabelaBezSeme = 'racia';
    public $samoSema = 'gk';


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
