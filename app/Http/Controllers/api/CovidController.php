<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CovidController extends Controller
{
    public function getLastMonth(Request $request){
        $days = $request->days + 1;
        $url = "https://corona.lmao.ninja/v2/historical/Indonesia?lastdays=".$days;
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);      
        return $output;
    }
    public function getLatest(){
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, "https://corona.lmao.ninja/v2/countries/Indonesia?yesterday=true&strict=true&query"); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);      
        return $output;   
    }
}
