<?php

namespace Laravel\Http\Controllers\cmatMPO;

use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Laravel\cmatMPOApps\nivelacije\nivelacijeZalglavljeModel as zaglavlje;
use Exception;
use DB;

class nivelacijeZaglavljeController extends Controller
{
     public function nivelacijeZaglavljeIndex()
    {
      
        return view('cmatMPO/nivelacijeZaglavlje');      
    
    }
     public function nivelacijeZaglavljeSpisak()
    {

    	$users = DB::table('cmat.nivelacije_zaglavlje')
            ->join('cmat.objekti', 'cmat.objekti.orgjed', '=', 'cmat.nivelacije_zaglavlje.orgjed')
            // ->join('cmat.objekti', 'cmat.objekti.orgjed', '=', 'cmat.nivelacije.orgjed')
            
            ->select('cmat.nivelacije_zaglavlje.*', 'cmat.objekti.nazobj')->orderBy('id','desc')
            ->get();

//print_r(\Auth::user()->id) ;

    	// $meniji = DB::raw('select n.*,ar.naziv as naziv_artikla from cmat.artikal ar, cmat.nivelacije n 
					// where ar.sifra = n.artikal_sifra');

    		// $andr = new zaglavlje;
    	 // $meniji = zaglavlje::orderBy('id', 'DESC')->get();

      //      $broj = count($meniji);
      //           if ($broj < 1){
      //               return '{
      //               "sEcho": 1,
      //               "iTotalRecords": "0",
      //               "iTotalDisplayRecords": "0",
      //               "aaData": []
      //           }';
      //           } 
      //           else 
      //           {
                    return json_encode($users);
             //   }

    	 
  	
    }
      public function nivelacijeZaglavljePoslednji()
    {

      $users = DB::table('cmat.nivelacije_zaglavlje')
            ->join('cmat.objekti', 'cmat.objekti.orgjed', '=', 'cmat.nivelacije_zaglavlje.orgjed')
            // ->join('cmat.objekti', 'cmat.objekti.orgjed', '=', 'cmat.nivelacije.orgjed')
             ->where('id', DB::raw("(select max(id) from cmat.nivelacije_zaglavlje)"))
            ->select('cmat.nivelacije_zaglavlje.*', 'cmat.objekti.nazobj')->orderBy('id','desc')
            ->get();

                    return json_encode($users);
        

       
    
    }
     public function nivelacijeZaglavljeUnos(request $request)
	    {
	        try{ 
	        $obj = new zaglavlje;  
	        $obj->id = DB::raw("nextval('cmat.seq_nivelacije_zaglavlje')");   
	        $obj ->datum = $request->datum;
	        $obj ->sis_datum = DB::raw("current_timestamp");
	  		$obj ->korisnik = \Auth::user()->id;
            $obj ->orgjed = $request->orgjed; 
	        
	        $obj->save();


	        }
	    catch(Exception $e){
	       // do task when error
	       echo $e->getMessage();   // insert query
	    }
	    
	       //return $request->korisnik;
	    }
	     public function nivelacijeZaglavljeBrisanje(request $request)
        {
            try{ 

                 $res=zaglavlje::where('id',$request->pretraga)->delete();

            }
        catch(Exception $e){
           // do task when error
           echo $e->getMessage();   // insert query
        }
        
           //return $request->korisnik;
        }
}
