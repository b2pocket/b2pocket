<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Laravel\b_gk_veza_klasa_konto_Model;
use DB;

class bilansiUspehaController extends Controller
{
      public function setovanje_bilansa_uspeha()
    {
      
        return view('cmat/setovanje_bilansa_uspeha');      
    
    }
     public function zaglavljeKonta()
    {
    	     $klase_konta = DB::select('
					SELECT  	coalesce(klasa_konta,\'/\') klasa_konta, 
				      			coalesce(kategorija,\'/\') as kategorija, 
				      			redosled as redosled, 
				      			coalesce(nadleznost,\'/\') as nadleznost, 
				      			sifra_klase as sifra_klase, 
				      			opex as opex 
							FROM gk.b_gk_klasa_konta

							');
    	     return json_encode($klase_konta);
  	
    }
     public function neklasifikovanaKonta()
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
    public function tableDetail($klasaKonta)
    {
    		$klasaKonta = $klasaKonta;
    		
    	     $detail = DB::select( DB::raw('
					      		SELECT kk.klasa_konta,v.sifra_klase,k.naziv as nazivd ,v.konto
							    FROM gk.b_gk_veza_klasa_konto v, gk.konto k, gk.b_gk_klasa_konta kk
							    where k.sifra = v.konto
							    and kk.sifra_klase = v.sifra_klase
							    and kk.sifra_klase = :klasaKonta

							'), array('klasaKonta' => $klasaKonta));
    	     return json_encode($detail);
  	
    }
      
    function klasifikujKonto(request $request)
    {
    	/* $validatedData = $request->validate([
        'selektovanoZaglavlje' => 'required',
        'selektovaniNeklasifikovani' => 'required',
    			]);*/
    	 //Klasifikovanje konta
    	$obj = new b_gk_veza_klasa_konto_Model;
    	//$data= $request->selektovanoZaglavlje;
      	
    	$obj ->sifra_klase = $request->selektovanoZaglavlje;
    	$obj ->konto = $request->selektovaniNeklasifikovani;

    	
    	$obj->save();

    	//Brisanje iz neklasifikovanog
    	/*$objNekl = new neklasifikovana_konta_bu_Model;
    	$konto = $request->selektovaniNeklasifikovani;
    	$objNekl::where( 'konto', '=', $konto) -> delete();*/


    }
    function obrisiKlasifikacijuKonta(request $request)
    {
    	 $validatedData = $request->validate([
        'selektovanoZaglavlje' => 'required',
        'klasifikovaniKonto' => 'required',
    			]);


    	$obj = new b_gk_veza_klasa_konto_Model;
    	$sifra_klase = $request->selektovanoZaglavlje;
    	$konto = $request->klasifikovaniKonto;

    	//Brisanje klasifikovanog konta
    	//$flights = $obj::where( 'konto', '=', $konto)->where('sifra_klase', '=', $sifra_klase)->get();
    	$obj::where( 'konto', '=', $konto)->where('sifra_klase', '=', $sifra_klase) -> delete();

    	//Dodavanje u neklasifikovana

    	/*$objNekl = new neklasifikovana_konta_bu_Model;
    	$objNekl ->sifra_klase = $request->selektovanoZaglavlje;
    	$objNekl ->konto = $request->klasifikovaniKonto;

    	$obj->save();*/

    }
}
