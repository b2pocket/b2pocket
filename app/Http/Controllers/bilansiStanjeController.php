<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Laravel\b_gk_veza_klasa_konto_Model;
use DB;

class bilansiStanjeController extends Controller
{
      public function setovanje_bilansa_stanja()
    {
       $firme =  DB::select("
        select pg_sema_gk as id,naziv from sis.firme

            ");
        return view('cmat/setovanje_bilansa_stanja',compact('firme'));      
    
    }
     public function zaglavljeKontaStanja(request $request)
    {
       // print_r($request->sema);

    
    	     $klase_konta = DB::select('
					SELECT  	coalesce(klasa_konta,\'/\') klasa_konta, 
				      			coalesce(kategorija,\'/\') as kategorija, 
				      			redosled as redosled, 
				      		
				      			sifra_klase as sifra_klase
				      			
							FROM '.$request->sema.'.b_gk_klasa_konta_bs

							');
    	     return json_encode($klase_konta);
  	
    }
     public function neklasifikovanaKontaStanja(request $request)
    {
           $sema = $request->sema;
    	     $neklasifikova = DB::select("

    	     			select b.sifkon as konto,k.naziv
						from (
						select distinct(substring(sifkon,1,3)) as sifkon from $sema.vgk 
						where substring(sifkon,1,3) not  in (select substring(konto,1,3) from $sema.b_gk_veza_klasa_konto_bs) 
						and sifkon not like '6%' and sifkon not like '5%'  and sifkon not like '7%'  and sifkon not like '9%'
						) b,
						$sema.konto k
						where b.sifkon = k.sifra
						and length(b.sifkon) >0
					
							");
    	     return json_encode($neklasifikova);
  	
    }
    public function tableDetailStanja(request $request)
    {
    		$klasaKonta = $request->klasaKonta;
        $sema = $request->sema;
        if (isset($klasaKonta) && isset($sema))
          {
             $detail =  DB::select("
               SELECT kk.klasa_konta,v.sifra_klase,k.naziv as nazivd ,v.konto
                    FROM $sema.b_gk_veza_klasa_konto_bs v, $sema.konto k, $sema.b_gk_klasa_konta_bs kk
                    where k.sifra = v.konto
                    and kk.sifra_klase = v.sifra_klase
                    and kk.sifra_klase = $klasaKonta

                    ");
             $broj = count($detail);
          }
          else 
          {
            $broj = 0;
          }
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
                     return json_encode($detail);
                }
    	    
  	
    }
      
  
}
