<?php

namespace Laravel\Http\Controllers\adminApps;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Laravel\Http\Controllers\Controller;
use Laravel\adminModels\zapisi\sql_logger as zapisi;
use Exception;

class zapisiController extends Controller
{
    public function zapisiIndex()
    {
      
        return view('admin/zapisi');      
    
    }
    public function zapisiSqlLogger()
    {
    		$andr = new zapisi;
    		$meniji = zapisi::orderBy('id', 'DESC')->get();
           $broj = count($meniji);
                if ($broj < 1){
                    return '{
                    "sEcho": 1,
                    "iTotalRecords": "0",
                    "iTotalDisplayRecords": "0",
                    "aaData": []
                }';
                } 
                else 
                {
                    return json_encode($meniji);
                }

    	    // return json_encode($meniji);
  	
    }
     public function zapisiSqlLoggerUnos(request $request)
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
}
