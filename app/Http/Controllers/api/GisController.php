<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pinpoint;
use Illuminate\Http\Request;

class GisController extends Controller
{
    public function index(){
        return response()->json(Pinpoint::all());
    }
    public function store()
    {
        
        $addPin = Pinpoint::create([
            'name' => '',
            'address' => '',
            'city' => '',
            'state' => '',
            'latitude' => request('latitude'),
            'longitude' => request('longitude')
        ]);
       
        return response()->json($addPin);
    }
    public function update()
    {
        $pinPoint = Pinpoint::where('id', '=', request('id'));
        $pinPoint->update([
            'name' => request('name'),
            'address' => request('address'),
            'city' => request('city'),
        ]);  
    }

    public function delete($id)
    {
        $pinPoint = Pinpoint::where('id', '=', $id);
        $pinPoint->delete();
    }
}
