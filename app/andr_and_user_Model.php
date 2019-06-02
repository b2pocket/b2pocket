<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;

class andr_and_user_Model extends Model
{
     public $table = 'andr.and_user';
    //  polja su: sifra_klase,konto
    public $timestamps = false;
    //protected $primaryKey = null;
    protected $primaryKey = 'korisnik';
    public $incrementing = false;
}
