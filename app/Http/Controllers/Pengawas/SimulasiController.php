<?php

namespace App\Http\Controllers\Pengawas;

use Illuminate\Http\Request;
use Auth;
use Uuid;
use App\Http\Controllers\Controller;
use App\Models\Simulasi;
use App\Models\SimulasiKoreksi;
use App\Models\SimulasiPeserta;
use App\Models\SimulasiKunciJawaban;
use App\Models\SimulasiPengawas;

class SimulasiController extends Controller
{
    public function index() {
        $pengawas = SimulasiPengawas::select("id_simulasi")->where("id_user", Auth::id())->get();
        $simulasi = Simulasi::whereIn("id", $pengawas)->orderBy("tanggal_pelaksanaan", "DESC")->get();
        return view('pengawas.simulasi.index')->with([
            'simulasi' => $simulasi
        ]);
    }

    public function kelola($id) {
        $simulasi = Simulasi::findOrFail($id);
        $pengawas = SimulasiPengawas::where('id_simulasi', $simulasi->id)->where('id_user', Auth::id())->first();
        if(!$pengawas) return redirect()->route('pengawas.simulasi');
        return view('pengawas.simulasi.kelola')->with([
            'simulasi' => $simulasi,
            'pengawas' => $pengawas
        ]);
    }

    public function koreksi($id) {
        $simulasi = Simulasi::findOrFail($id);
        $pengawas = SimulasiPengawas::where('id_simulasi', $simulasi->id)->where('id_user', Auth::id())->first();
        $idMapel = $pengawas->id_mapel;
        $peserta = SimulasiPeserta::where('id_simulasi', $simulasi->id)->where("id_ruang", $pengawas->ruang->id)->where('is_corrected', 0)->orderBy("no_peserta", "ASC")->get();
        $kunciJawaban = SimulasiKunciJawaban::where("id_simulasi", $simulasi->id)->where("id_mapel", $idMapel)->get();
        return view('pengawas.simulasi.koreksi')->with([
            'simulasi' => $simulasi,
            'kunciJawaban' => $kunciJawaban,
            'jumlahSoal' => $kunciJawaban->count(),
            'idMapel' => $idMapel,
            'peserta' => $peserta
        ]);
    }

    public function koreksiPost(Request $input, $id) {
        $this->validate($input, [
            'id_mapel'      => 'required|exists:set_pustaka,id',
            'id_peserta'    => 'required|exists:tbl_simulasi_peserta,id',
            'jawaban'       => 'required'
        ]);
        $simulasi = Simulasi::findOrFail($id);
        $pengawas = SimulasiPengawas::where('id_simulasi', $simulasi->id)->where('id_user', Auth::id())->first();
        foreach ($input->jawaban['id_soal'] as $i => $data) {
            $koreksi = new SimulasiKoreksi;
            $koreksi->id = Uuid::generate();
            $koreksi->id_simulasi = $simulasi->id;
            $koreksi->id_peserta = $input->id_peserta;
            $koreksi->id_soal = $input->jawaban['id_soal'][$i];
            $koreksi->no_soal = $input->jawaban['no_soal'][$i];
            $koreksi->jawaban = $input->jawaban['jawaban'][$i];
            $koreksi->kunci_jawaban = $input->jawaban['kunci'][$i];
            if(strtoupper($input->jawaban['jawaban'][$i]) == strtoupper($input->jawaban['kunci'][$i]))
            $koreksi->is_correct = 1;
            $koreksi->save();
        }
        $peserta = SimulasiPeserta::where("id", $input->id_peserta)->first();
        $peserta->is_corrected = 1;
        $peserta->save();
        return back()->with("success", "Berhasil Disimpan");
    }

    public function peserta($id) {
        $simulasi = Simulasi::findOrFail($id);
        return view('pengawas.simulasi.peserta')->with('simulasi', $simulasi);
    }

    public function lihatHasilSementara($id) {
        $simulasi = Simulasi::findOrFail($id);
        $pengawas = SimulasiPengawas::where('id_simulasi', $simulasi->id)->where('id_user', Auth::id())->first();
        $peserta = SimulasiPeserta::where('id_simulasi', $simulasi->id)->where("id_ruang", $pengawas->ruang->id)->where('is_corrected', 1)->orderBy("no_peserta", "ASC")->get();
        return view('pengawas.simulasi.lihathasilsementara')->with([
            'simulasi' => $simulasi,
            'pengawas' => $pengawas,
            'peserta' => $peserta
        ]);
    }
}
