<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {        
        if (auth()->check()) {
            return redirect()->route('dashboard');
        } else {
            if (strpos(url()->previous(), 'user') !== false || strpos(url()->previous(), 'lead_manager') !== false) {
                $intendedUrl = url()->previous();
            } else {
                $intendedUrl = route('dashboard');
            }

            session()->put('url.intended', $intendedUrl);

            return view('auth.passwords.email');
        }
    }
}
