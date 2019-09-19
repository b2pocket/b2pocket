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
         //    return view('cmatRADNJA/home');
             return view('admin/homeAdmin');
        }
        else
        {
            return view('admin/home');
        }   
    }
}
