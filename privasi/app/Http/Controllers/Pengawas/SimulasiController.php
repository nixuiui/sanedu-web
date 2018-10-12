<?php

namespace App\Http\Controllers\Pengawas;

use Illuminate\Http\Request;
use Auth;
use Uuid;
use App\Http\Controllers\Controller;
use App\Models\Simulasi;
use App\Models\SimulasiPengawas;

class SimulasiController extends Controller
{
    public function index() {
        $pengawas = SimulasiPengawas::select("id_simulasi")->where("id_user", Auth::id())->get();
        $simulasi = Simulasi::whereIn("id", $pengawas)->get();
        return view('pengawas.simulasi.index')->with([
            'simulasi' => $simulasi
        ]);
    }

    public function kelola($id) {
        $simulasi = Simulasi::findOrFail($id);
        return view('pengawas.simulasi.kelola')->with('simulasi', $simulasi);
    }

    public function peserta($id) {
        $simulasi = Simulasi::findOrFail($id);
        return view('pengawas.simulasi.peserta')->with('simulasi', $simulasi);
    }
}
