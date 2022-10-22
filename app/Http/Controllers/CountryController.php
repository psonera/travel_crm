<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
class CountryController extends Controller
{
    public function getCountry(){
        $contries = Country::select('id','name')->get();
        return response()->json($contries);
    }
}
