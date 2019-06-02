<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Laravel\andr_and_user_Model as andr;
use Laravel\cmat\and_v_prava_na_app as prava;
use Laravel\cmat\and_aplikacija as allApp;
use DB;
use Exception;


class korisniciIPravaController extends Controller
{
        public function korisnici_i_prava()
    {
      
        return view('admin/android_manipulacija/korisnici_i_prava');      
    
    }
       public function androidUsers()
    {
    		$andr = new andr;
    		$korisnici = $andr::all();

    	     return json_encode($korisnici);
  	
    }
    public function androidAppsForUser($korisnik)
    {
        //$request->post('KORISNIK')

      // $prava= $request->get('korisnik');
$userprava = prava::where('korisnik',$korisnik)->get(); 
                $broj = count($userprava);
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
                    return json_encode($userprava);
                }

        
    
    }
     public function appsnotforuser(request $request)
    {
 //$dedicatedApps = prava::where('korisnik',$request->korisnik)->get();

    $dedicatedApps = prava::where('korisnik',$request->korisnik)->pluck('aplikacija')->toArray(); 
        
    $allApps = allApp::whereNotIn('aplikacija',$dedicatedApps)->get(); 



                $broj = count($allApps);
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
                    return json_encode($allApps);
                }

        //return $dedicatedApps;
    
    }

     public function upisAndUSer(Request $request)
    {
        
        $andUser= new andr;
        $andUser->imei=$request->post('IMEI');
        $andUser->korisnik=$request->post('KORISNIK');
        $andUser->ime=$request->post('IME');
        $andUser->prezime=$request->post('PREZIME');
        $andUser->pk=$request->post('PK');
        $andUser->pin=$request->post('PIN');
        $andUser->blokiran=$request->post('BLOKIRAN');
        $andUser->email=$request->post('EMAIL');
        $andUser->blokiran=$request->post('BLOKIRAN');
        $andUser->promet_uzivo=$request->post('PROMET_UZIVO');
       
        //$date=date_create($request->get('date'));
        //$format = date_format($date,"Y-m-d");
        //$passport->date = strtotime($format);
        //$passport->office=$request->get('office');
        //$passport->filename=$name;
        $andUser->save();
        
        return redirect('korisnici_i_prava')->with('success', 'Korisnik je upisan');
    }


        public function updateAndUser(Request $request)
    {
        
        //$andUser= new andr;
        //$andUser = andr::where('korisnik',$request->post('KORISNIK'))->find(1);
         $andUser = andr::find($request->post('KORISNIK'));
        //$firstModel = $andUser->first();
        $andUser->imei=$request->post('IMEI');
       
        $andUser->ime=$request->post('IME');
        $andUser->prezime=$request->post('PREZIME');
        $andUser->pk=$request->post('PK');
        $andUser->pin=$request->post('PIN');
        $andUser->blokiran=$request->post('BLOKIRAN');
        $andUser->email=$request->post('EMAIL');
        $andUser->blokiran=$request->post('BLOKIRAN');
        $andUser->promet_uzivo=$request->post('PROMET_UZIVO');
        
        $andUser->save();
     //return $andUser->all();
        return redirect('korisnici_i_prava')->with('success','PODACI SU IZMENJENI');
    }
    public function deleteAndUser(Request $request)
    {
       
        $andUser = andr::find($request->post('KORISNIK'));   
        $andUser->delete();
    
    }
    public function poveziKorisnikaIAplikaciju(request $request)
    {
        try{
        $obj = new prava;     
        $obj ->aplikacija = $request->app;
        $obj ->korisnik = $request->korisnik; 
        //$obj ->broj = 200;        
        $obj->save();
        }
    catch(Exception $e){
       // do task when error
       echo $e->getMessage();   // insert query
    }
    
       //return $request->korisnik;
    }
    public function sakrijAppOdKorisnika(request $request)
    {
        try{
        $obj = new prava;     
        $aplikacija = $request->app;
        $korisnik = $request->korisnik; 
        //$obj ->broj = 200;        
        $obj::where( 'korisnik', '=', $korisnik)->where('aplikacija', '=', $aplikacija) -> delete();
   
        }
    catch(Exception $e){
       // do task when error
       echo $e->getMessage();   // insert query
    }
}

}
