<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function getState(Request $request){
        $id = $request->query('c_id');

        $states = State::select('id','name')->where('country_id',$id)->get();
        return response()->json($states);
    }
}
