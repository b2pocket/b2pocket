<?php

namespace Laravel\cmat;

use Illuminate\Database\Eloquent\Model;

class and_aplikacija extends Model
{
    //
     public $table = 'andr.and_aplikacija';
    //  polja su: sifra_klase,konto
    public $timestamps = false;
    protected $primaryKey = null;
    //protected $primaryKey = 'korisnik';
    public $incrementing = false;
}
