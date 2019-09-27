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
use Laravel\Traits\BindsDynamically;

class rgController extends Controller
{
      use BindsDynamically;
  
     public function rgIndex()
    {
       $firme =  DB::select("
        select pg_sema as id,naziv from sis.firme

            ");
      
        return view('cmatMPO/rgArtikal',compact('firme'));      
    
    }
     public function artikliSpisak(request $request)
    {	
    	$param = $request->filter;
      $sema = $request->sema;
    	if ($param == 'SVI'){
    		$zaposlenja = DB::table("$sema.artikal")
    	 ->join("$sema.robnegrupe", "$sema.artikal.robnagrupa", "=", "$sema.robnegrupe.sifra")->where("$sema.artikal.robnagrupa","<>","-1")
    	  
    	    ->select("$sema.artikal.*", "$sema.robnegrupe.naziv as rg_naziv")
    	    ->get();

    	}
    	else {
    	$zaposlenja = DB::table("$sema.artikal")
    	 ->join("$sema.robnegrupe", "$sema.artikal.robnagrupa", "=", "$sema.robnegrupe.sifra")->where("$sema.artikal.robnagrupa",$param)
    	  
    	    ->select("$sema.artikal.*", "$sema.robnegrupe.naziv as rg_naziv")
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
            $artikalModel = new artikal;
            $artikalModel->setTable($request->sema.'.artikal');
           // print_r($artikalModel);
            $artikalModel->where('sifra','=',$request->sifra)
            ->update(['robnagrupa'=>$request->robGrupa]);

          }
      catch(Exception $e){
         // do task when error
         echo $e->getMessage();   // insert query
      }
      
         //return $request->korisnik;
      }
      public function robneGrupeSpisak(request $request)
    {
            
            $andr = new robnegrupe_view;
            $apps = $andr::all();
            $rg =  DB::select("  
                select * from {$request->sema}.v_rg4
              ");
             return json_encode($rg);
    
    }
}
