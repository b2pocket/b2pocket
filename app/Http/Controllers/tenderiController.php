<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

use DB;
use Illuminate\Database\QueryException as excp;
use Exception;
use Laravel\Traits\BindsDynamically;

class tenderiController extends Controller
{
	use BindsDynamically;
	public function __construct(Request $request)
	{
		$modelName = '\Laravel\adminModels\\'.'tenderi';
		$this->modelName = $modelName;
		$obj1 = new $modelName;  
		$obj1->setTable($request->sema.'.'.$request->tabela);
		$this->sema = $request->sema;//$obj1->samoSema;
		$this->tabela =$request->tabela;
		$this->tabelSaSemom = $request->sema.'.'.$request->tabela; 
	
	}
      public function tenderiIndex()
    {
    	
    	$sema = $this->sema;
		$tabela = $this->tabela;
		$partneri = DB::Select("
					select sifra,naziv||' - '||mesto as naziv from {$sema}.mddob  where godina_baze = 2019 order by naziv asc
					");
        $ucesnici = DB::Select("
                   select id,naziv from {$sema}.tenderi_ucesnici where id <> 2 order by naziv asc
                    ");
        $ucesnici2 = DB::Select("
                   select id,naziv from {$sema}.tenderi_ucesnici  order by naziv asc
                    ");
        $artikli = DB::Select("
                    select sifra, naziv from {$sema}.artikal where naziv <> '' order by naziv asc ");

        return view('admin/tenderi',compact('partneri','sema','tabela','artikli','ucesnici','ucesnici2'));      
    
    }
    public function tenderiPrelged(Request $request)
    {
    // 		 	$meniji = new $this->modelName;
				// $meniji->setTable($this->sema.'.'.$this->tabela);
				// $as = $meniji->get();

				$as = DB::select("
                    select a.id,a.sis_datum,a.korisnik,a.komitent,to_char(a.datum_od,'mm.dd.yyyy') as datum_od,to_char(a.datum_do,'mm.dd.yyyy') as datum_do,a.vrednost_tendera, to_char(a.vrednost_tendera, '999,999,990') vrednost_tendera_sep,a.valuta_broj_dana,a.status,a.dobitnik_tendera_fk,a.naziv_partnera,u.naziv as naziv_dobitnika from (
                select s.*,m.naziv  as naziv_partnera--, u.naziv as naziv_dobitnika
                from {$this->sema}.tenderi_zaglavlje s, {$this->sema}.mddob m--, {$this->sema}.tenderi_ucesnici u
                where s.komitent = m.sifra
                and (s.status = '{$request->status}' or 'SVI' = '{$request->status}')
                and (s.komitent = '{$request->partner}' or 'SVI' = '{$request->partner}')
                --and s.dobitnik_tendera_fk = u.id
                ) a left join  {$this->sema}.tenderi_ucesnici u
                on a.dobitnik_tendera_fk = u.id
                order by id desc
						/*select s.*,m.naziv  as naziv_partnera, u.naziv as naziv_dobitnika
						from {$this->sema}.tenderi_zaglavlje s, {$this->sema}.mddob m, {$this->sema}.tenderi_ucesnici u
						where s.komitent = m.sifra
						and s.dobitnik_tendera_fk = u.id*/
						");
           		$broj = count($as);
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
                    return json_encode($as);
                }

    	    // return json_encode($meniji);
  	
    }
    public function tenderUnos(request $request)
    {
            try{
                    $obj = new $this->modelName;
                    $obj->setTable($this->sema.'.'.$this->tabela); 
                    $obj->id = DB::raw("nextval('{$this->sema}.seq_tenderi_zaglavlje')");
                    $obj ->komitent = $request->partner;
                    $obj ->sis_datum = DB::raw("current_timestamp");
                    $obj ->korisnik = \Auth::user()->id;
                    //$obj ->prikazni_naziv = $request->prikazni_naziv; 
                    $obj ->datum_od = $request->datum_od; 
                    $obj ->datum_do = $request->datum_do; 
                    $obj ->status = 'UN'; 
                    $obj ->vrednost_tendera = $request->vrednost_tendera; 
                    $obj ->valuta_broj_dana = $request->valuta_broj_dana; 

                     
                    
                    $obj->save();
                    $vratiGresku = array();
                    $vratiGresku['greska'] = "Uspesno kreiranje";
                    $vratiGresku['klasa'] = 'success';
                    return $vratiGresku; 
       
                }
        catch(Exception $e){
           // do task when error
           echo $e->getMessage();   // insert query
        }
    }
     public function tenderIzmena(request $request)
      {
            try{
            $obj = new $this->modelName;
            $obj->setTable($this->sema.'.'.$this->tabela); 

            $izmena = 
            $obj->where('id','=',$request->id)
            ->update(['vrednost_tendera'=>$request->vrednost_tendera,
                        'komitent'=>$request->partner,
                        'datum_od'=>$request->datum_od,
                        'datum_do'=>$request->datum_do,
                      'valuta_broj_dana'=>$request->valuta_broj_dana]
                  );
            $vratiGresku = array();
            $vratiGresku['greska'] = "Uspesna izmena";
            $vratiGresku['klasa'] = 'success';
            return $vratiGresku;
         


            }
        catch(\Illuminate\Database\QueryException $e){
           // do task when error
          // echo $e->getMessage();   // insert query
           $vratiGresku = array();
            $vratiGresku['greska'] = "Greska pri izmeni";
            $vratiGresku['klasa'] = 'error';
            return $vratiGresku;
        }

      }
      public function tenderPotvrda(request $request)
      {
            try{
            $obj = new $this->modelName;
            $obj->setTable($this->sema.'.'.$this->tabela); 

            $izmena = 
            $obj->where('id','=',$request->id)
            ->update(['status'=>'P',
                        'datum_potvrdjivanja'=> DB::raw("current_timestamp"),
                        'korisnik_potvrdio'=>\Auth::user()->id
                    ]
                  );
            $vratiGresku = array();
            $vratiGresku['greska'] = "Uspesna izmena";
            $vratiGresku['klasa'] = 'success';
            return $vratiGresku;
         


            }
        catch(\Illuminate\Database\QueryException $e){
           // do task when error
          // echo $e->getMessage();   // insert query
           $vratiGresku = array();
            $vratiGresku['greska'] = "Greska pri izmeni";
            $vratiGresku['klasa'] = 'error';
            return $vratiGresku;
        }

      }
      public function tenderZatvaranje(request $request)
      {
            try{
            $obj = new $this->modelName;
            $obj->setTable($this->sema.'.'.$this->tabela); 

            $izmena = 
            $obj->where('id','=',$request->id)
            ->update(['status'=>'Z',
                        'sis_datum_zatvaranja'=> DB::raw("current_timestamp"),
                        'korisnik_zatvorio'=>\Auth::user()->id,
                        'dobitnik_tendera_fk'=>$request->ucesnik,
                        'datum_zatvaranja'=>$request->datum
                    ]
                  );
            $vratiGresku = array();
            $vratiGresku['greska'] = "Uspesna izmena";
            $vratiGresku['klasa'] = 'success';
            return $vratiGresku;
         


            }
        catch(\Illuminate\Database\QueryException $e){
           // do task when error
          // echo $e->getMessage();   // insert query
           $vratiGresku = array();
            $vratiGresku['greska'] = "Greska pri izmeni";
            $vratiGresku['klasa'] = 'error';
            return $vratiGresku;
        }

      }
    public function tenderBrisanje(request $request)
        {
            try{ 
                $obj = new $this->modelName;
                $obj->setTable($this->sema.'.'.$this->tabela); 

                $res=$obj->where('id',$request->id)->delete();
                $vratiGresku = array();
                $vratiGresku['greska'] = "Uspesno brisanje!";
                $vratiGresku['klasa'] = 'success';
                return $vratiGresku;

            }
       catch(\Illuminate\Database\QueryException $e){
           // do task when error
          // echo $e->getMessage();   // insert query
           $vratiGresku = array();
            $vratiGresku['greska'] = "Greska pri brisanju! Ne mozete brisati ako ste uneli stavke tendera!!";
            $vratiGresku['klasa'] = 'error';
            return $vratiGresku;
        }
        
           //return $request->korisnik;
        }

         public function tenderiPrelgedStavke(Request $request)
    {              
                if (!$request->id) {
                     return '{
                    "sEcho": 1,
                    "iTotalRecords": "0",
                    "iTotalDisplayRecords": "0",
                    "aaData": []
                }';
                }
                  $as = DB::select("
                    SELECT s.*,ar.naziv, z1.naziv as naziv_z1,z1.sifra as sifra_z1, z2.naziv as naziv_z2, z2.sifra as sifra_z2,

                    '<input type=\"number\" value=\"'||coalesce(CAST(s.prod_cena AS text),'')||'\" id = \"unosProdajneStavke\" class=\"form-control\" placeholder=\"prodajna\">' as prodajna_vred,
                      '<input type=\"text\" value=\"'||round((s.prod_cena*s.kolicina)-(s.nab_cena*s.kolicina),2)||'\"  id = \"abs_ruc\" class=\"form-control\" placeholder=\"ruc\" readonly>' as abs_ruc,
                    '<input type=\"text\" value=\"'||round((s.prod_cena*s.kolicina)*100/(s.kolicina*s.nab_cena),2)-100||'%\"  id = \"proc_ruc\" class=\"form-control\" placeholder=\"ruc %\" readonly>' as proc_ruc
                    from hel.tenderi_stavke s
                    left  join hel.artikal z1 on s.zamenski_artikal1 = z1.sifra
                    left join hel.artikal z2 on s.zamenski_artikal2 = z2.sifra,
                    hel.artikal ar
                    where s.sif_art = ar.sifra
                    and s.tenderi_zaglavlje_fk = {$request->id}
                    order by s.id desc
                        ");
                $broj = count($as);
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
                    return json_encode($as);
                }

            // return json_encode($meniji);
    
    }
          public function tenderiPrelgedStavkeKonk(Request $request)
    {              
                if (!$request->id) {
                     return '{
                    "sEcho": 1,
                    "iTotalRecords": "0",
                    "iTotalDisplayRecords": "0",
                    "aaData": []
                }';
                }
                  $as = DB::select("
                    SELECT s.*,ar.naziv, z1.naziv as naziv_z1,z1.sifra as sifra_z1, z2.naziv as naziv_z2, z2.sifra as sifra_z2,u.id as id_ucesnik, u.naziv as naziv_ucesnik,
                        '<input type=\"number\" value=\"'||coalesce(CAST(s.prod_cena AS text),'')||'\" id = \"unosProdajneStavkeKonk\" class=\"form-control\" placeholder=\"prodajna\">' as prodajna_vred
                        from hel.tenderi_stavke_ucesnici s
                        left  join hel.artikal z1 on s.zamenski_artikal1 = z1.sifra
                        left join hel.artikal z2 on s.zamenski_artikal2 = z2.sifra,
                        hel.artikal ar, hel.tenderi_ucesnici u
                        where s.sif_art = ar.sifra
                        and u.id = s.ucesnik_fk
                        and s.tenderi_zaglavlje_fk = {$request->id}
                        and s.ucesnik_fk = {$request->ucesnik}
                        order by s.id desc

                        ");
                $broj = count($as);
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
                    return json_encode($as);
                }

            // return json_encode($meniji);
    
    }
    public function tenderUnosStavki(request $request)
    {
            try{
                    $obj = new $this->modelName;
                    $obj->setTable($this->sema.'.'.$this->tabela); 
                    $obj->id = DB::raw("nextval('{$this->sema}.seq_tenderi_stavke')");
                    $obj ->sif_art = $request->artikal;
                    $obj ->kolicina = $request->kolicina;
                    $obj ->nab_cena = $request->nab_cena;
                    $obj ->sis_datum = DB::raw("current_timestamp");
                    $obj ->tenderi_zaglavlje_fk = $request->tender;
                    $obj ->zamenski_artikal1 = $request->artikal_z1;
                    $obj ->zamenski_artikal2 = $request->artikal_z2;
                     
                    $obj->save();
                    $vratiGresku = array();
                    $vratiGresku['greska'] = "Uspesno kreiranje";
                    $vratiGresku['klasa'] = 'success';
                    return $vratiGresku; 
       
                }
        catch(\Illuminate\Database\QueryException $e){
           // do task when error
           echo $e->getMessage();   // insert query
        }
    }
    public function tenderUnosStavkiKonk(request $request)
    {
            try{
                    $obj = new $this->modelName;
                    $obj->setTable($this->sema.'.'.$this->tabela); 
                    $obj->id = DB::raw("nextval('{$this->sema}.seq_tenderi_stavke_ucesnici')");
                    $obj ->sif_art = $request->artikal;
                    $obj ->ucesnik_fk = $request->ucesnik;
                    $obj ->sis_datum = DB::raw("current_timestamp");
                    $obj ->tenderi_zaglavlje_fk = $request->tender;
                    $obj ->zamenski_artikal1 = $request->artikal_z1;
                    $obj ->zamenski_artikal2 = $request->artikal_z2;
                     
                    $obj->save();
                    $vratiGresku = array();
                    $vratiGresku['greska'] = "Uspesno kreiranje";
                    $vratiGresku['klasa'] = 'success';
                    return $vratiGresku; 
       
                }
        catch(\Illuminate\Database\QueryException $e){
           // do task when error
           echo $e->getMessage();   // insert query
        }
    }
    public function tenderStavkaBrisanje(request $request)
        {
            try{ 
                $obj = new $this->modelName;
                $obj->setTable($this->sema.'.'.$this->tabela); 

                $res=$obj->where('id',$request->id)->delete();
                $vratiGresku = array();
                $vratiGresku['greska'] = "Uspesno brisanje!";
                $vratiGresku['klasa'] = 'success';
                return $vratiGresku;

            }
       catch(\Illuminate\Database\QueryException $e){
           // do task when error
          // echo $e->getMessage();   // insert query
           $vratiGresku = array();
            $vratiGresku['greska'] = "Greska pri brisanju! Ne mozete brisati ako ste uneli stavke tendera!!";
            $vratiGresku['klasa'] = 'error';
            return $vratiGresku;
        }
        
           //return $request->korisnik;
        }

        public function tenderUnosProdajneCene(request $request)
      {
            try{
            $obj = new $this->modelName;
            $obj->setTable($this->sema.'.'.$this->tabela); 

            $izmena = 
            $obj->where('id','=',$request->id)
            ->update(['prod_cena'=>$request->cena]
                  );
            $vratiGresku = array();
            $vratiGresku['greska'] = "Uspesna izmena";
            $vratiGresku['klasa'] = 'success';
            return $vratiGresku;
         


            }
        catch(\Illuminate\Database\QueryException $e){
           // do task when error
          // echo $e->getMessage();   // insert query
           $vratiGresku = array();
            $vratiGresku['greska'] = "Greska pri izmeni";
            $vratiGresku['klasa'] = 'error';
            return $vratiGresku;
        }

      }
}
