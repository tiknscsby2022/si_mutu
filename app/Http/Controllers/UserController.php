<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Indikator;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard() {
        $data = [
            'title' => 'Dashboard | Simutu',
            'user'  => auth()->user()
        ];
        return view('user.dashboard', $data);
    }

    public function realisasi_show($name){
        $data = [
            'title'         => 'Dashboard | Simutu',
            'user'          => auth()->user(),
            'name'          => $name
        ];
        return view('user.realisasi_per_departemen', $data);
    }
}
