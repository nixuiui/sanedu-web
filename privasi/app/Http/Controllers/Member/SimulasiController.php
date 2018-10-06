<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Auth;
use Uuid;
use DB;
use App\Http\Controllers\Controller;

use App\Models\Universitas;
use App\Models\Simulasi;
use App\Models\SimulasiPeserta;
use App\Models\SimulasiPenempatan;
use App\Models\PilihanPassingGrade;

class SimulasiController extends Controller
{
    public function index() {
        if(!isset($_GET['sekolah']))
        return view('member.simulasi.index');

        $simulasi = Simulasi::where("id_tingkat_sekolah", $_GET['sekolah'])->whereIn('id_status', [1902, 1903])->get();
        return view('member.simulasi.index')->with("simulasi", $simulasi);
    }

    public function register($id) {
        $simulasi = Simulasi::find($id);
        if(!$simulasi) return back();

        $isRegistered = SimulasiPeserta::where('id_simulasi', $simulasi->id)
                                        ->where('id_user', Auth::id())
                                        ->first();
        if($isRegistered)
            return redirect()->route('member.simulasi.open', $simulasi->id);

        $universitas = Universitas::all();
        return view('member.simulasi.passgrade')->with([
            'simulasi' => $simulasi,
            'universitas' => $universitas
        ]);
    }

    public function registerPost(Request $input, $id) {
        $this->validate($input, [
            'jurusan'   => 'required|exists:set_pustaka,id',
            'jurusan_1' => 'required|exists:tbl_jurusan,id',
            'jurusan_2' => 'required|exists:tbl_jurusan,id',
            'jurusan_3' => 'required|exists:tbl_jurusan,id',
        ]);

        $simulasi = Simulasi::where('id_status', 1902)->where('id', $id)->first();
        if(!$simulasi) return 7;

        $peserta = SimulasiPeserta::where('id_simulasi', $simulasi->id)->where('id_user', Auth::id())->first();
        if($peserta)
            return redirect()->route('member.simulasi.open', $simulasi->id)->with("success", "Anda sudah mendaftar pada Simulasi " . $simulasi->judul);

        $peserta = new SimulasiPeserta;
        $peserta->id = Uuid::generate();
        $peserta->id_simulasi = $simulasi->id;
        $peserta->id_user = Auth::id();
        $peserta->harga = $simulasi->harga;
        $peserta->no_peserta = time();
        if($peserta->save()) {
            $passingGrade = new PilihanPassingGrade;
            $passingGrade->id = Uuid::generate();
            $passingGrade->id_simulasi = $simulasi->id;
            $passingGrade->pilihan_1 = $input->jurusan_1;
            $passingGrade->pilihan_2 = $input->jurusan_2;
            $passingGrade->pilihan_3 = $input->jurusan_3;
            $passingGrade->jurusan = $input->jurusan;
            if($passingGrade->save()) {
                return redirect()->route('member.simulasi.open', $simulasi->id)->with("success", "Berhasil mendaftar pada Simulasi " . $simulasi->judul);
            }
            else {
                $peserta->delete();
                return back()->with('danger', "Gagal Menyimpan Passing Grade");
            }
        }
        return 0;
    }

    public function open($id) {
        $simulasi = Simulasi::findOrFail($id);
        $penempatan = SimulasiPenempatan::where("id_simulasi", $simulasi->id)->where("id_user", Auth::id())->first();
        return view('member.simulasi.open')->with([
            'simulasi' => $simulasi,
            'penempatan' => $penempatan
        ]);
    }
}
