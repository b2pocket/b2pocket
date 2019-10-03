<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Laravel\andr_and_user_Model as andr;
use Laravel\cmat\and_v_prava_na_app as prava;
use Laravel\cmat\and_aplikacija as allApp;
use Laravel\cmat\and_aplikacija_en as allApp_en;
use Laravel\cmat\and_meni as andMeni;
use Laravel\cmat\and_tab as andTab;
use Laravel\cmat\and_aplikacija_stavka as andTabStavke;
use Laravel\cmat\and_aplikacija_stavka_en as andTabStavke_en;
use Exception;
use DB;

class aplikacijeController extends Controller
{
     public function aplikacijeIndex()
    {
         $jeziciKolekcija =  DB::select("
                 
                  select jezik,jezik_naziv from andr.and_jezik

            ");
         $firmeKolekcija =  DB::select("
                 
                  select id,naziv from sis.firme

            ");
         $aplikacijeKolekcija =  DB::select("
                 
                  
select aplikacija,aplikacija from andr.and_aplikacija order by aplikacija asc

            ");
          $graficiKolekcija =  DB::select("
                 
                  
              SELECT naziv as id,naziv FROM andr.and_stavka_grafik_sifarnik order by 1

            ");
           $graficiDDKolekcija =  DB::select("
                 
                  
              SELECT naziv as id,naziv FROM andr.and_stavka_grafik_sifarnik where dd_stavka is not null order by 1

            ");
           
        return view('admin/android_manipulacija/aplikacije',compact('jeziciKolekcija','graficiKolekcija','graficiDDKolekcija','firmeKolekcija','aplikacijeKolekcija'));     
    
    }
     public function androidMeniji()
    {
    		$andr = new andMeni;
    		$meniji = $andr::all();
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
     public function pronadjiGrafikStavku(request $request)
    {
        $stavka = DB::select("SELECT dd_stavka FROM andr.and_stavka_grafik_sifarnik where naziv = '$request->naziv'");

           return json_encode($stavka);
    
    }
        public function androidKopiranjeStavke(request $request)
    {
      try {
        $stavka = DB::select("
          SELECT 
          sis.kopiraj_stavku_aplikacije('$request->aplikacija_s','$request->aplikacija_n' ,'$request->stavka', $request->firma_s,$request->firma_n,$request->tab_br)");
        // $query = "SELECT 
        //    sis.kopiraj_stavku_aplikacije('$request->aplikacija_s','$request->aplikacija_n' ,'$request->stavka', $request->firma_s,$request->firma_n,$request->tab_br)";
       // print_r($query);
        $array = array();
        $vratiGresku['greska'] = "Uspesno kopiranje";
              $vratiGresku['klasa'] = 'success';
              return $vratiGresku;
      }
       catch(Exception $e){
       // do task when error
       echo $e->getMessage();   // insert query
    }
    
      // print_r($request->all());

    }
    public function androidAplikacije(request $request)
    {
    		if ($request->jezik == 'SRB')
          {
            $apps = DB::select("select aplikacija,prikazni_naziv,android_maska,podsistem,ws_parametar,ws_parametar2,snack_poruka_do,firma, f.naziv as firma_naziv,'' as jezik
              from andr.and_aplikacija a, sis.firme f
              where f.id = a.firma and podsistem = '$request->meni' and a.firma = $request->firma");
        		//$andr = new allApp;
        		//$apps = $andr::where('podsistem',$request->meni)->get();
          }
          else
          {
            $andr = new allApp_en;
            // $apps = $andr::where('podsistem',$request->meni)->where('jezik',$request->jezik)->get();
            $apps = DB::select("
                select e.*,a.firma, f.naziv as firma_naziv from andr.and_aplikacija_en e,andr.and_aplikacija a, sis.firme f
              where a.aplikacija = e.aplikacija
              and f.id = a.firma
              and a.podsistem= '$request->meni'
              and e.jezik = '$request->jezik'
              and a.firma = $request->firma

              ");
          }
    	     return json_encode($apps);
          
  	
    }
    public function androidSveAPlikacije()
    {
            
            $andr = new allApp;
            $apps = $andr->orderby('aplikacija','ASC')->get();

             return json_encode($apps);
    
    }
      public function androidTabovi(request $request)
    {
        
        $andr = new andTab;
        $tab = $andr::where('and_aplikacije_pk',$request->aplikacija)->get();

           return json_encode($tab);
    
    }
     public function androidSviTabovi(request $request)
    {
        
        $andr = new andTab;
        $tab = $andr::distinct()->orderBy('tab_br','asc')->get(['tab_br']);

           return json_encode($tab);
    
    }
      public function taboviFirmaAplikacija(request $request)
    {
        
        $andr = new andTab;
       //$tab = $andr::distinct()->orderBy('tab_br','asc')->get(['tab_br']);
        $tabs = $andr::where('and_aplikacije_pk',$request->aplikacija)->get();

           return json_encode($tabs);
    
    }
       public function taboviCopyPopuniNovuFirmu(request $request)
    {
        
        // $andr = new andTab;

      $tabs = DB::select("select firma from andr.and_aplikacija where aplikacija ='$request->aplikacija'");
      

           return json_encode($tabs);
    
    }
       public function androidTaboviStavke(request $request)
    {
      if (!empty($request->br_taba))
      {
         if ($request->jezik == 'SRB')
          {
            $andr = new andTabStavke;
            $tabStavke = $andr::where('aplikacija',$request->aplikacija)->where('broj_taba',$request->br_taba)->where('firma',$request->firma)->get();
                }
                else
                {
                   $andr = new andTabStavke_en;
                   $tabStavke = DB::select("
                    select a.* from andr.and_aplikacija_stavka l,andr.and_aplikacija_stavka_en  a
                    where a.aplikacija = l.aplikacija
                    and a.stavka = l.stavka
                    and l.broj_taba =$request->br_taba
                    and a.jezik ='$request->jezik'
                    and a.aplikacija = '$request->aplikacija'
                    and l.firma = $request->firma

                    ");
                /*  $tabStavke = $andr::where('aplikacija',$request->aplikacija)->where('broj_taba',$request->br_taba)->where('jezik',$request->jezik)->get();*/
                }

               return json_encode($tabStavke);
          }
          else
          {
                return '{
                    "sEcho": 1,
                    "iTotalRecords": "0",
                    "iTotalDisplayRecords": "0",
                    "aaData": []
                }';
          }
    }
        public function meniUnos(request $request)
    {
        try{
        $obj = new andMeni;     
        $obj ->naziv = $request->naziv;
        $obj ->prikazni_naziv = $request->prikazni_naziv; 
        $obj ->redosled = $request->redosled; 
        
        $obj->save();


        }
    catch(Exception $e){
       // do task when error
       echo $e->getMessage();   // insert query
    }
    
       //return $request->korisnik;
    }
    public function meniIzmena(request $request)
      {
            try{
            //$obj = new andMeni;
            $izmena = 
            andMeni::where('naziv','=',$request->naziv)
            ->update(['prikazni_naziv'=>$request->prikazni_naziv,
                      'redosled'=>$request->redosled]);
         


            }
        catch(Exception $e){
           // do task when error
           echo $e->getMessage();   // insert query
        }

      }
    public function aplikacijaUnos(request $request)
    {
        try{
           if ($request->jezik == 'SRB')
             {
              $obj = new allApp;     
              $obj ->aplikacija = $request->aplikacija;
              $obj ->prikazni_naziv = $request->prikazni_naziv; 
              $obj ->android_maska = $request->android_maska;
              $obj ->ws_parametar = $request->ws_parametar; 
              $obj ->ws_parametar2 = $request->ws_parametar2; 
              $obj ->snack_poruka_do = $request->snack_poruka_do; 
              $obj ->podsistem = $request->podsistem;   
              $obj ->firma = $request->firma; 
              
              $obj->save();
            }
            else
            {
               $obj = new allApp_en;     
                $obj ->aplikacija = $request->aplikacija;
                $obj ->prikazni_naziv = $request->prikazni_naziv; 
               
                $obj ->jezik = $request->jezik;   
                
                $obj->save();
            }

        
        }
    catch(Exception $e){
       // do task when error
       echo $e->getMessage();   // insert query
    }
    
       //return $request->korisnik;
    }

    public function aplikacijaIzmena(request $request)
    {
        try{
            if ($request->jezik == 'SRB')
             {
       $izmena = allApp::where('aplikacija','=',$request->aplikacija)
                ->update([
                  'prikazni_naziv'=>$request->prikazni_naziv,
                  'android_maska'=>$request->android_maska,
                  'ws_parametar'=>$request->ws_parametar,
                  'ws_parametar2'=>$request->ws_parametar2,
                  'snack_poruka_do'=>$request->snack_poruka_do,
                  'podsistem'=>$request->podsistem
                        ]);
              }
              else
              {
          $izmena = allApp_en::where('aplikacija','=',$request->aplikacija)->where('jezik','=',$request->jezik)
                ->update([
                  'prikazni_naziv'=>$request->prikazni_naziv
               
                        ]);
              }

        
        }
    catch(Exception $e){
       // do task when error
       echo $e->getMessage();   // insert query
    }
    
       //return $request->korisnik;
    }
    public function tabUnos(request $request)
    {
        try{
          $obj1 = new andTab;  
          $maxId = $obj1::max('tab_id');
          $noviId = $maxId+1;

        $obj = new andTab;     
        $obj ->tab_id = $noviId;
        $obj ->tab_br = $request->tab_br; 
        $obj ->tab_naziv = $request->tab_naziv;
        $obj ->and_aplikacije_pk = $request->and_aplikacije_pk;  
        $obj->save();

        
        }
    catch(Exception $e){
       // do task when error
       echo $e->getMessage();   // insert query
    }
    
       //return $request->korisnik;
    }
    public function tabIzmena(request $request)
    {
        try{
        $izmena = andTab::where('tab_id','=',$request->tab_id)
                ->update([
                  'tab_br'=>$request->tab_br,
                  'tab_naziv'=>$request->tab_naziv,
                  'and_aplikacije_pk'=>$request->and_aplikacije_pk
                
                        ]);


        
        }
    catch(Exception $e){
       // do task when error
       echo $e->getMessage();   // insert query
    }
    
       //return $request->korisnik;
    }
    public function tabStavkeUnos(request $request)
    {
        try{

          if ($request->jezik == 'SRB')
          {
            // echo "usao";
            $obj = new andTabStavke;    
            
            $obj ->aplikacija = $request->aplikacija;
            $obj ->stavka = $request->stavka; 
            $obj ->grafik = $request->grafik; 
            $obj ->broj_serija = $request->broj_serija; 
            $obj ->serija1_naziv = $request->serija1_naziv; 
            $obj ->serija2_naziv = $request->serija2_naziv; 
            $obj ->serija3_naziv = $request->serija3_naziv; 
            $obj ->naziv_isvestaja = $request->naziv_isvestaja; 
            $obj ->dd_naziv_izvestaja = $request->dd_naziv_izvestaja; 
            $obj ->dd_web_servis = $request->dd_web_servis; 
            $obj ->broj_taba = $request->broj_taba; 
            $obj ->web_servis = $request->web_servis; 
            $obj ->serija4_naziv = $request->serija4_naziv; 
            $obj ->serija5_naziv = $request->serija5_naziv; 
            $obj ->dd_stavka = $request->dd_stavka; 
            $obj ->dd_grafik = $request->dd_grafik; 
            $obj ->dd_br_serija = $request->dd_br_serija; 
            $obj ->dd_serija1_naziv = $request->dd_serija1_naziv; 
            $obj ->dd_serija2_naziv = $request->dd_serija2_naziv; 
            $obj ->dd_serija3_naziv = $request->dd_serija3_naziv; 
            $obj ->dd_serija4_naziv = $request->dd_serija4_naziv; 
            $obj ->dd_serija5_naziv = $request->dd_serija5_naziv; 
            $obj ->firma = $request->firma; 
              try {

                  $obj->save();
              } catch (Exception $e) {
                  echo $e->getMessage(); 
              }
          
          }
          else
          {

            $obj = new andTabStavke_en;     
            $obj ->aplikacija = $request->aplikacija;
            $obj ->stavka = $request->stavka; 
            //$obj ->grafik = $request->grafik; 
            //$obj ->broj_serija = $request->broj_serija; 
            $obj ->serija1_naziv = $request->serija1_naziv; 
            $obj ->serija2_naziv = $request->serija2_naziv; 
            $obj ->serija3_naziv = $request->serija3_naziv; 
            $obj ->naziv_isvestaja = $request->naziv_isvestaja; 
            $obj ->dd_naziv_izvestaja = $request->dd_naziv_izvestaja; 
            //$obj ->dd_web_servis = $request->dd_web_servis; 
            //$obj ->broj_taba = $request->broj_taba; 
            //$obj ->web_servis = $request->web_servis; 
            $obj ->serija4_naziv = $request->serija4_naziv; 
            $obj ->serija5_naziv = $request->serija5_naziv; 
            //$obj ->dd_stavka = $request->dd_stavka; 
            //$obj ->dd_grafik = $request->dd_grafik; 
            //$obj ->dd_br_serija = $request->dd_br_serija; 
            $obj ->dd_serija1_naziv = $request->dd_serija1_naziv; 
            $obj ->dd_serija2_naziv = $request->dd_serija2_naziv; 
            $obj ->dd_serija3_naziv = $request->dd_serija3_naziv; 
            $obj ->dd_serija4_naziv = $request->dd_serija4_naziv; 
            $obj ->dd_serija5_naziv = $request->dd_serija5_naziv; 
            $obj ->jezik = $request->jezik; 
     
            $obj->save();

          }
        
        }
    catch(Exception $e){
       // do task when error
       echo $e->getMessage();   // insert query
    }
    
       //return $request->korisnik;
    }
    public function tabStavkeIzmena(request $request)
    {
        try{
       
   if ($request->jezik == 'SRB')
          {
        $izmena = andTabStavke::where('aplikacija','=',$request->aplikacija)->where('stavka','=',$request->stavka)->where('firma','=',$request->firma)
                ->update([
                   'stavka'=>$request->stavka,
                  'grafik'=>$request->grafik,
                  'broj_serija'=>$request->broj_serija,
                  'serija1_naziv'=>$request->serija1_naziv,
                  'serija2_naziv'=>$request->serija2_naziv,
                  'serija3_naziv'=>$request->serija3_naziv,
                  'naziv_isvestaja'=>$request->naziv_isvestaja,
                  'dd_naziv_izvestaja'=>$request->dd_naziv_izvestaja,
                  'dd_web_servis'=>$request->dd_web_servis,
                  'web_servis'=>$request->web_servis,
                  'serija4_naziv'=>$request->serija4_naziv,
                  'serija5_naziv'=>$request->serija5_naziv,
                  'dd_stavka'=>$request->dd_stavka,
                  'dd_grafik'=>$request->dd_grafik,
                  'dd_br_serija'=>$request->dd_br_serija,
                  'dd_serija1_naziv'=>$request->dd_serija1_naziv,
                  'dd_serija2_naziv'=>$request->dd_serija2_naziv,
                  'dd_serija3_naziv'=>$request->dd_serija3_naziv,
                  'dd_serija4_naziv'=>$request->dd_serija4_naziv,
                  'dd_serija5_naziv'=>$request->dd_serija5_naziv


               
                
                        ]);

              }
              else
              {
                $izmena = andTabStavke_en::where('aplikacija','=',$request->aplikacija)->where('stavka','=',$request->stavka)->where('jezik','=',$request->jezik)
                ->update([
                             'stavka'=>$request->stavka,
              
                            'serija1_naziv'=>$request->serija1_naziv,
                            'serija2_naziv'=>$request->serija2_naziv,
                            'serija3_naziv'=>$request->serija3_naziv,
                            'naziv_isvestaja'=>$request->naziv_isvestaja,
                            'dd_naziv_izvestaja'=>$request->dd_naziv_izvestaja,
            
                    
                            'serija4_naziv'=>$request->serija4_naziv,
                            'serija5_naziv'=>$request->serija5_naziv,
                     
                        
                            'dd_serija1_naziv'=>$request->dd_serija1_naziv,
                            'dd_serija2_naziv'=>$request->dd_serija2_naziv,
                            'dd_serija3_naziv'=>$request->dd_serija3_naziv,
                            'dd_serija4_naziv'=>$request->dd_serija4_naziv,
                            'dd_serija5_naziv'=>$request->dd_serija5_naziv
                          
                        ]);
              }

        
        }
    catch(Exception $e){
       // do task when error
       echo $e->getMessage();   // insert query
    }
    
       //return $request->korisnik;
    }
 //    public function tabStavkeBrisanje(Request $request)
 //    {
 //      try{
 //        $res=andTabStavke::where('broj_taba',$request->tab_br)->where('aplikacija',$request->aplikacija)->delete();
        
 // // Session::flash('success', 'Uspesno obrisano!'); 
 //           }
 //            catch(Exception $e){
 //               // do task when error
 //               echo $e->getMessage();   // insert query
 //            }
    
 //    }
    public function tabBrisanje(Request $request)
    {
      try{
        $res=andTab::where('tab_id',$request->tab_id)->where('and_aplikacije_pk',$request->aplikacija)->delete();
         
           }
            catch(Exception $e){
               // do task when error
               echo $e->getMessage();   // insert query
            }
    
    }
    public function tabStavkaBrisanje(Request $request)
    {
      try{
          if ($request->jezik == 'SRB')
          {
            $res=andTabStavke::where('stavka',$request->stavka)->where('aplikacija',$request->aplikacija)->where('firma',$request->firma)->delete();
          }
          else
          {
            $res=andTabStavke_en::where('stavka',$request->stavka)->where('aplikacija',$request->aplikacija)->where('jezik',$request->jezik)->delete();

          }
         
           }
            catch(Exception $e){
               // do task when error
               echo $e->getMessage();   // insert query
            }
    
    }
    public function aplikacijeBrisanje(Request $request)
    {
      try{
        $res=allApp::where('aplikacija',$request->aplikacija)->delete();
         
           }
            catch(Exception $e){
               // do task when error
               echo $e->getMessage();   // insert query
            }
    
    }
    public function meniBrisanje(Request $request)
    {
      try{
        $res=andMeni::where('naziv',$request->meni)->delete();
         
           }
            catch(Exception $e){
               // do task when error
               echo $e->getMessage();   // insert query
            }
    
    }
}
