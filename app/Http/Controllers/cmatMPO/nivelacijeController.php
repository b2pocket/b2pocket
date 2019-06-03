<?php

namespace Laravel\Http\Controllers\cmatMPO;
 require_once(app_path() . '\Klase\jasper\autoload.dist.php');
use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Laravel\cmatMPOApps\nivelacije\nivelacije as nivelacije;
use Laravel\cmatMPOApps\nivelacije\artikal as artikal;
use Laravel\cmatMPOApps\nivelacije\objekti as objekti;
use Jaspersoft\Client\Client;
use Exception;
use DB;

class nivelacijeController extends Controller
{
     public function nivelacijeIndex()
    {
      
        return view('cmatMPO/nivelacije');      
    
    }
    //->where('cmat.nivelacije.idnivelacije','=',$request->broj)
    public function nivelacijeSpisak(Request $request)
    {
        if ($request->broj == '')
        {
            $test = 0;
        }
        else
        {
            $test = $request->broj;
        }

    	$users = DB::table('cmat.artikal')
            ->join('cmat.nivelacije', 'cmat.artikal.sifra', '=', 'cmat.nivelacije.artikal_sifra')
            ->join('cmat.nivelacije_zaglavlje', 'cmat.nivelacije_zaglavlje.id', '=', 'cmat.nivelacije.idnivelacije')
             ->join('cmat.objekti', 'cmat.objekti.orgjed', '=', 'cmat.nivelacije_zaglavlje.orgjed')
              ->join('ibm.users', 'ibm.users.id', '=', 'cmat.nivelacije_zaglavlje.korisnik')->where('cmat.nivelacije_zaglavlje.id',$request->broj)

            
            ->select('cmat.nivelacije.*', 'cmat.artikal.naziv', 'cmat.objekti.nazobj', 'cmat.nivelacije_zaglavlje.datum','ibm.users.name')
            ->get();
            if (!$users){
                  return '{
                    "sEcho": 1,
                    "iTotalRecords": "0",
                    "iTotalDisplayRecords": "0",
                    "aaData": []
                }';
            }
            else{
                  return json_encode($users);
            }
      

    	// $meniji = DB::raw('select n.*,ar.naziv as naziv_artikla from cmat.artikal ar, cmat.nivelacije n 
					// where ar.sifra = n.artikal_sifra');

    	//	$andr = new nivelacije;
    		//$meniji = nivelacije::orderBy('id', 'DESC')->get();

         /*  $broj = count($meniji);
                if ($broj < 1){
                    return '{
                    "sEcho": 1,
                    "iTotalRecords": "0",
                    "iTotalDisplayRecords": "0",
                    "aaData": []
                }';
                } 
                else 
                {*/
                
               // }

    	    // return json_encode($meniji);
  	
    }
     public function nivelacijeUnos(request $request)
	    {
	        try{ 
	        $obj = new nivelacije;  
	        $obj->id = DB::raw("nextval('cmat.seq_nivelacije')");   
	        // $obj ->datum = $request->datum;
	        $obj ->sis_datum = DB::raw("current_timestamp");
	        $obj ->artikal_sifra = $request->artikal_sifra;
	        $obj ->kolicina = $request->kolicina; 
	        $obj ->stara_cena = $request->stara_cena; 
	        $obj ->nova_cena = $request->nova_cena; 
            $obj ->idnivelacije = $request->idnivelacije; 
            // $obj ->orgjed = $request->orgjed; 
	        
	        $obj->save();


	        }
	    catch(Exception $e){
	       // do task when error
	       echo $e->getMessage();   // insert query
	    }
	    
	       //return $request->korisnik;
	    }
         public function nivelacijeBrisanje(request $request)
        {
            try{ 

                 $res=nivelacije::where('id',$request->pretraga)->delete();

            }
        catch(Exception $e){
           // do task when error
           echo $e->getMessage();   // insert query
        }
        
           //return $request->korisnik;
        }

	    public function nivelacijeArtikli(request $request)
    {
    		
    		$andr = new artikal;
    		$apps = $andr::where('naziv', 'like', '%' . strtoupper($request->pretraga)  . '%')->orWhere('sifra', 'like', '%' . $request->pretraga . '%')->get();

    	     return json_encode($apps);
  	
    }
    public function nivelacijeArtikliKalk(request $request)
    {
      //['312','265','6120','75','6110']
        
        $andr = new artikal;
        //$apps = $andr::whereIn('sifra', ['312','265','6120','75','6110'])->get();
        $apps = $andr::where('naziv', 'like', '%' . strtoupper($request->pretraga)  . '%')->orWhere('sifra', 'like', '%' . $request->pretraga . '%')->get();
        

           return json_encode($apps);
    
    }
     public function nivelacijeObjekti(request $request)
    {
            
            $andr = new objekti;
            $apps = $andr::where('orgjed','<>','1')->get();
            //$apps = $andr::where('naziv', 'like', '%' . strtoupper($request->pretraga)  . '%')->orWhere('sifra', 'like', '%' . $request->pretraga . '%')->get();

             return json_encode($apps);
    
    }
    public function nivelacijeJasper(request $request)
    {
    // include(app_path() . '\Klase\jasper\autoload.dist.php');
       //require_once 'jasper/autoload.dist.php';
        //use Jaspersoft\Client\Client;
    
        $c = new Client(
                "http://localhost:8081/jasperserver",
                "jasperadmin",
                "jasperadmin",
                ""
              ); 

          $id=$request->id;

              $controls = array(
              // 'p_orgjed' =>$p_orgjed //'2017.03',//$mesec,
                'id' =>$id
                

               );

            $report = $c->reportService()->runReport('/reports/nivelacije', 'pdf', null, null,$controls);
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Description: File Transfer');
            //header('Content-Disposition: attachment; filename=fill_rate.pdf');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . strlen($report));
            header('Content-Type: application/pdf');
           @readfile($report);
            ///echo $report;
         
      }
    
    
}
