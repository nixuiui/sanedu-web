<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Uuid;
use App\Models\Informasi;
use App\Models\Universitas;
use App\Models\Jurusan;
use App\Models\PassingGradeTahun;
use App\Models\PassingGradeOwned;
use App\Models\PassingGradeVoucher;

class PendampinganController extends Controller
{
    public function index() {
        return view('member.pendampingan.index');
    }
}
