<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use Auth;
use Uuid;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Attempt;
use App\Models\AttemptGroup;
use App\Models\AttemptCorrection;

class HomeController extends Controller
{

    public function generateAttemptGroup(Request $input) {
        $attemptGroup = AttemptGroup::get();
        foreach($attemptGroup as $group) {
            $attempt = Attempt::find($group->id_attempt);
            foreach($attempt->correction as $k => $correction) {
                // echo $k . "<br>";
                // echo $correction->soal . "<br>";
                if($correction->soal) {
                    if($correction->soal->id_ujian_group != null){
                        if($correction->soal->ujianGroup->id == $group->id_ujian_group) {
                            $correction->id_attempt_group = $group->id;
                            $correction->save();
                        }
                    }
                }
            }
        }
    }

    public function index() {
        if(Auth::check()) {
            if (Auth::user()->id_role == 1001)
            return redirect()->route("superadmin");
            else if(Auth::user()->id_role == 1002)
            return redirect()->route("admin");
            else if(Auth::user()->id_role == 1003)
            return redirect()->route('admintiket');
            else if(Auth::user()->id_role == 1004)
            return view('member.index');
            //return redirect()->route('member');
            else if(Auth::user()->id_role == 1005)
            return redirect()->route('user');
            else if(Auth::user()->id_role == 1006)
            return redirect()->route('adminujian');
            else if(Auth::user()->id_role == 1007)
            return redirect()->route('adminsimulasi');
            else if(Auth::user()->id_role == 1008)
            return redirect()->route('pengawas');
            else
            return  "WRONG TURN!";
        }
        return redirect()->route('auth.login');
        return view('guest.landing.index');
    }

    public function test() {
        return view('guest.landing.test');
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
            return  redirect()->route('guest.home');
            else if(Auth::user()->id_role == 1005)
            return redirect()->route('user');
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
