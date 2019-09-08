<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Laravel\Http\Controllers\Controller;
use Exception;
use DB;
use Laravel\cmatMPOApps\mddob as dobav;


class DashboardController extends Controller
{
     public function dobavljaciSpisak()
    {
        
        $andr = new dobav;
        $tab = $andr::orderBy('nazkup1','asc')->get();

           return mb_convert_encoding(json_encode($tab), "UTF-8");
    
    }

    public function kreirajMeni()
    {	
        $korisnik = \Auth::user()->id;
    	$meni ='';
    	$listaGrupe = DB::Select(

    		"		select  distinct mg.prikaznitekst as grupa,mg.redosled,mg.id
                   from wp.web_meni wm, wp.web_aplikacije wa, wp.web_meni_grupe mg,wp.web_rola_korsnik wk,wp.web_rola_aplikacije webapp
                   where wm.id = wa.nadredjeni_meni
                  
                   and mg.id = wm.grupa_menija
                   and wk.id_korisnik = $korisnik
                   and webapp.id_rola = wk.id_rola
                   and webapp.id_aplikacija = wa.id
         
                   group by mg.id,mg.prikaznitekst,wm.id,wm.nazivmenija,wm.headeraplikacija,wm.fonrawesomeiconica,wa.nazivaplikacije,wa.controller,mg.redosled,wm.redosled,wa.redosled
                   order by mg.redosled asc"
    	);
    	
    	foreach ($listaGrupe as $key => $value) {
    	 	
    	 
    	 	$grupa = $value->grupa;
    	 	$grupa_id = $value->id;
    	 		$meni = $meni." 
		    	 	<hr class=\"sidebar-divider\">
		    	 	<div class=\"sidebar-heading\">
				        $grupa
				      </div>
    	 	";

    	 	$listaMeni = DB::Select("
    	 		           select  distinct wm.id as id_meni, wm.nazivmenija as meni,wm.headeraplikacija as menihead,wm.fonrawesomeiconica as icon, mg.redosled,wm.redosled as r2
                   from wp.web_meni wm, wp.web_aplikacije wa, wp.web_meni_grupe mg,wp.web_rola_korsnik wk,wp.web_rola_aplikacije webapp
                   where wm.id = wa.nadredjeni_meni
                  
                   and mg.id = wm.grupa_menija
                   and webapp.id_rola = wk.id_rola
                   and webapp.id_aplikacija = wa.id
                    and wk.id_korisnik = $korisnik
                   and mg.id =  $grupa_id
                   group by mg.id,mg.prikaznitekst,wm.id,wm.nazivmenija,wm.headeraplikacija,wm.fonrawesomeiconica,wa.nazivaplikacije,wa.controller,mg.redosled,wm.redosled,wa.redosled
                   order by mg.redosled,wm.redosled asc

    	 		");
    	 	foreach ($listaMeni as $key2 => $loopMeni) {

    	 		$nazivMenija = $loopMeni->meni;
    	 		$meni_id = $loopMeni->id_meni;
    	 		$icon = $loopMeni->icon;
    	 		$menihead2 = $loopMeni->menihead;
    	 		$noviid = $grupa.$nazivMenija;
    	 		$meni = $meni.
    	 		"
    	 		<li class=\"nav-item\">
				        <a class=\"nav-link collapsed\" href=\"#\" data-toggle=\"collapse\" data-target=\"#$noviid\" aria-expanded=\"true\" aria-controls=\"$noviid\">
				          <i class=\"$icon\"></i>
				          <span>$nazivMenija</span>
				        </a>
				        <div id=\"$noviid\" class=\"collapse\" aria-labelledby=\"headingUtilities\" data-parent=\"#accordionSidebar\">
				          <div class=\"bg-white py-2 collapse-inner rounded\">
					         <h6 class=\"collapse-header\">$menihead2</h6>
    	 		";
    	 		$listaApp = DB::Select("

    	 			   select  distinct wa.naziv_modela,wa.nazivaplikacije as app,wa.controller as app_controller,mg.redosled,wm.redosled as r2,wa.redosled as r3,wa.sema,wa.tabela
                  
                   from wp.web_meni wm, wp.web_aplikacije wa, wp.web_meni_grupe mg,wp.web_rola_korsnik wk,wp.web_rola_aplikacije webapp
                   where wm.id = wa.nadredjeni_meni
                  
                   and mg.id = wm.grupa_menija
                    and webapp.id_rola = wk.id_rola
                   and webapp.id_aplikacija = wa.id
                    and wk.id_korisnik = $korisnik
                   and mg.id = $grupa_id
                   and wm.id = $meni_id
                   group by mg.id,mg.prikaznitekst,wm.id,wm.nazivmenija,wm.headeraplikacija,wm.fonrawesomeiconica,wa.nazivaplikacije,wa.naziv_modela,wa.controller,mg.redosled,wm.redosled,wa.redosled,wa.sema,wa.tabela
                   order by mg.redosled,wm.redosled,wa.redosled asc

    	 			");
    	 		
    	 		foreach ($listaApp as $keyApp => $valueApp) {

    	 				$nazivApp = $valueApp->app;
    	 				$nazivModela = $valueApp->naziv_modela;
                        $sema = $valueApp->sema;
                        $tabela = $valueApp->tabela;
    	 				$nazivControllera = $valueApp->app_controller;
    	 				$ruta = url($nazivControllera);
    	 				$meni = $meni.

    	 				"<a class=\"collapse-item\"  href=\"$ruta/$sema/$tabela\">$nazivApp</a>";
    	 
    	 		}
    	 		$meni = $meni."    </div> </div> </li>";

    	 	
    	 	}
    	 
    	 	
    	}
    		return $meni;
    }



}
