<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Auth;
use Uuid;
use PDF;
use DB;
use App\Http\Controllers\Controller;

use App\Models\Universitas;
use App\Models\Simulasi;
use App\Models\SimulasiRuang;
use App\Models\SimulasiPeserta;
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

        $simulasi = Simulasi::where('id', $id)->first();
        if(!$simulasi) return back();

        $peserta = SimulasiPeserta::where('id_simulasi', $simulasi->id)->where('id_user', Auth::id())->first();
        if($peserta)
            return redirect()->route('member.simulasi.open', $simulasi->id)->with("success", "Anda sudah mendaftar pada Simulasi " . $simulasi->judul);

        $ruang = SimulasiRuang::where('id_simulasi', $simulasi->id)
                                ->where('id_mapel', $input->jurusan)
                                ->where('is_full', false)
                                ->first();
        if(!$ruang)
            return back()->with("danger", "Tiket belum tersedia atau sudah full, silahkan lakukan pendaftaran saat tiket tersedia kembali");

        $checkPeserta = SimulasiPeserta::where('id_simulasi', $simulasi->id)
                                        ->where('id_mapel', $input->jurusan)
                                        ->orderBy('no_peserta', 'desc')
                                        ->first();
        switch ($input->jurusan) {
            case 1516: $kode = 111; break;
            case 1517: $kode = 211; break;
            default: $kode = 311; break;
        }
        if (empty($checkPeserta)) {
			$nomor		= sprintf('%05d', 1);
			$no_peserta	= $kode.'-24-'.$nomor;
		}
		else{
			$pisah		= substr($checkPeserta->no_peserta, -5);
			$str 		= ltrim($pisah, '0');
			$new		= intval($str)+1;
			$nomor		= sprintf('%05d', $new);
			$no_peserta	= $kode.'-24-'.$nomor;
		}

        $peserta = new SimulasiPeserta;
        $peserta->id = Uuid::generate();
        $peserta->id_simulasi = $simulasi->id;
        $peserta->id_user = Auth::id();
        $peserta->id_ruang = $ruang->id;
        $peserta->id_mapel = $input->jurusan;
        $peserta->harga = $simulasi->harga;
        $peserta->no_peserta = $no_peserta;
        if($peserta->save()) {
            $passingGrade = new PilihanPassingGrade;
            $passingGrade->id = Uuid::generate();
            $passingGrade->id_simulasi = $simulasi->id;
            $passingGrade->id_peserta = $peserta->id;
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
        $peserta = SimulasiPeserta::where('id_simulasi', $simulasi->id)
                                    ->where('id_user', Auth::id())
                                    ->first();
        return view('member.simulasi.open')->with([
            'simulasi' => $simulasi,
            'peserta' => $peserta
        ]);
    }

    public function kartuUjian($id) {
        // return $pass = PilihanPassingGrade::find('dde9a3d0-ca82-11e8-9e11-15353a285c9e')->pil1;
        $simulasi = Simulasi::findOrFail($id);
        $peserta = SimulasiPeserta::where('id_simulasi', $simulasi->id)
                                    ->where('id_user', Auth::id())
                                    ->firstOrFail();
        $pdf = PDF::loadView('member.simulasi.kartuujian', compact(['peserta']))->setPaper('a4', 'landscape');
        return $pdf->stream($peserta->mapel->nama.' - '.tanggal($peserta->created_at).'.pdf');
        // return view('member.simulasi.kartuujian')->with([
        //     'peserta' => $peserta
        // ]);
    }
}
