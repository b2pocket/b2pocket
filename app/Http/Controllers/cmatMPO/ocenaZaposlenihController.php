<?php

namespace Laravel\Http\Controllers\cmatMPO;

use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;
use Exception;
use DB;
use Illuminate\Database\Eloquent\Model;

use Laravel\cmatMPOApps\ocene\m_ocene_pitanja as pitanja;
use Laravel\cmatMPOApps\ocene\m_ocene_zaposleni as ocene;


class ocenaZaposlenihController extends Controller
{
      public function oceneZaposleniIndex()
    {
      
        return view('cmatMPO/ocenjivanje');      
    
    }
     public function zaposlenjaKadrovi(request $request)
    {
      //['312','265','6120','75','6110']
        
        $andr = new kadrovi;
        $apps = $andr::all();
       // foreach ($apps as $apps) {
        //	$apps->
        //}

           return json_encode($apps);
    
    }

       public function oceneZaposleniSpisak(request $request)
    {
      // $apps = DB::table('cmat.m_ocene_zaposleni')
      //       ->join('cmat.m_ocene_pitanja', 'cmat.m_ocene_pitanja.id', '=', 'cmat.m_ocene_zaposleni.pitanje')
      //        //->where('cmat.m_ocene_zaposleni.kadroviid',$request->kadroviid)->where('cmat.m_ocene_zaposleni.kadroviid',$request->kadroviid)

            
      //       ->select('cmat.m_ocene_zaposleni.*', 'cmat.m_ocene_pitanja.pitanje',DB::raw("

      //         '<select class=\"form-control\">
      //         <option value=\"1\">1</option>
      //         <option  value=\"2\">2</option>
      //         <option  value=\"3\">3</option>
      //         <option  value=\"4\">4</option>
      //         <option  value=\"5\">5</option>
      //       </select>' as ocena2"))
      //       ->get();
      //      $s = html_entity_decode($apps, ENT_QUOTES, 'UTF-8');

      //      return $s;
       if  (isset($request->mesec) and isset($request->kadar)){
      $mesec = $request->mesec;
      $kadar = $request->kadar;
       $apps =  DB::select("select p.*,'<select class=\"form-control\" style=\"max-width:70px;\" id=\"select'||p.id||'\">
              <option value=\"1\">1</option>
              <option  value=\"2\">2</option>
             <option  value=\"3\">3</option>
              <option  value=\"4\">4</option>
          <option  value=\"5\">5</option>
           </select>' as ocena2, '<button type=\"button\" class=\"btn btn-success\" id=\"oceni'||p.id||'\"><i class=\"fas fa-check\"></i></button>' as akc from  cmat.m_ocene_pitanja p  where  p.id not in (select z.pitanje from cmat.m_ocene_zaposleni z where mesec = '$mesec' and kadroviid = $kadar)");
                 return json_encode($apps);
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
     public function ocenjeniSpisak(request $request)
    {
            if  (isset($request->mesec) and isset($request->kadar)){
            $mesec = $request->mesec;
            $kadar = $request->kadar;

                $apps =  DB::select("
          select z.id, k.ime||' '||k.prezime as ime, p.pitanje, z.ocena,z.mesec from cmat.m_ocene_zaposleni z, cmat.kadrovi k, cmat.m_ocene_pitanja p
          where k.id = z.kadroviid 
          and p.id = z.pitanje and z.mesec = '$mesec' and z.kadroviid =$kadar");
                           return json_encode($apps);
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

    public function ocenjivanjeUnos(request $request)
      {



          try{ 

             // $andr = new partneri;
             // $partner = $andr::where('sifkup','=',$request->dobav)->get()->first();
   
              
          $obj = new ocene;  
          $obj->id = DB::raw("nextval('cmat.seq_ocene_zaposleni')");   
          //$obj->orgjed = $request->orgjed;
            //  $obj->orgjed = \Auth::user()->orgjed;
          $obj->pitanje = $request->pitanje;
          $obj->ocena = $request->ocena;
          $obj->mesec = $request->mesec;
          $obj->kadroviid = $request->kadroviid;
           $obj->sis_datum = DB::raw("current_timestamp");
           //$obj ->korisnikuneo = \Auth::user()->id;
         
          // $obj->mesdob = $partner->meskup;
          // $obj->brdok = $request->brdok;
          // $obj->datdok = $request->datdok;
          // $obj->datkal = $request->datkal;
          // $obj->datval = $request->datval;
          // $obj->datum_preuzimanja = DB::raw("current_timestamp");
          // $obj ->korisnik = \Auth::user()->id;
          // $obj->godina_baze = DB::raw("extract(year from current_date)");

          
          $obj->save();


          }
      catch(Exception $e){
         // do task when error
         echo $e->getMessage();   // insert query
      }
      
         //return $request->korisnik;
      }
       public function ocenaBrisanje(request $request)
        {
            try{ 

                 $res=ocene::where('id',$request->pretraga)->delete();

            }
        catch(Exception $e){
           // do task when error
           echo $e->getMessage();   // insert query
        }
        
           //return $request->korisnik;
        }

}
