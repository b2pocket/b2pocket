<?php

namespace Laravel\Http\Controllers\cmatMPO;

use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;
use Exception;
use DB;
use Illuminate\Database\Eloquent\Model;

use Laravel\cmatMPOApps\kalkulacije\zaposlenja as zaposlenja;
use Laravel\cmatMPOApps\kalkulacije\kadrovi as kadrovi;
use Laravel\cmatMPOApps\nivelacije\objekti as objekti;

class zaposlenjaController extends Controller
{
        public function zaposlenjaIndex()
    {
      
        return view('cmatMPO/zaposlenja');      
    
    }
       public function zaposlenjaSpisak()
    {	
    	$zaposlenja = DB::table('cmat.zaposlenja')
    	 ->join('cmat.kadrovi', 'cmat.zaposlenja.kadroviid', '=', 'cmat.kadrovi.id')
    	  ->join('cmat.objekti', 'cmat.zaposlenja.orgjed', '=', 'cmat.objekti.orgjed')
    	    ->select('cmat.zaposlenja.*', 'cmat.objekti.nazobj', 'cmat.kadrovi.ime','cmat.kadrovi.prezime')
    	    ->get();



      //	$zaposlenja = zaposlenja::all();
        return json_encode($zaposlenja);      
    
    }
     public function zaposlenjaUnos(request $request)
      {



          try{ 

             // $andr = new partneri;
             // $partner = $andr::where('sifkup','=',$request->dobav)->get()->first();
   
              
          $obj = new zaposlenja;  
          $obj->id = DB::raw("nextval('cmat.seq_zaposlenja')");   
          //$obj->orgjed = $request->orgjed;
            //  $obj->orgjed = \Auth::user()->orgjed;
          $obj->kadroviid = $request->kadroviid;
          $obj->datumod = $request->datumod;
          $obj->datumdo = $request->datumdo;
          $obj->orgjed = $request->orgjed;
           $obj->sysdate = DB::raw("current_timestamp");
           $obj ->korisnikuneo = \Auth::user()->id;
         
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
       public function zaposlenjaKadrovi(request $request)
    {
      //['312','265','6120','75','6110']
        
        $andr = new kadrovi;
        $apps = $andr::all();

           return json_encode($apps);
    
    }
    public function zaposlenjaRadnje(request $request)
    {
      //['312','265','6120','75','6110']
        
        $andr = new objekti;
        $apps = $andr::all();

           return json_encode($apps);
    
    }
}
