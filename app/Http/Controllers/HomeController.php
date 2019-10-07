<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 'cmat')
        {
        //return view('cmat/home');
             return view('admin/home');
        }
        else if (Auth::user()->role == 'cmatMPO')
        {
           //  return view('cmatMPO/home');
             return view('admin/home');
        }
         else if (Auth::user()->role == 'cmatRADNJA')
        {
         //    return view('cmatRADNJA/home');
             return view('admin/home');
        }
         else if (Auth::user()->role == 'admin')
        {
                // $matea = DB::select ("  select round(sum(a.iznos_bez_pdv)) as  ukupno_godina
                //                 from hel.agg_prodaja_orgjed a
                //                 where EXTRACT(YEAR from  a.datum) = EXTRACT(YEAR from  CURRENT_DATE)
                //                 and datum <= CURRENT_DATE");


                     $result[] = ['Year','HelenaGraf','Matea'];
                    // foreach ($visitor as $key => $value) {
                    //     $result[++$key] = [$value->year, (int)$value->total_click, (int)$value->total_viewer];
                    // }
                    $result[] = ['2018', (int)200, (int)300];
                    $result[] = ['2019', 111147378,232442738];
             return view('admin/homeAdmin')->with('visitor',json_encode($result));;
        }
        else
        {
            return view('admin/home');
        }   
    }
}
