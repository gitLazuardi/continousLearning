<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class CovidController extends Controller
{
    public function getLastMonth(Request $request){
        $days = $request->days + 1;
        $url = "https://corona.lmao.ninja/v2/historical/Indonesia?lastdays=".$days;
        return Http::get($url);
        
    }
    public function getLatest(){
        $url = "https://corona.lmao.ninja/v2/countries/Indonesia?yesterday=true&strict=true&query"; 
        return Http::get($url);
    }
}
