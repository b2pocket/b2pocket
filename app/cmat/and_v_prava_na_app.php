<?php

namespace Laravel\cmat;

use Illuminate\Database\Eloquent\Model;

class and_v_prava_na_app extends Model
{
        public $table = 'andr.and_prava_na_app';
    //  polja su: sifra_klase,konto
    public $timestamps = false;
    protected $primaryKey = null;
    //protected $primaryKey = 'korisnik';
    public $incrementing = false;
}
