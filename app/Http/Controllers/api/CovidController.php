<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiHandler;

class CovidController extends Controller
{
    public function getLastMonth(Request $request){
        $days = $request->days + 1;
        $url = "https://corona.lmao.ninja/v2/historical/Indonesia?lastdays=".$days;
        $api = new ApiHandler();
        return $api->getPublic($url);
    }
    public function getLatest(){
        $url = "https://corona.lmao.ninja/v2/countries/Indonesia?yesterday=true&strict=true&query"; 
        $api = new ApiHandler();
        return $api->getPublic($url);
    }
}
