<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;

class neklasifikovana_konta_bu_Model extends Model
{
     public $table = 'gk.neklasifikovana_konta_bu';
    //  polja su: sifra_klase,konto
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
}
