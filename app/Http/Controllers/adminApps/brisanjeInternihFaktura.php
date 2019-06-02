<?php

namespace Laravel\Http\Controllers\adminApps;

use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;

class brisanjeInternihFaktura extends Controller
{
    public function brisanjeInternihFakturaIndex()
    {
      
        return view('cmat/brisanje_internih_faktura');      
    
    }
     public function obrisiInternuFakturu(request $request)
    {

    	try{
//
    		$brojFakture = $request->brojFakture;
    		$orgjed = $request->orgjed;
    		$now = Carbon::now();
    		$year = $now->year;

    		// $period = CarbonPeriod::create('$year-01-01', '2018-01-15');
    		echo $year;
    	    $neklasifikova = DB::select("
					
					SELECT cmat.b_obrisi_fakt('$orgjed','$year','$brojFakture');

							");
    	
    	   	
    	      }
      catch(QueryException $ex){
         // do task when error
         //echo $e->getMessage();   // insert query
          echo $ex->getMessage(); 
      }
      
  	
    }
}
