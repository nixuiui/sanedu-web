<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Auth;
use Uuid;
use PDF;
use DB;
use App\Http\Controllers\Controller;

use App\Models\Universitas;
use App\Models\Ujian;
use App\Models\Attempt;
use App\Models\Simulasi;
use App\Models\SimulasiKoreksi;
use App\Models\SimulasiUjian;
use App\Models\SimulasiJadwalOnline;
use App\Models\SimulasiRuang;
use App\Models\SimulasiPeserta;
use App\Models\PilihanPassingGrade;
use App\Models\Tiket;
use App\Models\GrupChat;
use App\Models\GrupChatMember;

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

        if(!isset($_GET['kap']) && !isset($_GET['pin'])) {
            return view('member.simulasi.register')->with([
                'simulasi' => $simulasi,
            ]);
        }

        $kap = str_replace("-", "", $_GET['kap']);
        $pin = str_replace("-", "", $_GET['pin']);
        $tiket = Tiket::where('pin', $pin)->where('kap', $kap);
        if($tiket->first() == null)
            return redirect()->back()->with('danger', 'Nomor PIN dan KAP tidak tersedia');
        $tiket = $tiket->where('id_user', null);
        if($tiket->first() == null)
            return redirect()->back()->with('danger', 'Nomor tiket sudah digunakan.');
        $tiket = $tiket->first();
        
        $universitas = Universitas::all();
        return view('member.simulasi.register')->with([
            'simulasi' => $simulasi,
            'universitas' => $universitas,
            'tiket' => $tiket
        ]);
    }

    public function registerPost(Request $input, $id) {
        $this->validate($input, [
            'kap'       => 'required|exists:tbl_tiket,kap',
            'pin'       => 'required|exists:tbl_tiket,pin',
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

        //CHECK TIKET
        $tiket = Tiket::where('pin', $input->pin)->where('kap', $input->kap);
        if($tiket->first() == null)
            return redirect()->back()->with('danger', 'Nomor PIN dan KAP tidak tersedia');
        $tiket = $tiket->where('id_user', null);
        if($tiket->first() == null)
            return redirect()->back()->with('danger', 'Anda sudah melakukan pendaftaran, untuk Login silahkan klik link <a href="' . route('auth.login') . '">Login</a> di bawah dengan menggunakan Username dan Password yang telah Anda isi pada kolom pendaftaran');
        $tiket = $tiket->first();
            
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
                $tiket->id_user = Auth::id();
                $tiket->save();
                return redirect()->route('member.simulasi.open', $simulasi->id)->with("success", "Berhasil mendaftar pada Simulasi " . $simulasi->judul);
            }
            else {
                $peserta->delete();
                return back()->with('danger', "Gagal Menyimpan Passing Grade");
            }
        }
        return back()->with('danger', "Gagal Menyimpan Data Peserta");
    }

    public function open($id) {
        $simulasi = Simulasi::findOrFail($id);
        $peserta = SimulasiPeserta::where('id_simulasi', $simulasi->id)
                                    ->where('id_user', Auth::id())
                                    ->first();
        $simulasiUjian = SimulasiUjian::where("id_simulasi", $simulasi->id)
                                        ->where("id_mapel", $peserta->id_mapel)
                                        ->first();

        //GRUP CHAT
        $grupChat = GrupChat::select("id")->where("id_simulasi", $simulasi->id)->get();
        $myGrupChat = GrupChatMember::whereIn("id_grup_chat", $grupChat)
                                ->where("id_user", Auth::id())
                                ->first();
        
        if($peserta) {
            if($peserta->mode_simulasi == "offline") {
                return view('member.simulasi.open')->with([
                    'simulasi' => $simulasi,
                    'simulasiUjian' => $simulasiUjian,
                    'peserta' => $peserta,
                    'myGrupChat' => $myGrupChat
                ]);
        }
        $soalOnline = null;
        if(($peserta->id_jadwal_online != null) && (strtotime($peserta->jadwalOnline->tanggal) == strtotime(date("Y-m-d")))) {
            $soalOnline = SimulasiUjian::where("id_simulasi", $simulasi->id)
            ->where("id_mapel", $peserta->id_mapel)
            ->first();
        }
        return view('member.simulasi.open')->with([
            'simulasi' => $simulasi,
            'simulasiUjian' => $simulasiUjian,
            'peserta' => $peserta,
            'soalOnline' => $soalOnline,
            'myGrupChat' => $myGrupChat
            ]);
        }
        return redirect()->route('member.simulasi');
    }

    public function joinGrupChat($id) {
        $simulasi = Simulasi::findOrFail($id);

        $grupChat = GrupChat::select("id")->where("id_simulasi", $simulasi->id)->get();
        $cekSudahJoin = GrupChatMember::whereIn('id_grup_chat', $grupChat)->where('id_user', Auth::id())->first();
        if($cekSudahJoin != null) return back()->with("danger", "Maaf, Anda sudah bergabung di Grup Chat");
        
        $grup = GrupChat::where('id_simulasi', $simulasi->id)
                        ->where('jumlah_member', '<', 40)
                        ->orderBy('jumlah_member', 'desc')->first();
        if($grup == null)
            return back()->with('danger', "Maaf saat ini Grup Chat WhatsApp belum tersedia");

        $member = new GrupChatMember;
        $member->id = Uuid::generate();
        $member->id_user = Auth::id();
        $member->id_grup_chat = $grup->id;
        if($member->save())
            return back()->with("success", "Berhasil mendapatkan link Grup Chat Whatsapp");
        return back()->with('danger', "Terjadi kesalahan saat ingin join Grup Chat");
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


    public function passGrade($id) {
        $simulasi = Simulasi::find($id);
        if(!$simulasi) return back();
        $peserta = SimulasiPeserta::where('id_simulasi', $simulasi->id)
                                        ->where('id_user', Auth::id())
                                        ->first();
        if(!$peserta)
            return redirect()->route('member.simulasi');
        $universitas = Universitas::all();
        return view('member.simulasi.updatepassgrade')->with([
            'simulasi' => $simulasi,
            'universitas' => $universitas,
            'peserta' => $peserta
        ]);
    }

    public function passGradePost(Request $input, $id) {
        $this->validate($input, [
            'jurusan_1' => 'required|exists:tbl_jurusan,id',
            'jurusan_2' => 'required|exists:tbl_jurusan,id',
            'jurusan_3' => 'required|exists:tbl_jurusan,id',
        ]);

        $simulasi = Simulasi::where('id', $id)->first();
        if(!$simulasi) return back();

        $peserta = SimulasiPeserta::where("id_simulasi", $simulasi->id)
                                    ->where("id_user", Auth::id())
                                    ->first();
        if(!$peserta) return back();

        $passingGrade = PilihanPassingGrade::where("id_peserta", $peserta->id)->first();
        if(!$passingGrade) return back();
        $passingGrade->pilihan_1 = $input->jurusan_1;
        $passingGrade->pilihan_2 = $input->jurusan_2;
        $passingGrade->pilihan_3 = $input->jurusan_3;
        if($passingGrade->save()) {
            return redirect()->route('member.simulasi.open', $simulasi->id)->with("success", "Berhasil menyimpan perubahan pilihan Passing Grade");
        }
        else {
            return back()->with('danger', "Gagal Menyimpan Passing Grade");
        }
    }


    public function attempt($id, $idUjian) {
        $simulasi = Simulasi::findOrFail($id);
        $ujian = Ujian::findOrFail($idUjian);
        $peserta = SimulasiPeserta::where("id_simulasi", $simulasi->id)
                                    ->where("id_user", Auth::id())
                                    ->where("mode_simulasi", "online")
                                    ->where("id_mapel", $ujian->id_mata_pelajaran)
                                    ->firstOrFail();

        $attemptOnGoing = Attempt::where('id_user', Auth::id())
                                    ->where('id_ujian', $ujian->id)
                                    ->where('end_attempt', '>=', date('Y-m-d H:i:s'))
                                    ->first();

        if(($attemptOnGoing != null) || (strtotime($peserta->jadwalOnline->tanggal) != strtotime(date("Y-m-d")))) {
            return redirect()->route('member.simulasi.ujian.open', [
                'id' => $simulasi->id,
                'idAttempt' => $attemptOnGoing->id
            ]);
        }

        $now = date('Y-m-d H:i:s');
        $attempt = new Attempt;
        $attempt->id = Uuid::generate();
        $attempt->start_attempt = $now;
        $attempt->end_attempt = plusMinute($now, $ujian->durasi);
        $attempt->id_ujian = $ujian->id;
        $attempt->id_peserta_simulasi = $peserta->id;
        $attempt->id_user = Auth::id();
        $attempt->jumlah_benar = 0;
        $attempt->jumlah_salah = 0;
        $attempt->jumlah_tidak_jawab = 0;
        $attempt->nilai = 0;
        if($attempt->save()) {
            return redirect()->route('member.simulasi.ujian.open', [
                'id' => $simulasi->id,
                'idAttempt' => $attempt->id
            ]);
        }
        return redirect()->route('member.simulasi.open', $simulasi->id);
    }

    public function openUjian($id, $idAttempt) {
        $simulasi = Simulasi::findOrFail($id);
        $attempt = Attempt::where('id_user', Auth::id())
                        ->where('id', $idAttempt)
                        ->where('end_attempt', '>=', date('Y-m-d H:i:s'))
                        ->first();
        if($attempt == null) return redirect()->route('member.simulasi.open', $simulasi->id);
        $soal = Ujian::findOrFail($attempt->id_ujian);
        return view('member.simulasi.soal')->with([
            'soal' => $soal,
            'attempt' => $attempt,
            'simulasi' => $simulasi
        ]);
    }

    public function finish($id, $idAttempt) {
        $simulasi = Simulasi::findOrFail($id);
        $attempt = Attempt::where('id_user', Auth::id())
                        ->where('id', $idAttempt)
                        ->where('end_attempt', '>=', date('Y-m-d H:i:s'))
                        ->first();
        if($attempt == null) return redirect()->route('member.ujian.soal');
        $attempt->end_attempt = date("Y-m-d H:i:s");
        $attempt->save();
        return view('member.simulasi.finish')->with([
            'simulasi' => $simulasi,
            'attempt' => $attempt
        ]);
    }

    public function lihatHasil($id) {
        $simulasi = Simulasi::findOrFail($id);
        $peserta = SimulasiPeserta::where("id_simulasi", $simulasi->id)
                                    ->where("id_user", Auth::id())
                                    ->firstOrFail();
        $koreksi = SimulasiKoreksi::where("id_peserta", $peserta->id)->orderBy("no_soal", "ASC")->get();
        return view('member.simulasi.lihathasilsementara')->with([
            'simulasi' => $simulasi,
            'peserta' => $peserta,
            'koreksi' => $koreksi
        ]);
    }

}
