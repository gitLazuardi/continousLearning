<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CovidController extends Controller
{
    public function getLastMonth(Request $request){
        $days = $request->days + 1;
        return Http::get("https://disease.sh/v3/covid-19/historical/Indonesia", [
            'lastdays' => $days
        ]);
        
    }
    public function getLatest(){
        return Http::get("https://disease.sh/v3/covid-19/countries/Indonesia",[
            'yesterday'=>true,
            'strict'=>true,
            'query'=>true
        ]);
    }
}
