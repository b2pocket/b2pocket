<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Http\Controllers\Controller;
use Exception;
use DB;
use Illuminate\Database\QueryException;
use Redirect;

class popisStavkeIndex extends Controller
{
	public function getSema(){
		$sema = Auth::user()->sema;
		return $sema;
	}
	public function getUserId(){
		$id = Auth::user()->id;
		return $id;
	}
    public function popisStavkeIndex(request $request)
    {
    	$popis_id = $request->popis_id;

    	$dozvola_arr = DB::select("select count(*) as postoji from {$this->getSema()}.m_popis where  id = {$popis_id} and soft_delete = 'NO' and status = 'KREIRAN' and (select count(*) from {$this->getSema()}.m_popis_stavke where m_popis_fk = {$popis_id}) > 0");
    	$dozvola = $dozvola_arr[0]->postoji;

    	if ($dozvola != '1'){
    		return redirect()->route("popisIndex", ['sema'=>$this->getSema(),'tabela'=>'m_popis']);
    	}
    	$sema = $this->getSema();

    	$popis_info_arr = DB::select("select mp.sis_datum , o.nazobj , mp.broj_artikala , mp.broj_popunjenih_artikala  from ult.m_popis mp,ult.objekti  o
						 where id = {$popis_id }
						 and mp.orgjed  = o.orgjed");
    	$popis_info = $popis_info_arr[0]; 

		$objekti = DB::select("select orgjed, nazobj as naziv from {$this->getSema()}.objekti o2  where o2.status = 'A'");
		return view('popis_stavke',compact('objekti','popis_id','sema','popis_info'));
    }

    public function popisArtikliRefresh(request $request){
    	$popis_id = $request->popis_id;
    	try {
    		$osvezi_artikle = DB::select("CALL {$this->getSema()}.m_popis_broj_artikala_refresh({$popis_id},{$this->getUserId()})");
    	}  catch(QueryException $ex)
    		{ 
		      //print_r($ex->getMessage()); 
		    }	
    }
    public function popisBrisanje(request $request){
    	$popis_id = $request->popis_id;
    	try {
		    	$soft_delete = DB::select("
    			update {$this->getSema()}.m_popis set soft_delete = 'YES',korisnik_obrisao = {$this->getUserId()}, vreme_brisanja  = current_timestamp 
				where id  = {$popis_id}
				and 0 = (select count(*) from {$this->getSema()}.m_popis_stavke mps where mps.popisana_kolicina is not null and mps.m_popis_fk  = {$popis_id})
		    		");
    	}  catch(QueryException $ex)
    		{ 
		      //print_r($ex->getMessage()); 
		    }

    }
    public function spisakStavkiPopisa(request $request)
    {
    	try {
			$popis_id = $request->popis_id;
			$status_popisane = $request->status_popisane;
			if ($status_popisane == 'SVE'){
				$addQuery = '';
			}else if ($status_popisane == 'NEPOPISANE'){
				$addQuery = 'and mps.popisana_kolicina is null';
			}else if ($status_popisane == 'POPISANE'){
				$addQuery = 'and mps.popisana_kolicina is not null';
			}
            // $orgjed = $request->orgjed;
            // $status = $request->status;
    		$stavke =  DB::select("SELECT mps.sifra_artikla ,mps.barcode,mps.prodcen , mps.naziv_artikla , mps.kolicina ,
    								 mps.kolicina * mps.prodcen as 	vrednost, mps.kolicina||' '||mps.jmere as kolicina_jmere,mps.prodcen||' din' as prodcen_din,(mps.kolicina * mps.prodcen)||' din' as vrednost_din,
									 case 
									 when mps.popisana_kolicina is null 
									 then '<input type=\"number\" pattern=\"[0-9]\" class=\"popisana_kolicina form-control\" style=\"max-width:150px;\" id =\"'||mps.id||'\" data-id=\"'||mps.id||'\" data-prodcen=\"'||mps.prodcen||'\"  data-sifra_artikla=\"'||mps.sifra_artikla||'\">' 
									 else '<input type=\"number\" pattern=\"[0-9]\" id =\"'||mps.id||'\"  value=\"'||mps.popisana_kolicina||'\" class=\"popisana_kolicina form-control\" style=\"max-width:150px;\"  data-id=\"'||mps.id||'\"  data-prodcen=\"'||mps.prodcen||'\" data-sifra_artikla=\"'||mps.sifra_artikla||'\">' end as popisana_kolicina, 


									 case when mps.popisana_kolicina is null then '<label  id=\"p'||mps.id||'\"></label>' else '<label  id=\"p'||mps.id||'\">'||(mps.popisana_kolicina * mps.prodcen)::text||'</label>' end as vrednost_popisa
									 from {$this->getSema()}.m_popis_stavke mps
									 where mps.m_popis_fk = {$popis_id}
									 {$addQuery}
									 order by mps.naziv_artikla asc
                                   ");
                 return json_encode($stavke);
    		
    		}  catch(QueryException $ex)
    		{ 
		      //print_r($ex->getMessage()); 
		    }
    	

    }
    public function popisStavkaNovaKolicina(request $request){

    		$id_stavke = $request->id_stavke;
    		$popisana_kolicina = $request->popisana_kolicina;
    		$popis_id = $request->popis_id;

    		if (empty($popisana_kolicina)){
    			$popisana_kolicina = 'null';
    			
    		}

    	try {
    		$unesi_kolicinu = DB::select("update {$this->getSema()}.m_popis_stavke  set popisana_kolicina = {$popisana_kolicina} where id = {$id_stavke}");
    		$osvezi_artikle = DB::select("CALL {$this->getSema()}.m_popis_broj_artikala_refresh({$popis_id},{$this->getUserId()})");
    	}  catch(QueryException $ex)
    		{ 
		      //print_r($ex->getMessage()); 
		    }	
    }
    public function labelBrojPopisanihRefresh(request $request){
    		$popis_id = $request->popis_id;
    		$popis_info_arr = DB::select("select mp.sis_datum , o.nazobj , mp.broj_artikala , mp.broj_popunjenih_artikala  from ult.m_popis mp,ult.objekti  o
						 where id = {$popis_id }
						 and mp.orgjed  = o.orgjed");
    		$broj_popunjenih_artikala = $popis_info_arr[0]->broj_popunjenih_artikala; 
    		return $broj_popunjenih_artikala;
    }	
    public function exportCsv(Request $request){
    		if (!Auth::user())
    		{
    			return redirect()->back();
    		}

    		$popis_id = $request->popis_id;

		    $popis_arr = DB::select("select to_char(sis_datum,'dd_mm_yyyy') as sis_datum, o.nazobj  from {$this->getSema()}.m_popis mp ,{$this->getSema()}.objekti o 
			 						where o.orgjed = mp.orgjed and mp.id = {$popis_id}");
		    $naziv_objekta = $popis_arr[0]->nazobj; 
		    $datum_popisa = $popis_arr[0]->sis_datum; 
    		
    		$fileName = "popis_{$naziv_objekta}_{$datum_popisa}.csv";
		    //$tasks = Task::all();
		    $stavke = DB::select(" select mps.sifra_artikla,mps.barcode , mps.popisana_kolicina
								 from {$this->getSema()}.m_popis_stavke mps 
								 where mps.m_popis_fk = {$popis_id}
								 and mps.popisana_kolicina is not null ");
	        $headers = array(
	            "Content-type"        => "text/csv",
	            "Content-Disposition" => "attachment; filename=$fileName",
	            "Pragma"              => "no-cache",
	            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
	            "Expires"             => "0"
	        );
	        $columns = array('SIFRA', 'KOLICINA');
	        $callback = function() use($stavke, $columns) {
	            $file = fopen('php://output', 'w');
	            //fputcsv($file, $columns);//ako zatreba naziv kolona
		            foreach ($stavke as $stavka) {
		                fputcsv($file, array("{$stavka->barcode}\r", $stavka->popisana_kolicina)); //   '="' . $stavka->barcode . '"'
		            }

		            fclose($file);
		       };

		        return response()->stream($callback, 200, $headers);
		    }
		public function popisZavrsi(request $request){
			if (!Auth::user())
    		{
    			return redirect()->back();
    		}
    		$popis_id = $request->popis_id;
    	try {

    		$dozvola_arr = DB::select("select count(*) as postoji from {$this->getSema()}.m_popis where id = {$popis_id} 
					and broj_artikala  = broj_popunjenih_artikala 
				 	and status = 'KREIRAN'");
    		$dozvola = $dozvola_arr[0]->postoji;
    		if ($dozvola != '1'){
    			$json = new \stdClass();
				$json->status = false;
				$json->poruka = "Popunite sve stavke!!!";
			    return json_encode($json);
    		}

		    	$zavrsi = DB::select("
    				update {$this->getSema()}.m_popis 
				 	set status = 'ZAVRSEN', vreme_zavrsetka = current_timestamp  
				 	where id = {$popis_id} 
					and broj_artikala  = broj_popunjenih_artikala 
				 	and status = 'KREIRAN' 
		    		");
		    	$json = new \stdClass();
				$json->status = true;
				$json->poruka = "Uspesno ste potvrdili, sada mozete da preuzmete fajl!!!";
			    return json_encode($json);
    	}  catch(QueryException $ex)
    		{ 
		     // print_r($ex->getMessage()); 
		    }

    }

}
