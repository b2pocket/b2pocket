<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Http\Controllers\Controller;
use Exception;
use DB;
use Illuminate\Database\QueryException;
use Redirect;

class popisIndex extends Controller
{
	public function getSema(){
		$sema = Auth::user()->sema;
		return $sema;
	}
	public function getUserId(){
		$id = Auth::user()->id;
		return $id;
	}
    public function popisIndex()
    {
		$objekti = DB::select("select orgjed, nazobj as naziv from {$this->getSema()}.objekti o2  where o2.status = 'A'");
		return view('popis',compact('objekti'));
    }

    public function spisakPopisa(request $request)
    {
    	try {
    		$user = Auth::user();
			$sema = Auth::user()->sema;
            $orgjed = $request->orgjed;
            $status = $request->status;
    		$popisi =  DB::select("SELECT p.id, to_char(p.sis_datum,'dd.mm.yyyy') as sis_datum, p.sis_timestamp, p.vreme_zavrsetka, oj.nazobj,
    							   p.korisnik_portala,wu.name as naziv_korisnika, p.broj_artikala, p.status, p.orgjed, p.broj_popunjenih_artikala,
                                   p.broj_popunjenih_artikala||'/'||p.broj_artikala as popisanih,

    							   case when p.status = 'KREIRAN' and p.broj_artikala = p.broj_popunjenih_artikala then '<button class=\"btn btn-link btn-sm ml-2 mt-2 mt-xl-0 d-inline\" type=\"button\" onclick=\"potvrdiPopis(id);\">Potvrdi zavrsen popis<i class=\"fa fa-check ml-1\"></i></button>' 
    							   when p.status = 'ZAVRSEN' then '' else '' end as akcija ,

    							   case when p.status = 'KREIRAN' and p.broj_artikala > 0 then '<button data-id_popisa=\"'||p.id||'\" class=\"nastaviPopis btn btn-success btn-sm ml-2 mt-2 mt-xl-0 d-inline\"  >Nastavi popis<i class=\"fa fa-play ml-1\"></i></button>' 
    							   when p.status = 'ZAVRSEN' then '' else '' end as akcija2,

    							   case when p.broj_popunjenih_artikala = 0 then '<button data-id_popisa=\"'||p.id||'\" class=\"obrisiPopis btn btn-danger btn-sm ml-2 mt-2 mt-xl-0 d-inline\" type=\"button\" >Obrisi<i class=\"fa fa-trash ml-1\" ></i></button>' 
    							   when p.broj_popunjenih_artikala > 0 then '' else '' end as obrisiPopis,

                                   case when p.broj_artikala = 0 then '<button data-id_popisa=\"'||p.id||'\" class=\"modalRefreshArtikala btn btn-info btn-sm ml-2 mt-2 mt-xl-0 d-inline\"  >Info<i class=\"fas fa-info ml-2\"></i></button>' else '' end as popuniArtikle

    						       FROM {$this->getSema()}.m_popis p,{$this->getSema()}.objekti oj,ibm.users wu
    						       where p.orgjed = oj.orgjed
                                   and p.soft_delete = 'NO'
                                   and wu.id = p.korisnik_portala
                                   and (p.orgjed = '{$orgjed}' or 'SVI' = '{$orgjed}')
                                   and (p.status = '{$status}' or 'SVI' = '{$status}')
                                   order by p.status asc, p.sis_datum asc
                                   ");
                 return json_encode($popisi);
    		
    		}  catch(QueryException $ex)
    		{ 
		      //dd($ex->getMessage()); 
		    }
    	

    }
    public function popisKreiraj(request $request){
    	$orgjed = $request->orgjed;
    	$user_id = $this->getUserId();
    	$popis_id_arr = DB::select("SELECT {$this->getSema()}.m_popis_generisi({$user_id},'{$orgjed}') as id");
    	$popis_id = $popis_id_arr[0]->id;
    	return redirect()->route('popisStavkeIndex', ['popis_id'=>$popis_id]);
    	//$id_popisa = DB::select('SELECT ult.m_popis_generisi(1,'2')')
    	// SELECT ult.m_popis_generisi(1,'2');
    	//return Redirect::back()->with('message','Operation Successful !');
    }
}
