<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getcities(Request $request){
        $id = $request->query('c_id');
        $cities = City::select('id','name')->where('state_id',$id)->get();
        return response()->json($cities);
    }
}
