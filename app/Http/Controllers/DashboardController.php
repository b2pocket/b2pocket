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
}
