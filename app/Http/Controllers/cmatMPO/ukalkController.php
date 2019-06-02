<?php

namespace Laravel\Http\Controllers\cmatMPO;

use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;
use Exception;
use DB;
use Illuminate\Database\Eloquent\Model;
use Laravel\cmatMPOApps\kalkulacije\ukalk as ukalk;
use Laravel\cmatMPOApps\kalkulacije\kalk as kalk;
use Laravel\cmatMPOApps\partneri as partneri;
use Laravel\cmatMPOApps\nivelacije\artikal as artikal;

class ukalkController extends Controller
{
     public function ukalkIndex()
    {
      
        return view('cmatMPO/ukalk');      
    
    }
     public function ukalkSpisak()
    {
      try{ 

    	$users = DB::table('cmat.ukalk_portal')
            ->join('cmat.objekti', 'cmat.objekti.orgjed', '=', 'cmat.ukalk_portal.orgjed')->where('cmat.ukalk_portal.orgjed',\Auth::user()->orgjed)
            ->select('cmat.ukalk_portal.*', 'cmat.objekti.nazobj')->orderBy('cmat.ukalk_portal.brkalk','desc')
            ->get();

                    return json_encode($users);

    	     }
      catch(Exception $e){
         // do task when error
         echo $e->getMessage();   // insert query
      }
  	
    }
     public function kalkSpisak(Request $request)
    {

    	$users = DB::table('cmat.kalk_portal')
            ->join('cmat.objekti', 'cmat.objekti.orgjed', '=', 'cmat.kalk_portal.orgjed')->where('cmat.kalk_portal.brkalk',$request->broj)
            ->select('cmat.kalk_portal.*', 'cmat.objekti.nazobj')->orderBy('cmat.kalk_portal.datum_preuzimanja','asc')
            ->get();

                    return json_encode($users);

    	 
  	
    }
    public function ukalkUnos(request $request)
      {



          try{ 

              $andr = new partneri;
              $partner = $andr::where('sifkup','=',$request->dobav)->get()->first();
              //$partner->first();
              // print_r($partner);
              // print_r($partner->nazkup1);
              //echo $partner->value('nazkup1');
              
          $obj = new ukalk;  
          $obj->brkalk = DB::raw("nextval('cmat.seq_ukalk_portal')");   
          //$obj->orgjed = $request->orgjed;
              $obj->orgjed = \Auth::user()->orgjed;
          $obj->dobav = $request->dobav;
          $obj->nazdob = $partner->nazkup1;

          $obj->mesdob = $partner->meskup;
          $obj->brdok = $request->brdok;
          $obj->datdok = $request->datdok;
          $obj->datkal = $request->datkal;
          //$obj->pdv = $request->pdv;
          //$obj->zapla = $request->zapla;
          $obj->datval = $request->datval;
          $obj->datum_preuzimanja = DB::raw("current_timestamp");
          $obj ->korisnik = \Auth::user()->id;
          $obj->godina_baze = DB::raw("extract(year from current_date)");
          //  $obj ->godina_baze = $request->orgjed; 
          
          $obj->save();


          }
      catch(Exception $e){
         // do task when error
         echo $e->getMessage();   // insert query
      }
      
         //return $request->korisnik;
      }
      public function kalkUnos(request $request)
      {



          try{ 

              $andr = new artikal;
              $partner = $andr::where('sifra',$request->sifart)->get()->first();

              $pcen_bez_ruc = round($request->prodcen / (1+($request->porez/100)),2); 
              $rucp = round((100*($pcen_bez_ruc - $request->fakcen))/$request->fakcen,2);              
          $obj = new kalk;  
          $obj->brkalk = $request->brkalk;
          $obj->orgjed = $request->orgjed;
          $obj->porez = $request->porez;
          $obj->prodcen = $request->prodcen;
          $obj->fakcen = $request->fakcen;
          $obj->kolicina = $request->kolicina;
          $obj->sifart = $request->sifart;
          $obj->jmere = $partner->jmere;
          $obj->broj_racuna = $request->poziv_na_broj;
        
          $obj->nazart = $partner->naziv;
          $obj->prodcen_bez_pdv =  $pcen_bez_ruc;
          $obj->rucp =  $rucp;
          $obj->datum_preuzimanja = DB::raw("current_timestamp");
          $obj->godina_baze = DB::raw("extract(year from current_date)");
          
          $obj->save();


          }
      catch(Exception $e){
         // do task when error
         echo $e->getMessage();   // insert query
      }
      
         //return $request->korisnik;
      }
       public function kalkulacijaBrisanje(request $request)
        {
            try{ 

                 $res=kalk::where('brkalk',$request->kalk)->where('sifart',$request->artikal)->delete();

            }
        catch(Exception $e){
           // do task when error
           echo $e->getMessage();   // insert query
        }
        
           //return $request->korisnik;
        }
}
