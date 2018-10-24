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
use App\Models\SimulasiJadwalOnline;
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
            'mode'      => 'required|in:offline,online',
            'jurusan'   => 'required|exists:set_pustaka,id',
            'jurusan_1' => 'required|exists:tbl_jurusan,id',
            'jurusan_2' => 'required|exists:tbl_jurusan,id',
            'jurusan_3' => 'required|exists:tbl_jurusan,id',
        ]);
        $simulasi = Simulasi::where('id', $id)->first();
        if(!$simulasi) return back();

        //CHECK SUDAH DAFTAR ATAU BELUM?
        $peserta = SimulasiPeserta::where('id_simulasi', $simulasi->id)->where('id_user', Auth::id())->first();
        if($peserta) return redirect()->route('member.simulasi.open', $simulasi->id)->with("success", "Anda sudah mendaftar pada Simulasi " . $simulasi->judul);

        //CHECK KETERSEDIAAN TIKET
        if($input->mode == "offline") {
            $ruang = SimulasiRuang::where('id_simulasi', $simulasi->id)
                    ->where('id_mapel', $input->jurusan)
                    ->where('is_full', false)
                    ->first();
            if(!$ruang) return back()->with("danger", "Tiket Simulasi Offline belum tersedia atau sudah full, silahkan lakukan pendaftaran saat tiket tersedia kembali");
        }

        //CHECK NO PESERTA YANG TERAKHIR
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
        if($input->mode == 'offline') {
            $peserta->id_ruang = $ruang->id;
            $peserta->mode_simulasi = 'offline';
        }
        else {
            $peserta->mode_simulasi = 'online';
        }
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
        if($peserta)
        return view('member.simulasi.open')->with([
            'simulasi' => $simulasi,
            'peserta' => $peserta
        ]);
        return redirect()->route('member.simulasi');
    }

    public function kartuUjian($id) {
        // return $pass = PilihanPassingGrade::find('dde9a3d0-ca82-11e8-9e11-15353a285c9e')->pil1;
        $simulasi = Simulasi::findOrFail($id);
        $peserta = SimulasiPeserta::where('id_simulasi', $simulasi->id)
                                    ->where('id_user', Auth::id())
                                    ->firstOrFail();
        $pdf = PDF::loadView('template.kartuujian', compact(['peserta']))->setPaper('a4', 'landscape');
        return $pdf->stream($peserta->mapel->nama.' - '.tanggal($peserta->created_at).'.pdf');
        // return view('member.simulasi.kartuujian')->with([
        //     'peserta' => $peserta
        // ]);
    }

    public function aturJadwal(Request $input, $id) {
        $this->validate($input, [
            'jadwal' => 'required|exists:tbl_simulasi_jadwal_online,id',
        ]);
        $simulasi = Simulasi::findOrFail($id);
        $jadwal = SimulasiJadwalOnline::where("id_simulasi", $simulasi->id)
                                        ->where("id", $input->jadwal)
                                        ->where("is_full", false)
                                        ->first();
        if(!$jadwal) return back()->with("danger", "Untuk jadwal pada tanggal " . $jadwal->tanggal . " tidak tersedia, coba tanggal lain");

        $peserta = SimulasiPeserta::where("id_simulasi", $simulasi->id)
                                    ->where("id_user", Auth::id())
                                    ->first();
        $peserta->id_jadwal_online = $jadwal->id;
        if($peserta->save()) return back()->with("success", "Berhasil mengatur jadwal try out online Anda");
        return back();
    }
}
