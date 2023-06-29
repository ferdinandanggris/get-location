<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Geocoding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    public function receiveLocation(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        
        $geo = new Geocoding(env('GOOGLE_MAPS_API_KEY'));
        $address = $geo->getAddress($latitude, $longitude);
        // Lakukan apa pun yang ingin Anda lakukan dengan data lokasi yang diterima
        // Misalnya, simpan data ke database atau lakukan pemrosesan lainnya
        
        // return response()->json(['success' => true, 'address' => $address]);
        return view('index', ['address' => $address]);
    }
    
}
