<?php

namespace Laravel\Http\Controllers\adminApps;

use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\QueryException;
use Carbon\Carbon;


class brisanjeKalkulacija extends Controller
{
    public function brisanjeKalkulacijaIndex()
    {
      
        return view('cmat/brisanje_kalkulacija');      
    
    }
     public function obrisiKalkulacije(request $request)
    {

    	try{
//
    		$brojKalkulacije = $request->brojKalkulacije;
    		$orgjed = $request->orgjed;
    		$now = Carbon::now();
    		$year = $now->year;

    		// $period = CarbonPeriod::create('$year-01-01', '2018-01-15');
    		echo $year;
    	    $neklasifikova = DB::select("
					
					SELECT cmat.b_obrisi_kalk('$orgjed','$year','$brojKalkulacije');

							");
    	
    	   	
    	      }
      catch(QueryException $ex){
         // do task when error
         //echo $e->getMessage();   // insert query
          echo $ex->getMessage(); 
      }
      
  	
    }
}
