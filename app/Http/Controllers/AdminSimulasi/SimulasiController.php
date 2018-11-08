<?php

namespace App\Http\Controllers\AdminSimulasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Uuid;
use DB;
use PDF;
use Excel;
use App\Models\SetPustaka;
use App\Models\User;
use App\Models\Ujian;
use App\Models\Soal;
use App\Models\Attempt;
use App\Models\AttemptCorrection;
use App\Models\Simulasi;
use App\Models\SimulasiKoreksi;
use App\Models\SimulasiUjian;
use App\Models\SimulasiJadwalOnline;
use App\Models\SimulasiPengawas;
use App\Models\SimulasiPeserta;
use App\Models\SimulasiAgenda;
use App\Models\SimulasiRuang;
use App\Models\SimulasiKunciJawaban;

class SimulasiController extends Controller
{
    public function generateAttempt($id){
	$attempt = Attempt::select(['id_peserta_simulasi'])->whereNotNull("id_peserta_simulasi")->get();
	$peserta = SimulasiPeserta::whereIn('id', $attempt)->update(['is_attempted' => 1]);
    }

    public function index() {
        $simulasi = Simulasi::where('id_creator', Auth::id())->orderby('created_at', 'desc')->get();
        return view('adminsimulasi.simulasi.index')->with([
            'simulasi' => $simulasi
        ]);
    }

    public function tambahForm() {
        $sekolah = SetPustaka::where('id_kategori', 13)->orderBy('id', 'asc')->get();
        return view('adminsimulasi.simulasi.tambah')->with([
            'sekolah' => $sekolah
        ]);
    }

    public function tambahPost(Request $input) {
        $this->validate($input, [
            'id_sekolah'            => 'required|exists:set_pustaka,id',
            'judul'                 => 'required',
            'instansi'              => 'required',
            'tanggal_pengumuman'    => 'required|date',
            'tanggal_pelaksanaan'   => 'required|date',
            'tempat_pelaksanaan'    => 'required',
            'link_soal'             => 'nullable|url',
            'link_pembahasan'       => 'nullable|url',
            'harga'                 => 'required|numeric',
        ]);
        $simulasi = new Simulasi;
        $simulasi->id = UUid::generate();
        $simulasi->id_creator = Auth::id();
        $simulasi->id_tingkat_sekolah = $input->id_sekolah;
        $simulasi->id_jenis_ujian = 1404;
        $simulasi->id_status = 1901;
        $simulasi->judul = $input->judul;
        $simulasi->instansi = $input->instansi;
        $simulasi->tanggal_pelaksanaan = $input->tanggal_pelaksanaan;
        $simulasi->tempat_pelaksanaan = $input->tempat_pelaksanaan;
        $simulasi->tanggal_pengumuman = $input->tanggal_pengumuman;
        $simulasi->link_soal = $input->link_soal;
        $simulasi->link_pembahasan = $input->link_pembahasan;
        $simulasi->harga = $input->harga;
        if($input->featured_image != null) {
            $upload = $this->uploadImage($input->featured_image);
            if($upload->success) $simulasi->featured_image = $upload->filename;
            else return back()->with('danger', 'Gambar tidak terupload');
        }
        $simulasi->save();
        return redirect()->route('adminsimulasi.simulasi.kelola', $simulasi->id)->with('success', 'Simulasi berhasil dibuat');
    }

    public function kelola($id) {
        $simulasi = Simulasi::find($id);
        if(!$simulasi) return redirect()->route('adminsimulasi.simulasi')->with('danger', "Simulasi tidak ditemukan");
        $ruang = SimulasiRuang::where("id_simulasi", $simulasi->id)->get();
        return view('adminsimulasi.simulasi.kelola')->with([
            'simulasi' => $simulasi,
            'ruang' => $ruang
        ]);
    }

    public function editPost(Request $input, $id) {
        $this->validate($input, [
            'judul'                 => 'required',
            'instansi'              => 'required',
            'tanggal_pengumuman'    => 'required|date',
            'tanggal_pelaksanaan'   => 'required|date',
            'tempat_pelaksanaan'    => 'required',
            'harga'                 => 'required|numeric',
            'link_soal'             => 'nullable|url',
            'link_pembahasan'       => 'nullable|url',
        ]);
        $simulasi = Simulasi::find($id);
        $simulasi->judul = $input->judul;
        $simulasi->instansi = $input->instansi;
        $simulasi->tanggal_pelaksanaan = $input->tanggal_pelaksanaan;
        $simulasi->tempat_pelaksanaan = $input->tempat_pelaksanaan;
        $simulasi->tanggal_pengumuman = $input->tanggal_pengumuman;
        $simulasi->link_soal = $input->link_soal;
        $simulasi->link_pembahasan = $input->link_pembahasan;
        $simulasi->harga = $input->harga;
        $simulasi->is_offline = isset($input->offline) ? 1 : 0;
        $simulasi->is_online = isset($input->online) ? 1 : 0;
        if($input->featured_image != null) {
            $upload = $this->uploadImage($input->featured_image);
            if($upload->success) $simulasi->featured_image = $upload->filename;
            else return back()->with('danger', 'Gambar tidak terupload');
        }
        $simulasi->save();
        return redirect()->route('adminsimulasi.simulasi.kelola', $simulasi->id)->with('success', 'Berhasil menyimpan perubahan');
    }

    public function publish($id) {
        $simulasi = Simulasi::find($id);
        $simulasi->id_status = 1902;
        $simulasi->save();
        return redirect()->route('adminsimulasi.simulasi.kelola', $simulasi->id)->with('success', 'Berhasil dipublish');
    }

    public function closeReg($id) {
        $simulasi = Simulasi::find($id);
        $simulasi->id_status = 1903;
        $simulasi->save();
        return redirect()->route('adminsimulasi.simulasi.kelola', $simulasi->id)->with('success', 'Pendaftaran telah ditutup, sudah tidak ada yang bisa mendaftar pada simulasi ini lagi');
    }

    public function deleteSimulasi($id) {
        $simulasi = Simulasi::find($id);
        $simulasi->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus '. $simulasi->judul);
    }

    public function agendaForm($id, $idAgenda = null) {
        $simulasi = Simulasi::findOrFail($id);
        if($idAgenda == null)
        return view('adminsimulasi.simulasi.agendaform')->with([
            'simulasi' => $simulasi
        ]);

        $agenda = SimulasiAgenda::find($idAgenda);
        return view('adminsimulasi.simulasi.agendaform')->with([
            'simulasi' => $simulasi,
            'agenda' => $agenda
        ]);
    }

    public function agendaPost(Request $input, $id, $idAgenda = null) {
        $this->validate($input, [
            'waktu_mulai'   => 'required|date_format:"H:i"',
            'waktu_selesai' => 'required|date_format:"H:i"',
            'nama_agenda'   => 'required',
            'tempat'        => 'required',
            'deskripsi'     => 'required',
        ]);
        $simulasi = Simulasi::findOrFail($id);
        $agenda = new SimulasiAgenda;
        $agenda->id = UUid::generate();
        $agenda->id_simulasi = $simulasi->id;
        if($idAgenda != null) {
            $agenda = SimulasiAgenda::find($idAgenda);
        }
        $agenda->waktu_mulai = $input->waktu_mulai;
        $agenda->waktu_selesai = $input->waktu_selesai;
        $agenda->nama_agenda = $input->nama_agenda;
        $agenda->tempat = $input->tempat;
        $agenda->deskripsi = $input->deskripsi;
        $agenda->save();
        if($input->simpan == "simpan")
        return redirect()->route('adminsimulasi.simulasi.kelola', $simulasi->id)->with('success', 'Berhasil menyimpan agenda');
        return redirect()->route('adminsimulasi.simulasi.kelola.agenda.form', $simulasi->id)->with('success', 'Berhasil menyimpan agenda');
    }

    public function agendaDelete($id, $idAgenda) {
        $agenda = SimulasiAgenda::find($idAgenda);
        $agenda->forceDelete();
        return redirect()->back()->with('success', 'Berhasil menghapus agenda');
    }

    public function jadwal($id, $idJadwal) {
        $simulasi = Simulasi::findOrFail($id);
        $jadwal = SimulasiJadwalOnline::where('id_simulasi', $simulasi->id)
                                        ->where('id', $idJadwal)
                                        ->firstOrFail();
        return view('adminsimulasi.simulasi.jadwal')->with([
            'simulasi' => $simulasi,
            'jadwal' => $jadwal
        ]);
    }

    public function jadwalForm($id, $idJadwal = null) {
        $simulasi = Simulasi::findOrFail($id);
        if($idJadwal == null)
        return view('adminsimulasi.simulasi.jadwalform')->with([
            'simulasi' => $simulasi
        ]);

        $jadwal = SimulasiJadwalOnline::find($idJadwal);
        return view('adminsimulasi.simulasi.jadwalform')->with([
            'simulasi' => $simulasi,
            'jadwal' => $jadwal
        ]);
    }

    public function jadwalPost(Request $input, $id, $idJadwal = null) {
        $this->validate($input, [
            'tanggal'   => 'required|date',
            'kapasitas' => 'required'
        ]);
        $simulasi = Simulasi::findOrFail($id);
        $jadwal = new SimulasiJadwalOnline;
        $jadwal->id = UUid::generate();
        $jadwal->id_simulasi = $simulasi->id;
        if($idJadwal != null) {
            $jadwal = SimulasiJadwalOnline::find($idJadwal);
        }
        $jadwal->tanggal = $input->tanggal;
        $jadwal->kapasitas = $input->kapasitas;
        $jadwal->save();
        if($input->simpan == "simpan")
        return redirect()->route('adminsimulasi.simulasi.kelola', $simulasi->id)->with('success', 'Berhasil menyimpan jadwal online');
        return redirect()->route('adminsimulasi.simulasi.kelola.jadwal.form', $simulasi->id)->with('success', 'Berhasil menyimpan jadwal online');
    }

    public function jadwalDelete($id, $idJadwal) {
        $jadwal = SimulasiJadwalOnline::find($idJadwal);
        $jadwal->forceDelete();
        return redirect()->back()->with('success', 'Berhasil menghapus jadwal online');
    }

    public function pushNilai($id, $idJadwal) {
        $simulasi = Simulasi::findOrFail($id);
        $jadwal = SimulasiJadwalOnline::where('id_simulasi', $simulasi->id)
                                        ->where('id', $idJadwal)
                                        ->firstOrFail();
        $peserta = SimulasiPeserta::where('id_jadwal_online', $jadwal->id)
                                    ->where('is_corrected', false)
                                    ->where('is_attempted', true)
                                    ->get();
        foreach($peserta as $data) {
            $attempt = Attempt::where('id_peserta_simulasi', $data->id)
                                ->orderBy('jumlah_benar', 'asc')
                                ->first();
            $soal = Soal::select(['id', 'created_at'])
                                ->where('id_ujian', $attempt->id_ujian)
                                ->orderBy('created_at', 'asc')
                                ->get();
            foreach($soal as $key => $s) {
                $attemptCorrection = AttemptCorrection::where('id_attempt', $attempt->id)
                                                        ->where('id_soal', $s->id)
                                                        ->first();
                $soalOffline = SimulasiKunciJawaban::where("id_simulasi", $simulasi->id)
                                                    ->where("id_mapel", $data->id_mapel)
                                                    ->where('no', $key+1)
                                                    ->first();
                $koreksi = new SimulasiKoreksi;
                $koreksi->id = Uuid::generate();
                $koreksi->id_simulasi = $simulasi->id;
                $koreksi->id_peserta = $data->id;
                $koreksi->id_soal = $soalOffline->id;
                $koreksi->no_soal = $key + 1;
                $koreksi->kunci_jawaban = $soalOffline->jawaban;
                $koreksi->jawaban = $attemptCorrection == null ? null : $attemptCorrection->jawaban;
                $koreksi->is_correct = $attemptCorrection == null ? false : $attemptCorrection->is_correct;
                $koreksi->save();
            }
            $data->is_corrected = 1;
            $data->save();
        }
        return back()->with('success', 'Proses push nilai berhasil');
    }

    public function ruang($id, $idRuang = null) {
        $simulasi = Simulasi::findOrFail($id);
        if($idRuang == null)
        return view('adminsimulasi.simulasi.ruang')->with('simulasi', $simulasi);

        $ruang = SimulasiRuang::findOrFail($idRuang);
        return view('adminsimulasi.simulasi.ruangview')->with([
            'simulasi' => $simulasi,
            'ruang' => $ruang
        ]);
    }

    public function ruangAbsen($id, $idRuang = null) {
        $simulasi = Simulasi::findOrFail($id);
        $ruang = SimulasiRuang::findOrFail($idRuang);
        if(!$ruang) return back();

        $peserta = DB::select("
                                    SELECT
                                    no_peserta,
                                    user.nama,
                                    user.no_hp,
                                    user.asal_sekolah
                                    FROM
                                    tbl_simulasi_peserta as peserta
                                    INNER JOIN tbl_users as user ON user.id=peserta.id_user
                                    WHERE id_ruang='".$ruang->id."'
                                    ORDER BY user.nama ASC
        ");

        $pesertaArray = [];
        $pesertaArray[] = ['Nama', 'No. Peserta', 'Sekolah', 'Tanda Tangan'];
        foreach ($peserta as $data) {
            $pesertaArray[] = [$data->nama, $data->no_peserta, $data->asal_sekolah, ''];
        }
        Excel::create('Absen ' . $ruang->nama, function($excel) use ($ruang, $pesertaArray) {
            $excel->setTitle('Absen ' . $ruang->nama);
            $excel->setCreator('Sanedu')->setCompany('Niki Rahmadi Wiharto');
            $excel->setDescription('Absen peserta');
            $excel->sheet('sheet1', function($sheet) use ($pesertaArray) {
                    $sheet->fromArray($pesertaArray, null, 'A1', false, false);
            });
        })->download('xlsx');
    }

    public function ruangForm($id, $idRuang = null) {
        $simulasi = Simulasi::findOrFail($id);

        $mapel = "";
        if($simulasi->id_jenis_ujian == 1404)
            $mapel = SetPustaka::whereIn("id", [1516, 1517])->get();

        if($idRuang == null)
        return view('adminsimulasi.simulasi.ruangform')->with([
            'simulasi' => $simulasi,
            'mapel' => $mapel
        ]);

        $ruang = SimulasiRuang::find($idRuang);
        return view('adminsimulasi.simulasi.ruangform')->with([
            'simulasi' => $simulasi,
            'ruang' => $ruang,
            'mapel' => $mapel
        ]);
    }

    public function ruangPost(Request $input, $id, $idRuang = null) {
        $this->validate($input, [
            'nama'      => 'required',
            'kapasitas' => 'required|numeric',
            'alamat'    => 'required',
            'id_mapel'  => 'nullable|exists:set_pustaka,id',
        ]);
        $simulasi = Simulasi::findOrFail($id);
        $ruang = new SimulasiRuang;
        $ruang->id = UUid::generate();
        $ruang->id_mapel = $input->id_mapel;
        $ruang->id_simulasi = $simulasi->id;
        if($idRuang != null) {
            $ruang = SimulasiRuang::find($idRuang);
        }
        $ruang->nama = $input->nama;
        $ruang->kapasitas = $input->kapasitas;
        $ruang->alamat = $input->alamat;
        $ruang->save();
        if($input->simpan == "simpan")
        return redirect()->route('adminsimulasi.simulasi.kelola.ruang', $simulasi->id)->with('success', 'Berhasil menyimpan ruangan');
        return redirect()->route('adminsimulasi.simulasi.kelola.ruang.form', $simulasi->id)->with('success', 'Berhasil menyimpan ruangan');
    }

    public function ruangDelete($id, $idRuang) {
        $ruang = SimulasiRuang::find($idRuang);
        $ruang->forceDelete();
        return redirect()->back()->with('success', 'Berhasil menghapus ruangan');
    }

    public function ruangBorang($id, $idRuang) {
        $ruang = SimulasiRuang::find($idRuang);
        $peserta = SimulasiPeserta::where("id_ruang", $ruang->id)->get();
        $pdf = PDF::loadView('template.borang', compact(['peserta']))->setPaper('a4');
        return $pdf->stream($ruang->nama.' - '.tanggal(date("Y-m-d")).'.pdf');
    }

    public function peserta($id) {
        $simulasi = Simulasi::findOrFail($id);
        $peserta = SimulasiPeserta::where("id_simulasi", $simulasi->id);
        if(isset($_GET['simulasi']))
        $peserta->where('mode_simulasi', $_GET['simulasi']);
        $peserta = $peserta->get();
        return view('adminsimulasi.simulasi.peserta')->with([
            'simulasi' => $simulasi,
            'peserta' => $peserta
        ]);
    }

    public function pesertaSwicthOnlineOffline($id, $idPeserta) {
        $simulasi = Simulasi::findOrFail($id);
        $peserta = SimulasiPeserta::findOrFail($idPeserta);

        if($peserta->mode_simulasi == "offline") {
            $peserta->mode_simulasi = "online";
            $peserta->id_ruang = null;
        }
        else {
            $ruang = SimulasiRuang::where('id_simulasi', $peserta->id_simulasi)
                    ->where('id_mapel', $peserta->id_mapel)
                    ->where('is_full', false)
                    ->orderBy('created_at', 'ASC')
                    ->first();
            if(!$ruang) return back()->with("danger", "Kuota Simulasi Offline belum tersedia atau sudah full, silahkan lakukan pendaftaran saat tiket tersedia kembali");
            $peserta->mode_simulasi = "offline";
            $peserta->id_ruang = $ruang->id;
        }
        $peserta->save();
        return back()->with("success", "Peserta berhasil dipindahkan");
    }

    public function kunciJawaban($id) {
        $simulasi = Simulasi::findOrFail($id);
        $ujian = Ujian::where("id_jenis_ujian", $simulasi->id_jenis_ujian)->get();
        $saintek = SimulasiUjian::where("id_simulasi", $simulasi->id)->where("id_mapel", 1516)->first();
        $soshum = SimulasiUjian::where("id_simulasi", $simulasi->id)->where("id_mapel", 1517)->first();
        return view('adminsimulasi.simulasi.kuncijawaban')->with([
            'simulasi' => $simulasi,
            'ujian' => $ujian,
            'saintek' => $saintek,
            'soshum' => $soshum
        ]);
    }

    public function saveKunciJawaban(Request $input, $id) {
        $this->validate($input, [
            'id_mapel'   => 'nullable|exists:set_pustaka,id',
            'jumlahSoal' => 'required|numeric',
            'jawaban'    => 'required',
        ]);
        $simulasi = Simulasi::findOrFail($id);
        $kunciJawaban = SimulasiKunciJawaban::where("id_simulasi", $simulasi->id)->where('id_mapel', $input->id_mapel)->delete();
        $batas = $input->jumlahSoal < count($input->jawaban) ? $input->jumlahSoal : count($input->jawaban);
        for($i = 0; $i < $batas; $i++) {
            $kunci = new SimulasiKunciJawaban;
            $kunci->id = Uuid::generate();
            $kunci->id_simulasi = $simulasi->id;
            $kunci->id_mapel = $input->id_mapel;
            $kunci->no = $i+1;
            $kunci->jawaban = $input->jawaban[$i];
            $kunci->save();
        }
        return back()->with("success", "Berhasil Menyimpan Kunci Jawaban");
    }

    public function tautSoal(Request $input, $id) {
        $this->validate($input, [
            'id_mapel'  => 'required|exists:set_pustaka,id',
            'id_ujian'  => 'required|exists:tbl_ujian,id',
        ]);
        $simulasi = Simulasi::findOrFail($id);
        $simulasiUjian = SimulasiUjian::where("id_simulasi", $simulasi->id)
                                        ->where("id_mapel", $input->id_mapel)
                                        ->first();
        if(!$simulasiUjian) {
            $simulasiUjian = new SimulasiUjian;
            $simulasiUjian->id = Uuid::generate();
            $simulasiUjian->id_simulasi = $simulasi->id;
            $simulasiUjian->id_mapel = $input->id_mapel;
        }
        $simulasiUjian->id_ujian = $input->id_ujian;
        $simulasiUjian->save();
        return back()->with("success", "Berhasil menyimpan");
    }

    public function reqKunciJawaban($id, $idMapel) {
        $simulasi = Simulasi::find($id);
        if(!$simulasi)
            return $this->error("Data Simulasi tidak ada");
        $kunci = SimulasiKunciJawaban::where("id_simulasi", $simulasi->id)->where("id_mapel", $idMapel)->get();
        return $this->success($kunci);
    }

    public function pengawas($id) {
        $simulasi = Simulasi::findOrFail($id);
        return view('adminsimulasi.simulasi.pengawas')->with('simulasi', $simulasi);
    }

    public function pengawasHapus($id, $idPengawas) {
        $simulasi = Simulasi::findOrFail($id);
        $pengawas = SimulasiPengawas::findOrFail($idPengawas);
        $pengawas->delete();
        return back();
    }

    public function pengawasForm($id, $idPengawas = null) {
        $simulasi = Simulasi::findOrFail($id);
        $ruang = SimulasiRuang::where("id_simulasi", $simulasi->id)->orderBy("id_mapel", "ASC")->get();
        if($idPengawas == null)
        return view('adminsimulasi.simulasi.pengawasform')->with([
            'simulasi' => $simulasi,
            'ruang' => $ruang
        ]);

        $pengawas = SimulasiPengawas::findOrFail($idPengawas);
        return view('adminsimulasi.simulasi.pengawasform')->with([
            'simulasi' => $simulasi,
            'pengawas' => $pengawas,
            'ruang' => $ruang
        ]);
    }

    public function pengawasAddAccount(Request $input, $id) {
        $simulasi = Simulasi::findOrFail($id);
        $this->validate($input, [
            'ruang'             => 'nullable|exists:tbl_simulasi_ruang,id',
            'email'             => 'required',
        ]);
        $user = User::where("id_role", 1008)->where("email", $input->email)->first();
        if(!$user)
        $user = User::where("id_role", 1008)->where("username", $input->email)->first();
        if(!$user)
        return back()->with("danger", "Maaf akun yang Anda masukan belum terdaftar sebagai akun pengawas");

        $pengawas = SimulasiPengawas::where("id_simulasi", $simulasi->id)->where("id_user", $user->id)->first();
        if($pengawas)
        return back()->with("danger", "Maaf akun yang Anda masukan sudah menjadi pengawas pada simulasi ini");

        $ruang = SimulasiRuang::find($input->ruang);

        $pengawas = new SimulasiPengawas;
        $pengawas->id = Uuid::generate();
        $pengawas->id_simulasi = $simulasi->id;
        $pengawas->id_user = $user->id;
        if($ruang) {
            $pengawas->id_ruang = $ruang->id;
            $pengawas->id_mapel = $ruang->id_mapel;
        }
        if($pengawas->save())
            return redirect()->route('adminsimulasi.simulasi.kelola.pengawas', ["id" => $simulasi->id])->with("success", "Berhasil Menambah Pengawas");
        else
            return back()->with("danger", "Gagal menyimpan data pengawas");
    }


    public function pengawasPost(Request $input, $id, $idPengawas = null) {
        $simulasi = Simulasi::findOrFail($id);

        if($idPengawas == null) {
            $this->validate($input, [
                'ruang'             => 'nullable|exists:tbl_simulasi_ruang,id',
                'nama'              => 'required|string|max:255',
                'email'             => 'required|string|email|max:255|unique:tbl_users',
                'username'          => 'required|alpha_dash|unique:tbl_users,username|min:6|max:255',
                'password'          => 'required|string|min:6'
            ]);
            $user           = new User();
            $user->id       = Uuid::generate();
            $user->id_role  = 1008;
            $user->nama     = $input->nama;
            $user->email    = $input->email;
            $user->username = $input->username;
            $user->password = bcrypt($input->password);
            if($user->save()) {
                $ruang = SimulasiRuang::find($input->ruang);
                $pengawas = new SimulasiPengawas;
                $pengawas->id = Uuid::generate();
                $pengawas->id_simulasi = $simulasi->id;
                $pengawas->id_user = $user->id;
                if($ruang) {
                    $pengawas->id_ruang = $ruang->id;
                    $pengawas->id_mapel = $ruang->id_mapel;
                }
                if($pengawas->save()) {
                    return redirect()->route('adminsimulasi.simulasi.kelola.pengawas', ["id" => $simulasi->id])->with("success", "Berhasil Menambah Pengawas");
                }
                else {
                    $user->forceDelete();
                    return back()->with("danger", "Gagal menyimpan data pengawas");
                }
            }
            return back()->with("danger", "Gagal Menambah User");
        }
        else {
            $this->validate($input, [
                'ruang'             => 'nullable|exists:tbl_simulasi_ruang,id',
            ]);
            $pengawas = SimulasiPengawas::findOrFail($idPengawas);
            $ruang = SimulasiRuang::find($input->ruang);
            if($ruang) {
                $pengawas->id_ruang = $ruang->id;
                $pengawas->id_mapel = $ruang->id_mapel;
            }
            if($pengawas->save()) {
                return redirect()->route('adminsimulasi.simulasi.kelola.pengawas', ["id" => $simulasi->id])->with("success", "Berhasil Menyimpan Perubahan");
            }
        }
    }

    public function hasilSementara($id) {
        $simulasi = Simulasi::findOrFail($id);
        $peserta = SimulasiPeserta::where('id_simulasi', $simulasi->id)->where('is_corrected', 1);
        $saintek = SimulasiPeserta::where('id_simulasi', $simulasi->id)->where('is_corrected', 1)->where("id_mapel", 1516)->get()->count();
        $soshum = SimulasiPeserta::where('id_simulasi', $simulasi->id)->where('is_corrected', 1)->where("id_mapel", 1517)->get()->count();
        if(isset($_GET['id_mapel']))
            $peserta = $peserta->where("id_mapel", $_GET['id_mapel']);
        $peserta = $peserta->orderBy("no_peserta", "ASC")->get();
        return view('adminsimulasi.simulasi.lihathasilsementara')->with([
            'simulasi' => $simulasi,
            'peserta' => $peserta,
            'saintek' => $saintek,
            'soshum' => $soshum
        ]);
    }

    public function hasilSementaraDelete($id, $idPeserta) {
        $simulasi = Simulasi::findOrFail($id);
        $peserta = SimulasiPeserta::findOrFail($idPeserta);
        $koreksi = SimulasiKoreksi::where("id_peserta", $idPeserta)->forceDelete();
        $peserta->is_corrected = 0;
        $peserta->save();
        return back()->with("success", "Berhasil Delete");
    }

    public function lihatJawaban($id, $idPeserta) {
        $simulasi = Simulasi::findOrFail($id);
        $peserta = SimulasiPeserta::where("id", $idPeserta)
                                    ->where("is_corrected", 1)
                                    ->first();
        $koreksi = SimulasiKoreksi::where("id_peserta", $peserta->id)->orderBy("no_soal", "ASC")->get();
        return view('adminsimulasi.simulasi.lihatjawaban')->with([
            'simulasi' => $simulasi,
            'peserta' => $peserta,
            'koreksi' => $koreksi
        ]);

    }

    public function deleteJawaban(Request $input, $id) {
        $simulasi = Simulasi::findOrFail($id);
        $koreksi = SimulasiKoreksi::whereIn("id", $input->id)->delete();
        return back();

    }

    public function kartuUjian($id, $idPeserta) {
        $simulasi = Simulasi::findOrFail($id);
        $peserta = SimulasiPeserta::findOrFail($idPeserta);
        $pdf = PDF::loadView('template.kartuujian', compact(['peserta']))->setPaper('a4', 'landscape');
        return $pdf->stream($peserta->mapel->nama.' - '.tanggal($peserta->created_at).'.pdf');
        // return view('member.simulasi.kartuujian')->with([
        //     'peserta' => $peserta
        // ]);
    }

    public function pindahRuang($id) {
        $simulasi = Simulasi::findOrFail($id);
        $ruang = SimulasiRuang::where("id_simulasi", $id)->get();
        $jumlah = 0;
        foreach($ruang as $key => $r) {
            $selisih = $r->jumlah_peserta - $r->kapasitas;
            if(($selisih) > 0) {
                $peserta = SimulasiPeserta::where("id_simulasi", $simulasi->id)
                                            ->where("id_ruang", $r->id)
                                            ->limit($selisih)->update(['id_ruang' => null]);
            }
            $jumlah += $r->jumlah_peserta;
        }

        $peserta = SimulasiPeserta::where("id_simulasi", $simulasi->id)
                            ->where("mode_simulasi", "offline")
                            ->where("id_ruang", NULL)
                            ->get();
        foreach($peserta as $data) {
            $ruang = SimulasiRuang::where('id_simulasi', $simulasi->id)
                    ->where('id_mapel', $data->id_mapel)
                    ->where('is_full', false)
                    ->first();
            if($ruang) {
                $data->id_ruang = $ruang->id;
                $data->save();
            }
        }
        return back();
    }


    public function koreksi($id) {
        $simulasi = Simulasi::findOrFail($id);
        $idMapel = $_GET['idMapel'];
        $peserta = SimulasiPeserta::where('id_simulasi', $simulasi->id)->where("id_mapel", $idMapel)->where('is_corrected', 0)->orderBy("no_peserta", "ASC")->get();
        $kunciJawaban = SimulasiKunciJawaban::where("id_simulasi", $simulasi->id)->where("id_mapel", $idMapel)->get();
        return view('adminsimulasi.simulasi.koreksi')->with([
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

    public function kriteriaSoal($id) {
        $simulasi = Simulasi::findOrFail($id);
        $soalSaintek = SimulasiKunciJawaban::where("id_simulasi", $simulasi->id)
                                ->where("id_mapel", 1516)
                                ->orderBy("no", "ASC")
                                ->get();
        $soalSoshum = SimulasiKunciJawaban::where("id_simulasi", $simulasi->id)
                                ->where("id_mapel", 1517)
                                ->orderBy("no", "ASC")
                                ->get();
        return view("adminsimulasi.simulasi.kriteriasoal")->with([
            'simulasi' => $simulasi,
            'soalSaintek' => $soalSaintek,
            'soalSoshum' => $soalSoshum
        ]);
    }

    public function kriteriaSoalgenerate($id) {
        $soal = SimulasiKunciJawaban::where("id_simulasi", $id)
            ->orderBy("no", "ASC")
            ->get();
        foreach($soal as $s) {
            $benar = SimulasiKoreksi::where("id_soal", $s->id)->where("is_correct", 1)->get()->count();
            $salah = SimulasiKoreksi::where("id_soal", $s->id)->where("is_correct", 0)->get()->count();
            $s->jumlah_benar = $benar;
            $s->jumlah_salah = $salah;
            $s->save();
        }
        return back()->with("success", "Berhasil");
    }

    public function aturPesertaOnline($id) {
        $simulasi = Simulasi::findOrFail($id);
        if(!isset($_GET['no_peserta']))
        return view("adminsimulasi.simulasi.aturpesertaonline")->with([
            'simulasi' => $simulasi
        ]);
        $noPeserta = $_GET['no_peserta'];
        $peserta = SimulasiPeserta::where("id_simulasi", $simulasi->id)
                                    ->where("no_peserta", $noPeserta)
                                    ->get();
        $jadwal = SimulasiJadwalOnline::where("id_simulasi", $simulasi->id)
                                        ->where("is_full", false)
                                        ->get();
        return view("adminsimulasi.simulasi.aturpesertaonline")->with([
            'simulasi' => $simulasi,
            'peserta' => $peserta,
            'jadwal' => $jadwal
        ]);
    }

    public function aturPesertaOnlinePost(Request $input, $id) {
        $this->validate($input, [
            'id_jadwal_online'  => 'required|exists:tbl_simulasi_jadwal_online,id',
            'id_peserta'        => 'required|exists:tbl_simulasi_peserta,id'
        ]);
        $simulasi = Simulasi::findOrFail($id);
        $jadwal = SimulasiJadwalOnline::where("id_simulasi", $simulasi->id)
                                        ->where("id", $input->id_jadwal_online)
                                        ->where("is_full", false)
                                        ->firstOrFail();
        $peserta = SimulasiPeserta::where("id_simulasi", $simulasi->id)
                                    ->where("id", $input->id_peserta)
                                    ->firstOrFail();
        $peserta->mode_simulasi = "online";
        $peserta->id_ruang = null;
        $peserta->id_jadwal_online = $jadwal->id;
        $peserta->save();
        return redirect()->route('adminsimulasi.simulasi.kelola.peserta.online.form', $simulasi->id)->with("success", "Berhasil menyimpan");
    }

    public function downloadPeserta($id) {
        $simulasi = Simulasi::findOrFail($id);
        $where = "id_simulasi='".$simulasi->id."'";
        $title = 'Data Peserta Simulasi ' . $simulasi->judul;
        if(isset($_GET['mode_simulasi'])) {
            $mode = $_GET['mode_simulasi'];
            $where .= " && mode_simulasi='" . $mode . "' ";
            $title .= " " . strtoupper($mode);
        }
        if(isset($_GET['id_mapel'])) {
            $mapel = $_GET['id_mapel'];
            if($mapel == 1516) {
                $where .= " && id_mapel=1516 ";
                $title .= " SAINTEK";
            }
            else if($mapel == 1517) {
                $where .= " && id_mapel=1517 ";
                $title .= " SOSHUM";
            }
        }
        if(isset($_GET['is_attempted'])) {
            $where .= " && is_attempted=0 ";
            $title .= " BELUM UJIAN";
        }
        if(isset($_GET['is_corrected'])) {
            $where .= " && is_corrected=0 ";
            $title .= " BELUM UJIAN";
        }
        $peserta = DB::select("
                        SELECT
                        no_peserta,
                        mode_simulasi,
                        user.nama,
                        user.no_hp,
                        user.asal_sekolah
                        FROM
                        tbl_simulasi_peserta as peserta
                        INNER JOIN tbl_users as user ON user.id=peserta.id_user
                        WHERE
                        " . $where . "
                        ORDER BY user.nama ASC
        ");

        $pesertaArray = [];
        $pesertaArray[] = ['Nama', 'No. Peserta', 'Sekolah', 'No. HP', 'Simulasi'];
        foreach ($peserta as $data) {
            $pesertaArray[] = [strtoupper($data->nama), $data->no_peserta, strtoupper($data->asal_sekolah), $data->no_hp, strtoupper($data->mode_simulasi)];
        }
        Excel::create($title, function($excel) use ($simulasi, $pesertaArray) {
            $excel->setTitle('Data Peserta Simulasi ' . $simulasi->judul);
            $excel->setCreator('Niki Rahmadi Wiharto')->setCompany('Sanedu');
            $excel->setDescription('Data Peserta');
            $excel->sheet('sheet1', function($sheet) use ($pesertaArray) {
                    $sheet->fromArray($pesertaArray, null, 'A1', false, false);
            });
        })->download('xlsx');
    }

    public function downloadBorang($id) {
        $simulasi = Simulasi::findOrFail($id);
        $peserta = SimulasiPeserta::where("id_simulasi", $simulasi->id);
        $title = "Borang Rekomendasi";
        if(isset($_GET['idRuang'])) {
            $ruang = SimulasiRuang::findOrFail($_GET['idRuang']);
            $peserta = $peserta->where("id_ruang", $_GET['idRuang']);
            $title .= " " . $ruang->nama;
        }
        else if(isset($_GET['idJadwal'])) {
            $jadwal = SimulasiJadwalOnline::findOrFail($_GET['idJadwal']);
            $peserta = $peserta->where("id_jadwal_online", $_GET['idJadwal']);
            $title .= " " . $jadwal->tanggal;
        }
        $peserta = $peserta->get();
        $pdf = PDF::loadView('template.borang', compact(['peserta']))->setPaper('a4');
        return $pdf->stream($title . '.pdf');
    }

}
