<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use Auth;
use Uuid;
use App\Http\Controllers\Controller;
use App\Models\User;

class HomeController extends Controller
{

    public function index() {
        return view('guest.landing.index');
    }

    public function checkrole() {
        if(Auth::check()) {
            if (Auth::user()->id_role == 1001)
            return redirect()->route("superadmin");
            else if(Auth::user()->id_role == 1002)
            return redirect()->route("admin");
            else if(Auth::user()->id_role == 1003)
            return redirect()->route('admintiket');
            else if(Auth::user()->id_role == 1004)
            return redirect()->route('member');
            else if(Auth::user()->id_role == 1005)
            return redirect()->route('guest.home');
            else if(Auth::user()->id_role == 1006)
            return redirect()->route('adminujian');
            else if(Auth::user()->id_role == 1007)
            return redirect()->route('adminsimulasi');
            else if(Auth::user()->id_role == 1008)
            return redirect()->route('pengawas');
            else
            return  "WRONG TURN!";
        }
        return  redirect()->route('guest.home');
    }

    public function tentangkami() {
        return view('guest.landing.tentang');
    }

    public function hubungikami() {
        return view('guest.landing.hubungi');
    }

    public function phpinfo() {
        phpinfo();
    }
}
