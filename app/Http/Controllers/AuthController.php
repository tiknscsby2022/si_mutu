<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     *  ==============================
     *  ======== AUTHENTICATE ========
     *  ==============================
     */

    public function login() {
        $data = [
            'title' => 'Login | Simutu'
        ];
        return view('login', $data);
    }

    public function authenticate (Request $request) {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();   
            $is_admin = auth()->user()->is_admin;

            if($is_admin == true) {
                return redirect()->route('admin_beranda_show');
            }
            else {
                return redirect()->route('user_dashboard_show');
            }
        }   
        return redirect()->back()->withErrors(
            ['msg' => 'The username or password is incorrect !']
        );             
    }  
    
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
