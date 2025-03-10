<?php

namespace App\Http\Controllers\AdminSimulasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Uuid;
use DB;
use PDF;
use Excel;
use App\Models\CetakTiket;
use App\Models\Tiket;
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
use App\Models\GrupChat;
use App\Models\GrupChatMember;

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
            'jenis_simulasi'        => 'required|in:online,offline',
        ]);
        $simulasi = new Simulasi;
        $simulasi->id = UUid::generate();
        $simulasi->id_creator = Auth::id();
        $simulasi->id_tingkat_sekolah = $input->id_sekolah;
        $simulasi->id_jenis_ujian = 1404;
        $simulasi->id_status = 1901;
        $simulasi->judul = $input->judul;
        $simulasi->is_offline = $input->jenis_simulasi == 'offline' ? 1 : 0;
        $simulasi->is_online = $input->jenis_simulasi == 'online' ? 1 : 0;
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

        $simulasiSaintek = new SimulasiUjian;
        $simulasiSaintek->id = Uuid::generate();
        $simulasiSaintek->id_simulasi = $simulasi->id;
        $simulasiSaintek->id_mapel = 1516;
        $simulasiSaintek->save();

        $simulasiSoshum = new SimulasiUjian;
        $simulasiSoshum->id = Uuid::generate();
        $simulasiSoshum->id_simulasi = $simulasi->id;
        $simulasiSoshum->id_mapel = 1517;
        $simulasiSoshum->save();

        return redirect()->route('adminsimulasi.simulasi.kelola', $simulasi->id)->with('success', 'Simulasi berhasil dibuat');
    }

    public function kelola($id) {
        $simulasi = Simulasi::find($id);
        if(!$simulasi) return redirect()->route('adminsimulasi.simulasi')->with('danger', "Simulasi tidak ditemukan");
        $ruang = SimulasiRuang::where("id_simulasi", $simulasi->id)->get();
        $jumlahTiket = collect(DB::select(
            "SELECT
            SUM(jumlah_tiket) as jumlah
            FROM
            tbl_cetak_tiket
            WHERE
            id_simulasi='$id' &&
            deleted_at IS NULL"
        ))->first();
        return view('adminsimulasi.simulasi.kelola')->with([
            'simulasi' => $simulasi,
            'ruang' => $ruang,
            'jumlahTiket' => $jumlahTiket
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
            'enroll'                => 'nullable',
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
        $simulasi->enroll = $input->enroll;
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
        foreach($peserta as $index => $data) {
            // if($index == 100) break;
            $attempt = Attempt::where('id_peserta_simulasi', $data->id)
                                ->orderBy('jumlah_benar', 'desc')
                                ->first();
            $ujian = Ujian::findOrFail($attempt->id_ujian);
            
            if(!$ujian->is_grouped) {
                $soal = $ujian->soal->map(function($data) {
                    return [
                        'id' => $data->id
                    ];
                });
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
            }
            else {
                $no = 1;
                foreach($ujian->group as $g) {
                    foreach($g->soal as $s) {
                        $attemptCorrection = AttemptCorrection::where('id_attempt', $attempt->id)
                                                                ->where('id_soal', $s->id)
                                                                ->first();
                        $soalOffline = SimulasiKunciJawaban::where("id_simulasi", $simulasi->id)
                                                            ->where("id_mapel", $data->id_mapel)
                                                            ->where('no', $no)
                                                            ->first();
                        $koreksi = new SimulasiKoreksi;
                        $koreksi->id = Uuid::generate();
                        $koreksi->id_simulasi = $simulasi->id;
                        $koreksi->id_peserta = $data->id;
                        $koreksi->id_soal = $soalOffline->id;
                        $koreksi->no_soal = $no;
                        $koreksi->kunci_jawaban = $soalOffline->jawaban;
                        $koreksi->jawaban = $attemptCorrection == null ? null : $attemptCorrection->jawaban;
                        $koreksi->is_correct = $attemptCorrection == null ? false : $attemptCorrection->is_correct;
                        $koreksi->save();
                        $no++;
                    }
                }
            }
            $data->is_corrected = 1;
            $data->save();
        }
        return back()->with('success', 'Nilai ' . $peserta->count() . ' peserta berhasil disimpan ke hasil sementara');
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
        sekolah.nama as sekolah
        FROM
        tbl_simulasi_peserta as peserta
        INNER JOIN tbl_users as user ON user.id=peserta.id_user
        INNER JOIN tbl_sekolah as sekolah ON sekolah.id=user.id_sekolah
        WHERE id_ruang='".$ruang->id."'
        ORDER BY user.nama ASC
        ");

        $pesertaArray = [];
        $pesertaArray[] = ['Nama', 'No. Peserta', 'Sekolah', 'Tanda Tangan'];
        foreach ($peserta as $data) {
            $pesertaArray[] = [$data->nama, $data->no_peserta, $data->sekolah, ''];
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

    public function pesertaEdit($id, $idPeserta) {
        $simulasi = Simulasi::findOrFail($id);
        $user = SimulasiPeserta::findOrFail($idPeserta)->profil;
        return view('adminsimulasi.simulasi.pesertaedit')->with([
            'simulasi' => $simulasi,
            'user' => $user
        ]);
    }

    public function pesertaDelete($id, $idPeserta) {
        $simulasi = Simulasi::findOrFail($id);
        SimulasiPeserta::findOrFail($idPeserta)->delete();
        return back()->with('success', 'Berhasil Menghapus');
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
        $simulasiUjian = SimulasiUjian::where("id_simulasi", $simulasi->id)->get();
        if(isset($_GET['idMapel']) && ($_GET['idMapel'] != null)) {
            $ujian = Ujian::where("id_jenis_ujian", $simulasi->id_jenis_ujian)->get();
            $ujianSelected = SimulasiUjian::where("id_simulasi", $simulasi->id)->where("id_mapel", $_GET['idMapel'])->first();
            $kunciJawaban = SimulasiKunciJawaban::select(['no', 'jumlah_benar', 'kriteria'])
                                                ->where("id_simulasi", $simulasi->id)
                                                ->where("id_mapel", $_GET['idMapel'])
                                                ->orderBy("jumlah_benar", "DESC")
                                                ->get();
            return view('adminsimulasi.simulasi.kuncijawaban')->with([
                'simulasi' => $simulasi,
                'ujian' => $ujian,
                'ujianSelected' => $ujianSelected,
                'simulasiUjian' => $simulasiUjian,
                'kunciJawaban' => $kunciJawaban
            ]);
        }
        else {
            if($simulasiUjian->count() == 1) {
                return redirect()->route('adminsimulasi.simulasi.kelola.kunci.jawaban', ['id' => $simulasi->id, 'idMapel' => $simulasiUjian[0]->id_mapel]);
            }
            else {
                return view('adminsimulasi.simulasi.kuncijawaban')->with([
                    'simulasi' => $simulasi,
                    'simulasiUjian' => $simulasiUjian
                ]);
            }
        }
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
            $kunci              = new SimulasiKunciJawaban;
            $kunci->id          = Uuid::generate();
            $kunci->id_simulasi = $simulasi->id;
            $kunci->id_mapel    = $input->id_mapel;
            $kunci->no          = $i+1;
            $kunci->jawaban     = $input->jawaban[$i];
            $kunci->save();
        }
        return back()->with("success", "Berhasil Menyimpan Kunci Jawaban");
    }

    public function simpanLinkSoal(Request $input, $id, $idMapel) {
        $this->validate($input, [
            'link_soal'             => 'nullable|url',
            'link_pembahasan'       => 'nullable|url'
        ]);
        $simulasi = Simulasi::findOrFail($id);
        $simulasiUjian = SimulasiUjian::where("id_simulasi", $simulasi->id)->where("id_mapel", $idMapel)->firstOrFail();
        $simulasiUjian->link_soal = $input->link_soal;
        $simulasiUjian->link_pembahasan = $input->link_pembahasan;
        $simulasiUjian->save();
        return redirect()->route('adminsimulasi.simulasi.kelola.kunci.jawaban', ['id' => $simulasi->id, 'idMapel' => $idMapel])->with('success', 'Berhasil menyimpan perubahan');
    }

    public function tautSoal(Request $input, $id) {
        $this->validate($input, [
            'id_mapel'  => 'required|exists:set_pustaka,id',
            'id_ujian'  => 'required|exists:tbl_ujian,id',
        ]);
        $simulasi   = Simulasi::findOrFail($id);
        $ujian      = Ujian::findOrFail($input->id_ujian);
        $simulasiUjian = SimulasiUjian::where("id_simulasi", $simulasi->id)
                                        ->where("id_mapel", $input->id_mapel)
                                        ->first();
        if(!$simulasiUjian) {
            $simulasiUjian = new SimulasiUjian;
            $simulasiUjian->id = Uuid::generate();
            $simulasiUjian->id_simulasi = $simulasi->id;
            $simulasiUjian->id_mapel = $input->id_mapel;
        }
        $simulasiUjian->id_ujian = $ujian->id;
        $simulasiUjian->save();
        
        $kunciJawaban = SimulasiKunciJawaban::where("id_simulasi", $simulasi->id)->where('id_mapel', $input->id_mapel)->delete();
        if(!$ujian->is_grouped) {
            foreach($ujian->soal as $i => $soal) {
                $kunci              = new SimulasiKunciJawaban;
                $kunci->id          = Uuid::generate();
                $kunci->id_simulasi = $simulasi->id;
                $kunci->id_mapel    = $input->id_mapel;
                $kunci->no          = $i+1;
                $kunci->jawaban     = $soal->jawaban;
                $kunci->save();
            }
        }
        else {
            $no = 1;
            foreach($ujian->group as $group) {
                foreach($group->soal as $soal) {
                    $kunci              = new SimulasiKunciJawaban;
                    $kunci->id          = Uuid::generate();
                    $kunci->id_simulasi = $simulasi->id;
                    $kunci->id_mapel    = $input->id_mapel;
                    $kunci->no          = $no;
                    $kunci->jawaban     = $soal->jawaban;
                    $kunci->save();
                    $no++;
                }
            }
        }

        return back()->with("success", "Berhasil menautkan soal");
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
        return redirect()->route('adminsimulasi.simulasi.kelola.fill.kriteria.soal', $id);
    }

    public function kriteriaSoalFill($id) {
        $simulasi = Simulasi::findOrFail($id);
        $saintek = SimulasiKunciJawaban::where("id_simulasi", $simulasi->id)
                                        ->where("id_mapel", 1516)
                                        ->orderBy("jumlah_benar", "DESC")
                                        ->get();
        $soshum = SimulasiKunciJawaban::where("id_simulasi", $simulasi->id)
                                        ->where("id_mapel", 1517)
                                        ->orderBy("jumlah_benar", "DESC")
                                        ->get();

        //SAINTEK
        $mudah = $saintek->count() * (40/100);
        $sedang = $mudah + $saintek->count() * (40/100);
        $sulit = $sedang + $saintek->count() * (20/100);
        foreach ($saintek as $index => $data) {
            $kriteria = ($index+1) <= $mudah ? "mudah" : (($index+1) <= $sedang ? "sedang" : "sulit");
            $data->kriteria = $kriteria;
            $data->save();
        }

        //SOSHUM
        $mudah = $soshum->count() * (40/100);
        $sedang = $mudah + $soshum->count() * (40/100);
        $sulit = $sedang + $soshum->count() * (20/100);
        foreach ($soshum as $index => $data) {
            $kriteria = ($index+1) <= $mudah ? "mudah" : (($index+1) <= $sedang ? "sedang" : "sulit");
            $data->kriteria = $kriteria;
            $data->save();
        }

        return redirect()->route('adminsimulasi.simulasi.kelola.kriteria.soal', $simulasi->id)->with("success", "Proses Generate Berhasil");
    }

    public function hitungNilaiAkhir($id) {
        $simulasi = Simulasi::findOrFail($id);
        $pesertaSaintek = collect(DB::select("
                SELECT
                peserta.id,
                no_peserta,
                user.nama
                FROM
                tbl_simulasi_peserta as peserta
                INNER JOIN tbl_users as user ON user.id=peserta.id_user
                WHERE
                is_corrected=1 AND
                id_simulasi='" . $simulasi->id . "' AND
                id_mapel=1516
                ORDER BY no_peserta ASC
        "));
        $pesertaSoshum = collect(DB::select("
                SELECT
                peserta.id,
                no_peserta,
                user.nama
                FROM
                tbl_simulasi_peserta as peserta
                INNER JOIN tbl_users as user ON user.id=peserta.id_user
                WHERE
                is_corrected=1 AND
                id_simulasi='" . $simulasi->id . "' AND
                id_mapel=1517
                ORDER BY no_peserta ASC
        "));
        return view('adminsimulasi.simulasi.hitungnilaiakhir')->with([
            'simulasi' => $simulasi,
            'saintek' => $pesertaSaintek,
            'soshum' => $pesertaSoshum
        ]);
    }

    public function hitungNilaiAkhirPeserta($id, $idPeserta) {
        $simulasi = Simulasi::findOrFail($id);
        $peserta = SimulasiPeserta::findOrFail($idPeserta);
        $kunciJawaban = SimulasiKunciJawaban::where("id_simulasi", $simulasi->id)
                                            ->where("id_mapel", $peserta->id_mapel)
                                            ->get();
        $nilai = 0;
        $kriteria = "";
        $jumlahSoal = $kunciJawaban->count();
        $mudah = 0.6;
        $sedang = 0.8;
        $sulit = 1;
        $potensiNilai = (0.2*$jumlahSoal*$sulit)+(0.4*$jumlahSoal*$sedang)+(0.4*$jumlahSoal*$sulit);
        foreach($peserta->koreksi as $data) {
            if($data->is_correct) {
                switch ($data->soal->kriteria) {
                    case 'sulit':
                        $kriteria = "sulit";
                        $nilai += $sulit;
                        break;
                    case 'sedang':
                        $kriteria = "sedang";
                        $nilai += $sedang;
                        break;
                    case 'mudah':
                        $kriteria = "mudah";
                        $nilai += $mudah;
                        break;
                    default:
                        $nilai += 0;
                        $kriteria = "";
                        break;
                }
                $data->kriteria = $kriteria;
                $data->save();
            }
        }
        $nilai = ($nilai/$potensiNilai)*100;
        if($nilai >= $peserta->passingGrade->pilihan1->passing_grade) {
            $peserta->id_passing_grade_lolos = $peserta->passingGrade->pilihan1->id;
        }
        else if($nilai >= $peserta->passingGrade->pilihan2->passing_grade) {
            $peserta->id_passing_grade_lolos = $peserta->passingGrade->pilihan2->id;
        }
        else if($nilai >= $peserta->passingGrade->pilihan3->passing_grade) {
            $peserta->id_passing_grade_lolos = $peserta->passingGrade->pilihan3->id;
        }
        $peserta->nilai_akhir = round($nilai, 2);
        if($peserta->save()) {
            return response()->json([
                'success' => true,
                'nilai' => round($nilai, 2),
                'message' => "Success"
            ]);
        }
        return response()->json([
            'success' => false,
            'nilai' => 0,
            'message' => "Failed"
        ]);
    }

    public function generatePeringkat($id) {
        $simulasi = Simulasi::findOrFail($id);
        $pesertaSaintek = collect(DB::select("
                SELECT
                peserta.id,
                no_peserta,
                user.nama,
                nilai_akhir
                FROM
                tbl_simulasi_peserta as peserta
                INNER JOIN tbl_users as user ON user.id=peserta.id_user
                WHERE
                is_corrected=1 AND
                id_simulasi='" . $simulasi->id . "' AND
                id_mapel=1516
                ORDER BY nilai_akhir DESC
        "));
        $pesertaSoshum = collect(DB::select("
                SELECT
                peserta.id,
                no_peserta,
                user.nama,
                nilai_akhir
                FROM
                tbl_simulasi_peserta as peserta
                INNER JOIN tbl_users as user ON user.id=peserta.id_user
                WHERE
                is_corrected=1 AND
                id_simulasi='" . $simulasi->id . "' AND
                id_mapel=1517
                ORDER BY nilai_akhir DESC
        "));
        return view('adminsimulasi.simulasi.peringkat')->with([
            'simulasi' => $simulasi,
            'saintek' => $pesertaSaintek,
            'soshum' => $pesertaSoshum
        ]);
    }

    public function generatePeringkatPeserta($id, $idPeserta) {
        if(isset($_GET['peringkat'])) {
            $simulasi = Simulasi::findOrFail($id);
            $peserta = SimulasiPeserta::findOrFail($idPeserta);
            $peserta->peringkat = $_GET['peringkat'];
            if($peserta->save()) {
                return response()->json([
                    'success' => true,
                    'peringkat' => $_GET['peringkat'],
                    'message' => "Success"
                ]);
            }
            return response()->json([
                'success' => false,
                'peringkat' => null,
                'message' => "Gagal menyimpan"
            ]);
        }
        return response()->json([
            'success' => false,
            'peringkat' => null,
            'message' => "Peringkat tidak diketahui"
        ]);

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
        user.email,
        user.no_hp,
        sekolah.nama as sekolah
        FROM
        tbl_simulasi_peserta as peserta
        INNER JOIN tbl_users as user ON user.id=peserta.id_user
        INNER JOIN tbl_sekolah as sekolah ON sekolah.id=user.id_sekolah
        WHERE
        " . $where . "
        ORDER BY user.nama ASC
        ");

        $pesertaArray = [];
        $pesertaArray[] = ['Nama', 'No. Peserta', 'Sekolah', 'No. HP', 'Email', 'Simulasi'];
        foreach ($peserta as $data) {
            $pesertaArray[] = [strtoupper($data->nama), $data->no_peserta, strtoupper($data->sekolah), $data->no_hp, $data->email, strtoupper($data->mode_simulasi)];
        }
        Excel::create($title, function($excel) use ($simulasi, $title, $pesertaArray) {
            $excel->setTitle($title);
            $excel->setCreator('Niki Rahmadi Wiharto')->setCompany('Sanedu');
            $excel->setDescription('Data Peserta');
            $excel->sheet('sheet1', function($sheet) use ($pesertaArray) {
                $sheet->fromArray($pesertaArray, null, 'A1', false, false);
            });
        })->download('xlsx');
    }
    
    public function downloadHasilAkhir($id) {
        $simulasi = Simulasi::findOrFail($id);
        $where = "id_simulasi='".$simulasi->id."'";
        $peserta = SimulasiPeserta::where("id_simulasi", $simulasi->id);
        if(isset($_GET['idMapel']) && $_GET['idMapel'] != null) {
            $peserta = $peserta->where("id_mapel", $_GET['idMapel'])
                                ->whereNotNull("nilai_akhir");
        }
        $peserta = $peserta->orderBy("peringkat", "ASC")->get()->map(function($data) {
            return [
                'no_peserta' => $data->no_peserta,
                'mode_simulasi' => $data->mode_simulasi,
                'jumlah_benar' => strval($data->jumlah_benar),
                'jumlah_salah' => strval($data->jumlah_salah),
                'peringkat' => strval($data->peringkat),
                'nilai_akhir' => strval($data->nilai_akhir),
                'nama' => $data->profil->nama,
                'no_hp' => $data->profil->no_hp,
                'sekolah' => $data->profil->sekolah->nama,
                'passgrade' => $data->id_passing_grade_lolos != null ? "Lulus di " . $data->passingGradeLolos->jurusan . " " . $data->passingGradeLolos->universitas->nama : "Belum Lulus"
            ];
        });

        $title = 'Data Nilai Akhir Peserta Simulasi ' . $simulasi->judul;

        $pesertaArray = [];
        $pesertaArray[] = ['Nama', 'No. Peserta', 'Sekolah', 'No. HP', 'Simulasi', 'Benar', 'Salah', 'Nilai Akhir', 'Peringkat', 'Keterangan'];
        foreach ($peserta as $data) {
            $pesertaArray[] = [
                strtoupper($data['nama']), 
                $data['no_peserta'], 
                strtoupper($data['sekolah']), 
                $data['no_hp'], 
                strtoupper($data['mode_simulasi']), 
                $data['jumlah_benar'], 
                $data['jumlah_salah'], 
                $data['nilai_akhir'], 
                $data['peringkat'], 
                $data['passgrade']
            ];
        }
        Excel::create($title, function($excel) use ($simulasi, $title, $pesertaArray) {
            $excel->setTitle($title);
            $excel->setCreator(Auth::user()->nama)->setCompany('Sanedu');
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
        else if(isset($_GET['idMapel'])) {
            $peserta = $peserta->where("id_mapel", $_GET['idMapel']);
            if(isset($_GET['cluster'])) {
                $peserta = $peserta->skip(($_GET['cluster']-1)*50)->limit(50);
            }
        }
        else if(isset($_GET['idPeserta'])) {
            $peserta = $peserta->where("id", $_GET['idPeserta']);
        }
        $peserta = $peserta->orderBy("no_peserta", "asc")->get();
        $pdf = PDF::loadView('template.borang', compact(['peserta']))->setPaper('a4');
        return $pdf->stream($title . '.pdf');
    }

    public function borangRekomendasi($id) {
        $simulasi = Simulasi::findOrFail($id);
        $saintek = SimulasiPeserta::where("id_simulasi", $simulasi->id)
                                    ->where("id_mapel", 1516)
                                    ->get()->count();
        $soshum = SimulasiPeserta::where("id_simulasi", $simulasi->id)
                                    ->where("id_mapel", 1517)
                                    ->get()->count();

        return view("adminsimulasi.simulasi.borangrekomendasi")->with([
            'simulasi' => $simulasi,
            'saintek' => ceil($saintek/50),
            'soshum' => ceil($soshum/50)
        ]);

    }

    public function tiket($id) {
        $simulasi = Simulasi::findOrFail($id);
        $cetakTiket = CetakTiket::where("id_simulasi", $simulasi->id)
                                ->orderBy("created_at", "desc")
                                ->get();
        $jumlahTiket = collect(DB::select(
            "SELECT
            SUM(jumlah_tiket) as jumlah
            FROM
            tbl_cetak_tiket
            WHERE
            id_simulasi='$id' &&
            deleted_at IS NULL"
        ))->first();
        $jumlahPeserta = SimulasiPeserta::where("id_simulasi", $simulasi->id)
                                    ->get()->count();
        return view('adminsimulasi.simulasi.tiket')->with([
            "simulasi" => $simulasi,
            "cetakTiket" => $cetakTiket,
            "jumlahTiket" => $jumlahTiket->jumlah,
            "jumlahPeserta" => $jumlahPeserta
        ]);
    }

    public function tiketDetail($id, $idCetak = null) {
        $simulasi = Simulasi::findOrFail($id);
        $tiket = Tiket::where("id_simulasi", $id)->get();
        if($idCetak != null)
        $tiket = Tiket::where("id_simulasi", $id)->where("id_cetak_tiket", $idCetak)->get();
        if(isset($_GET['pin']))
        $tiket = Tiket::where("id_simulasi", $id)->where("pin", $_GET['pin'])->get();
        return view('adminsimulasi.simulasi.tiketdetail')->with([
            "simulasi" => $simulasi,
            "tiket" => $tiket
        ]);
    }



    public function customTiket(Request $input, $id) {
        $this->validate($input, [
            'featured_image'        => 'required'
        ]);
        $simulasi = Simulasi::find($id);
        if($input->featured_image != null) {
            $upload = $this->uploadImage($input->featured_image);
            if($upload->success) $simulasi->gambar_tiket = $upload->filename;
            else return back()->with('danger', 'Gambar tidak terupload');
        }
        $simulasi->save();
        return redirect()->route('adminsimulasi.simulasi.kelola.tiket', $simulasi->id)->with('success', 'Berhasil menyimpan perubahan');
    }

    public function generateTiket(Request $input, $id){
        $simulasi = Simulasi::findOrFail($id);
        $this->validate($input, [
            'jumlah'            => 'required|max:1000|numeric',
        ]);
        $cetakTiket                     = new CetakTiket;
        $cetakTiket->id                 = Uuid::generate();
        $cetakTiket->id_kategori_tiket  = 1101;
        $cetakTiket->id_user            = Auth::id();
        $cetakTiket->id_simulasi        = $simulasi->id;
        if($cetakTiket->save()) {
            foreach (range(1,$input->jumlah) as $i => $key) {
                $date                       = date("ymdhis");
                $pin                        = 1 . date("y") . substr($date, -2) . substr($date, -6, 2) . substr(time(), -6, 2) . substr(time(), -1) .  randomNumber(3) . angkaUrut($i);
                $tiket                      = new Tiket;
                $tiket->id                  = Uuid::generate();
                $tiket->id_kategori_tiket   = 1101;
                $tiket->id_cetak_tiket      = $cetakTiket->id;
                $tiket->id_simulasi         = $simulasi->id;
                $tiket->pin                 = $pin;
                $tiket->save();
            }
        }
        return back()->with('success', 'Tiket berhasil dibuat.');
    }

    public function deleteCetakTiket($id, $idCetakTiket) {
        $cetakTiket = CetakTiket::findOrFail($idCetakTiket);
        $cetakTiket->delete();
        return back()->with('success', 'Berhasil Menghapus.');
    }

    public function printTiket($id, $idCetakTiket) {
        $paperSize = isset($_GET['paperSize']) && $_GET['paperSize'] ? $_GET['paperSize'] : 'a4';
        $simulasi = Simulasi::findOrFail($id);
        $cetakTiket = CetakTiket::findOrFail($idCetakTiket);
        $tiket      = Tiket::where('id_cetak_tiket', $cetakTiket->id)->get();
        // return view("template.tiket.legacy-2019-$paperSize")->with('tiket', $tiket);
        $pdf = PDF::loadView("template.tiket.legacy-2019-$paperSize", compact(['tiket', 'simulasi']))->setPaper($paperSize);
        return $pdf->stream("Tiket Peserta " . $simulasi->judul.' - '.tanggal($cetakTiket->created_at).'.pdf');
    }

    public function hapusPeserta($id, $idTiket) {
        $tiket = Tiket::where("id_simulasi", $id)->where("id", $idTiket)->first();
        if($tiket){
            $simulasi = SimulasiPeserta::where("id_simulasi", $id)->where("id_user", $tiket->id_user)->first();
            if($simulasi) $simulasi->forceDelete();
            $tiket->id_user = null;
            $tiket->save();
        }
        return redirect()->route('adminsimulasi.simulasi.kelola.tiket', $id)->with('success', 'Berhasil menghapus peserta');
    }

    public function grupChat($id) {
        $simulasi = Simulasi::findOrFail($id);
        $grub = GrupChat::where('id_simulasi', $simulasi->id)
                            ->orderBy("jumlah_member", "desc")
                            ->orderBy("created_at", "asc")
                            ->get();
        return view('adminsimulasi.simulasi.grupchat')->with([
            'grub' => $grub,
            'simulasi' => $simulasi
        ]);
    }

    public function grupChatTambah($id) {
        $simulasi = Simulasi::findOrFail($id);
        return view('adminsimulasi.simulasi.grupchattambah')->with([
            'simulasi' => $simulasi
        ]);
    }

    public function grupChatTambahPost(Request $input, $id) {
        $this->validate($input, [
            'nama'      => 'required|string|max:255',
            'link'      => 'required|url',
        ]);
        $simulasi = Simulasi::findOrFail($id);
        $grup = new GrupChat;
        $grup->id = Uuid::generate();
        $grup->id_simulasi = $simulasi->id;
        $grup->nama = $input->nama;
        $grup->link = $input->link;
        if($grup->save())
            return redirect()->route('adminsimulasi.simulasi.kelola.grupchat', $simulasi->id)->with('success', 'Berhasil menambah Grup Chat');
        return back()->with('danger', 'Terjadi kesalahan saat menambah Grup Chat');
    }

    public function grupChatView($id, $idGrup) {
        $simulasi = Simulasi::findOrFail($id);
        $grup = GrupChat::findOrFail($idGrup);
        $member = GrupChatMember::where("id_grup_chat", $grup->id)->get();
        return view('adminsimulasi.simulasi.grupchatview')->with([
            'simulasi' => $simulasi,
            'grup' => $grup,
            'member' => $member
        ]);
    }

    public function grupChatEdit($id, $idGrup) {
        $simulasi = Simulasi::findOrFail($id);
        $grup = GrupChat::findOrFail($idGrup);
        return view('adminsimulasi.simulasi.grupchatedit')->with([
            'simulasi' => $simulasi,
            'grup' => $grup
        ]);
    }

    public function grupChatEditPost(Request $input, $id, $idGrup) {
        $this->validate($input, [
            'nama'  => 'required|string|max:255',
            'link'  => 'required|url',
        ]);
        $simulasi = Simulasi::findOrFail($id);
        $grup = GrupChat::findOrFail($idGrup);
        $grup->nama = $input->nama;
        $grup->link = $input->link;
        if($grup->save())
            return redirect()->route('adminsimulasi.simulasi.kelola.grupchat', $simulasi->id)->with('success', 'Berhasil menambah Grup Chat');
        return back()->with('danger', 'Terjadi kesalahan saat menambah Grup Chat');
    }

    public function grupChatDelete($id, $idGrup) {
        $simulasi = Simulasi::findOrFail($id);
        $grup = GrupChat::findOrFail($idGrup);
        if($grup->delete())
            return back()->with('success', 'Berhasil menghapus Grup Chat');
        return back()->with('danger', 'Terjadi kesalahan saat menghapus Grup Chat');
    }

    public function grupChatKick($id, $idMember) {
        $simulasi = Simulasi::findOrFail($id);
        $member = GrupChatMember::where('id', $idMember)->first();
        if($member->delete())
            return back()->with('success', "Berhasil menghapus " . $member->user->nama . " dari Grup Chat");
        return back()->with('danger', 'Terjadi kesalahan saat menghapus member dari Grup Chat');
    }
    
    public function scanView($id) {
        $simulasi = Simulasi::findOrFail($id);
        $simulasiUjian = SimulasiUjian::where("id_simulasi", $simulasi->id)->get();
        return view('adminsimulasi.simulasi.scan')->with([
            "simulasi" => $simulasi,
            "simulasiUjian" => $simulasiUjian
        ]);
    }
    
    public function scanPreview(Request $input, $id) {
        $simulasi = Simulasi::findOrFail($id);
        $kunciJawaban = SimulasiKunciJawaban::where("id_simulasi", $id)->where("id_mapel", $input->id_mapel)->get();
        $jumlahSoal = $kunciJawaban->count();
        if($jumlahSoal <= 0) 
            return back()->with('danger', 'Kunci Jawaban Belum Dibuat');
        if($input->hasFile('fileUpload')){
            $path = $input->file('fileUpload')->getRealPath();
            $data = Excel::load($path, function($header) {})->get();
            if(!empty($data) && $data->count()){
                return view('adminsimulasi.simulasi.scandata')->with([
                    "data" => $data,
                    "simulasi" => $simulasi,
                    "idMapel" => $input->id_mapel
                ]);
            }
            return back()->with('danger', 'Data tidak terbaca');
        }
        return back()->with('danger', 'File upload tidak ada');
    }

    public function scanProcess(Request $input, $id) {
        $simulasi = Simulasi::findOrFail($id);

        $kunciJawaban = SimulasiKunciJawaban::where("id_simulasi", $simulasi->id)->where("id_mapel", $input->id_mapel)->get();
        $jumlahSoal = $kunciJawaban->count();
        if($jumlahSoal <= 0) 
            return $this->success([
                'status' => 'Soal belum tersedia'
            ], null);

        $noPeserta = $input->data['no_peserta'];
        // $noPeserta = "111-24-00912";
        $peserta = SimulasiPeserta::where("id_simulasi", $simulasi->id)
                                    ->where("no_peserta", $noPeserta)
                                    ->first();
        // return $this->success([
        //     'status' => 'Peserta tidak ada',
        //     'peserta' => $noPeserta
        // ], null);

        if($peserta == null) 
            return $this->success([
                'status' => 'Peserta tidak ada'
            ], null);

        if($peserta->is_corrected == 1) 
            return $this->success([
                'status' => 'Complete',
                'jumlah_benar' => $peserta->jumlah_benar,
                'jumlah_salah' => $peserta->jumlah_salah
            ], null);

        $totalBenar = 0;
        $totalSalah = 0;
        for($i=1; $i<=$jumlahSoal; $i++) {
            $soal = $kunciJawaban->where("no", $i)->first();
            $koreksi = SimulasiKoreksi::where("id_simulasi", $simulasi->id)
                                        ->where("id_peserta", $peserta->id)
                                        ->where("id_soal", $soal->id)
                                        ->first();
            if($koreksi == null)
                $koreksi = new SimulasiKoreksi;

            $isCorrect = $input->data["$i"];

            $koreksi->id = Uuid::generate();
            $koreksi->id_simulasi = $simulasi->id;
            $koreksi->id_peserta = $peserta->id;
            $koreksi->id_soal = $soal->id;
            $koreksi->no_soal = $soal->no;
            $koreksi->jawaban = null;
            $koreksi->kunci_jawaban = $soal->jawaban;
            $koreksi->is_correct = $isCorrect;
            $koreksi->save();

            if($isCorrect) $totalBenar++;
            else $totalSalah++;

        }
        $peserta->is_corrected = 1;
        $peserta->jumlah_benar = $totalBenar;
        $peserta->jumlah_salah = $totalSalah;
        if($peserta->save())
            return $this->success([
                'status' => 'Complete',
                'jumlah_benar' => $peserta->jumlah_benar,
                'jumlah_salah' => $peserta->jumlah_salah,
                'peserta' => $peserta
            ], null);
        return $this->success([
            'status' => 'Tidak tersimpan'
        ], null);
    }
}