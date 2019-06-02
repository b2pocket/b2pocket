<?php

namespace Laravel\Http\Controllers\cmatMPO;

use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;
use Exception;
use DB;
use Illuminate\Database\Eloquent\Model;

use Laravel\cmatMPOApps\kalkulacije\kadrovi as kadrovi;


class kadroviController extends Controller
{
     public function kadroviIndex()
    {
      
        return view('cmatMPO/kadrovi');      
    
    }
       public function kadroviSpisak()
    {	
    	
      	$kadrovi = kadrovi::orderBy('ime')->get();
        return json_encode($kadrovi);      
    
    }
     public function kadroviUnos(request $request)
      {



          try{ 

             // $andr = new partneri;
             // $partner = $andr::where('sifkup','=',$request->dobav)->get()->first();
   
              
          $obj = new kadrovi;  
          $obj->id = DB::raw("nextval('cmat.seq_kadrovi')");   
          //$obj->orgjed = $request->orgjed;
            //  $obj->orgjed = \Auth::user()->orgjed;
          $obj->prezime = strtoupper($request->prezime);
          $obj->ime = strtoupper($request->ime);
          $obj->pol = $request->pol;
          $obj->jmbg = $request->jmbg;
          $obj->datumrodjenja = $request->datumrodjenja;
          $obj->telefon = $request->telefon;

          // $obj->mesdob = $partner->meskup;
          // $obj->brdok = $request->brdok;
          // $obj->datdok = $request->datdok;
          // $obj->datkal = $request->datkal;
          // $obj->datval = $request->datval;
          // $obj->datum_preuzimanja = DB::raw("current_timestamp");
          // $obj ->korisnik = \Auth::user()->id;
          // $obj->godina_baze = DB::raw("extract(year from current_date)");

          
          $obj->save();


          }
      catch(Exception $e){
         // do task when error
         echo $e->getMessage();   // insert query
      }
      
         //return $request->korisnik;
      }
}
