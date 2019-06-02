<?php

namespace Laravel\Http\Controllers\cmatMPO;

use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;

use Exception;
use DB;
use Illuminate\Database\Eloquent\Model;

use Laravel\cmatMPOApps\nivelacije\artikal as artikal;
use Laravel\cmatMPOApps\robnegrupe as robnegrupe;
use Laravel\cmatMPOApps\robnegrupe_view as robnegrupe_view;

class rgController extends Controller
{
     public function rgIndex()
    {
      
        return view('cmatMPO/rgArtikal');      
    
    }
     public function artikliSpisak(request $request)
    {	
    	$param = $request->filter;
    	if ($param == 'SVI'){
    		$zaposlenja = DB::table('cmat.artikal')
    	 ->join('cmat.robnegrupe', 'cmat.artikal.robnagrupa', '=', 'cmat.robnegrupe.sifra')->where('cmat.artikal.robnagrupa','<>','-1')
    	  
    	    ->select('cmat.artikal.*', 'cmat.robnegrupe.naziv as rg_naziv')
    	    ->get();

    	}
    	else {
    	$zaposlenja = DB::table('cmat.artikal')
    	 ->join('cmat.robnegrupe', 'cmat.artikal.robnagrupa', '=', 'cmat.robnegrupe.sifra')->where('cmat.artikal.robnagrupa',$param)
    	  
    	    ->select('cmat.artikal.*', 'cmat.robnegrupe.naziv as rg_naziv')
    	    ->get();
    	}


      //	$zaposlenja = zaposlenja::all();
        return json_encode($zaposlenja);      
    
    }
       public function artikalVeza(request $request)
      {



          try{ 

            // $andUser = artikal::find($request->post('SIFRA'));
            // echo $request->robGrupa;

            //    $izmena = 
            artikal::where('sifra','=',$request->sifra)
            ->update(['robnagrupa'=>$request->robGrupa]);

          }
      catch(Exception $e){
         // do task when error
         echo $e->getMessage();   // insert query
      }
      
         //return $request->korisnik;
      }
      public function robneGrupeSpisak()
    {
            
            $andr = new robnegrupe_view;
            $apps = $andr::all();

             return json_encode($apps);
    
    }
}
