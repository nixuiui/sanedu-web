<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use Auth;
use Uuid;
use App\Http\Controllers\Controller;
use App\Models\User;

class HomeController extends Controller
{
    public function index() {
        return view('superadmin.index');
    }
}
