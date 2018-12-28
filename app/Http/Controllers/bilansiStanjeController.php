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
      
        return view('setovanje_bilansa_stanja');      
    
    }
     public function zaglavljeKontaStanja()
    {
    	     $klase_konta = DB::select('
					SELECT  	coalesce(klasa_konta,\'/\') klasa_konta, 
				      			coalesce(kategorija,\'/\') as kategorija, 
				      			redosled as redosled, 
				      		
				      			sifra_klase as sifra_klase
				      			
							FROM gk.b_gk_klasa_konta_bs

							');
    	     return json_encode($klase_konta);
  	
    }
     public function neklasifikovanaKontaStanja()
    {
    	     $neklasifikova = DB::select('
					
						select b.sifkon as konto,k.naziv
						from (
						select distinct(sifkon) from gk.vgk where sifkon not  in (select konto from gk.b_gk_veza_klasa_konto) and (sifkon like \'5%\' or sifkon like \'6%\') ) b,
						gk.konto k
						where b.sifkon = k.sifra



							');
    	     return json_encode($neklasifikova);
  	
    }
    public function tableDetailStanja($klasaKonta)
    {
    		$klasaKonta = $klasaKonta;
    		
    	     $detail = DB::select( DB::raw('
					      		SELECT kk.klasa_konta,v.sifra_klase,k.naziv as nazivd ,v.konto
							    FROM gk.b_gk_veza_klasa_konto_bs v, gk.konto k, gk.b_gk_klasa_konta_bs kk
							    where k.sifra = v.konto
							    and kk.sifra_klase = v.sifra_klase
							    and kk.sifra_klase = :klasaKonta

							'), array('klasaKonta' => $klasaKonta));
    	     return json_encode($detail);
  	
    }
      
  
}
