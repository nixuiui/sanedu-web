<?php

namespace App\Http\Controllers\AdminTiket;

use Illuminate\Http\Request;
use Auth;
use Uuid;
use App\Http\Controllers\Controller;
use App\Models\User;

class HomeController extends Controller
{
    public function index() {
        return view('admintiket.index');
    }
}
