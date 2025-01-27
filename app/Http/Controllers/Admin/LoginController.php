<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view('admin.pages.login.index');
    }


    public function store(Request $request)
    {
        {
            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            $credentials = $request->only('email', 'password');

            if (Auth::guard('admin')->attempt($credentials, $request->input('remember'))) {
                $request->session()->regenerate();

                return redirect()->intended(route('admin.dashboard.index'));
            }

            return back()->withInput($request->only('email', 'remember'))->withErrors(['email' => 'The provided credentials do not match our records.']);
        }
    }
}
