<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use Auth;
use Uuid;
use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use App\Models\Attempt;
use App\Models\AttemptGroup;
use App\Models\AttemptCorrection;

class UTBKController extends Controller
{

    public function index() {
        return view('guest.utbk.index');
    }

    public function input() {
        if(!isset($_GET['enroll']))
        return view('guest.utbk.input');

        $enrolled = $_GET['enroll'] == 1234;
        if($enrolled) 
        return view('guest.utbk.input')->with([
            'enrolled' => true,
            'provinsi' => Provinsi::all()
        ]);

        return back()->with('danger', 'Kode Enroll Salah');
    }

}
