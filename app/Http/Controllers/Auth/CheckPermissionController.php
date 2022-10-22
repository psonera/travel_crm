<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckPermissionController extends Controller
{
    public function check($permission) {
        if (Auth::user()->can($permission))
        {
            // authorized request
            return response()->json('Authorized');
        }
        
        // none authorized request
        return response()->json('Unauthorized Action');
    }
}
