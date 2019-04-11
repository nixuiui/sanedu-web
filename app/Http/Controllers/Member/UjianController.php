<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Auth;
use Uuid;
use DB;
use App\Http\Controllers\Controller;

use App\Models\SetPustaka;
use App\Models\User;
use App\Models\Ujian;
use App\Models\UjianGroup;
use App\Models\PembelianUjian;
use App\Models\Universitas;
use App\Models\PilihanPassingGrade;
use App\Models\Attempt;
use App\Models\AttemptGroup;
use App\Models\AttemptCorrection;

class UjianController extends Controller
{
    public function index() {
        return view('member.ujian.index');
    }

    public function openSoal($idAttempt) {
        $attempt = Attempt::where('id_user', Auth::id())
                        ->where('id', $idAttempt)
                        ->where('end_attempt', '>', date('Y-m-d H:i:s'))
                        ->first();
        if($attempt == null) return redirect()->route('member.ujian.soal');
        $ujian = Ujian::findOrFail($attempt->id_ujian);
        if($ujian->is_grouped) {
            $group = UjianGroup::select("id", "id_ujian", "nama", "jumlah_soal", "durasi")
                                    ->with("soal")
                                    ->where("id_ujian", $attempt->ujian->id)
                                    ->get();
            return view('member.ujian.soal-group')->with([
                'group'     => $group,
                'ujian'     => $ujian,
                'attempt'   => $attempt
            ]);
        }

        return view('member.ujian.soal')->with([
            'ujian' => $ujian,
            'attempt' => $attempt
        ]);
    }

    public function finish($idAttempt) {
        $attempt = Attempt::where('id_user', Auth::id())
                        ->where('id', $idAttempt)
                        ->where('end_attempt', '>=', date('Y-m-d H:i:s'))
                        ->first();
        if($attempt == null) return redirect()->route('member.ujian.soal');
        $attempt->end_attempt = date("Y-m-d H:i:s");
        $attempt->save();
        return view('member.ujian.finish')->with([
            'attempt' => $attempt
        ]);
    }

    public function sbmptnPassGrade($id) {
        $ujian = Ujian::findOrFail($id);
        $attemptOnGoing = Attempt::where('id_user', Auth::id())
                                    ->where('id_ujian', $id)
                                    ->where('end_attempt', '>=', date('Y-m-d H:i:s'))
                                    ->first();
        if($attemptOnGoing != null) return redirect()->route('member.ujian.soal.open', $attemptOnGoing->id);

        $universitas = Universitas::orderBy('nama', 'asc')->get();
        return view('member.ujian.passgrade')->with([
            'universitas' => $universitas,
            'ujian' => $ujian
        ]);
    }

    public function sbmptnPassGradePost(Request $input, $id) {
        $this->validate($input, [
            'jurusan'   => 'required|exists:set_pustaka,id',
            'jurusan_1' => 'required|exists:tbl_jurusan,id',
            'jurusan_2' => 'required|exists:tbl_jurusan,id',
            'jurusan_3' => 'required|exists:tbl_jurusan,id',
        ]);
        $ujian = Ujian::findOrFail($id);
        $pembelian = PembelianUjian::where('id_user', Auth::id())
                            ->where('id_ujian', $ujian->id)
                            ->firstOrFail();
        $attemptOnGoing = Attempt::where('id_user', Auth::id())
                                    ->where('id_ujian', $id)
                                    ->where('end_attempt', '>=', date('Y-m-d H:i:s'))
                                    ->first();
        if($attemptOnGoing != null) return redirect()->route('member.ujian.soal.open', $attemptOnGoing->id);

        $now = date('Y-m-d H:i:s');
        $attempt = new Attempt;
        $attempt->id = Uuid::generate();
        $attempt->start_attempt = $now;
        $attempt->end_attempt = plusSecond($now, $ujian->durasi);
        $attempt->id_ujian = $ujian->id;
        $attempt->id_pembelian = $pembelian->id;
        $attempt->id_user = Auth::id();
        $attempt->jumlah_benar = 0;
        $attempt->jumlah_salah = 0;
        $attempt->jumlah_tidak_jawab = 0;
        $attempt->nilai = 0;
        if($attempt->save()) {
            $passingGrade = new PilihanPassingGrade;
            $passingGrade->id = Uuid::generate();
            $passingGrade->id_attempt = $attempt->id;
            $passingGrade->id_ujian = $attempt->id_ujian;
            $passingGrade->pilihan_1 = $input->jurusan_1;
            $passingGrade->pilihan_2 = $input->jurusan_2;
            $passingGrade->pilihan_3 = $input->jurusan_3;
            $passingGrade->jurusan = $input->jurusan;
            if($passingGrade->save()) {
                return redirect()->route('member.ujian.soal.open', $attempt->id);
            }
        }
        return view('member.ujian.passgrade')->with([
            'universitas' => $universitas,
            'ujian' => $ujian
        ]);
    }

    public function beliSoal($id) {
        $ujian          = Ujian::where('id', $id)->where('is_published', 1)->firstOrFail();
        $pembelianUjian = PembelianUjian::where('id_ujian', $id)
                                            ->where('id_user', Auth::id())
                                            ->first();
        if($pembelianUjian != null) return redirect()->route('member.ujian.soal.open', $ujian->id);
        if($ujian->harga > Auth::user()->saldo) return back()->with("danger", "Maaf saldo Anda tidak mencukupi untuk membeli Soal ini");

        $pembelianUjian             = new PembelianUjian;
        $pembelianUjian->id         = Uuid::generate();
        $pembelianUjian->id_ujian   = $ujian->id;
        $pembelianUjian->id_user    = Auth::id();
        $pembelianUjian->harga      = $ujian->harga;
        if($pembelianUjian->save())
            return redirect()->route('member.ujian.soal.preattempt', $ujian->id);
        return back()->with("danger", "Maaf terjadi kesalahan");
    }

    public function preAttempt($id) {
        $ujian = Ujian::findOrFail($id);
        if($ujian->is_published != 1) return redirect()->route("member.ujian.soal");
        
        $attemptOnGoing = Attempt::where('id_user', Auth::id())
                        ->where('id_ujian', $id)
                        ->where('end_attempt', '>=', date('Y-m-d H:i:s'))
                        ->first();
        $history = Attempt::where('id_user', Auth::id())
                            ->where('id_ujian', $id)
                            ->where('end_attempt', '<', date('Y-m-d H:i:s'))
                            ->orderBy("created_at", "desc")->get();
        return view('member.ujian.preattempt')->with([
            'ujian' => $ujian,
            'attempt' => $attemptOnGoing,
            'history' => $history
        ]);
    }

    public function attempt($id) {
        $ujian = Ujian::findOrFail($id);
        $pembelian = PembelianUjian::where('id_user', Auth::id())
                            ->where('id_ujian', $ujian->id)
                            ->firstOrFail();
        $attemptOnGoing = Attempt::where('id_user', Auth::id())
                                    ->where('id_ujian', $id)
                                    ->where('end_attempt', '>=', date('Y-m-d H:i:s'))
                                    ->first();
        if($attemptOnGoing != null) return redirect()->route('member.ujian.soal.open', $attemptOnGoing->id);

        $now = date('Y-m-d H:i:s');
        $attempt = new Attempt;
        $attempt->id = Uuid::generate();
        $attempt->start_attempt = $now;
        $attempt->end_attempt = plusSecond($now, $ujian->durasi);
        $attempt->id_ujian = $ujian->id;
        $attempt->id_pembelian = $pembelian->id;
        $attempt->id_user = Auth::id();
        $attempt->jumlah_benar = 0;
        $attempt->jumlah_salah = 0;
        $attempt->jumlah_tidak_jawab = 0;
        $attempt->nilai = 0;
        if($attempt->save()) {
            $startPointTime = $now;
            foreach($ujian->group as $group) {
                $attempGroup = new AttemptGroup;
                $attempGroup->id = Uuid::generate();
                $attempGroup->id_attempt = $attempt->id;
                $attempGroup->id_ujian_group = $group->id;
                $attempGroup->start_attempt = $startPointTime;
                $startPointTime = plusSecond($startPointTime, $group->durasi);
                $attempGroup->end_attempt = $startPointTime;
                $startPointTime = plusSecond($startPointTime, 1);
                $attempGroup->save();
            }
            return redirect()->route('member.ujian.soal.open', $attempt->id);
        }
        return redirect()->route('member.ujian.soal');
    }

    public function listSoal() {
        $mapelSelect = null;
        $idUjian = isset($_GET['idUjian']) && $_GET['idUjian'] != null ? $_GET['idUjian'] : null;
        $idSekolah = isset($_GET['idSekolah']) && $_GET['idSekolah'] != null ? $_GET['idSekolah'] : null;
        $idKelas = isset($_GET['idKelas']) && $_GET['idKelas'] != null ? $_GET['idKelas'] : null;
        $idMataPelajaran = isset($_GET['idMataPelajaran']) && $_GET['idMataPelajaran'] != null ? $_GET['idMataPelajaran'] : null;
        $idJenisUjian = isset($_GET['idJenisUjian']) && $_GET['idJenisUjian'] != null ? $_GET['idJenisUjian'] : null;

        //split id jenis ujian
        $idJenisUjian = explode(",", $idJenisUjian);

        if($idJenisUjian == null || $idSekolah == null) return redirect()->route('member.ujian.soal');

        $ujian = Ujian::whereIn('id_jenis_ujian', $idJenisUjian)
                        ->where('is_published', 1)
                        ->where('id_tingkat_sekolah', $idSekolah);
        if($idKelas != null)
        $ujian = $ujian->where('id_tingkat_kelas', $idKelas);
        if($idMataPelajaran != null) {
            $ujian = $ujian->where('id_mata_pelajaran', $idMataPelajaran);
            $mapelSelect = SetPustaka::find($idMataPelajaran);
        }
        $ujian      = $ujian->orderBy("created_at", "desc")->get();

        $kategori   = SetPustaka::whereIn('id', [$idSekolah, $idKelas, $idMataPelajaran])->orderBy('id', 'desc')->get();
        $jenisUjian = SetPustaka::whereIn('id', $idJenisUjian)->orderBy('id', 'desc')->get();
        $kategori['jenis_ujian'] = $jenisUjian; 

        $mapel      = $this->getMapel($idSekolah, $idJenisUjian);

        return view('member.ujian.list')->with([
            'ujian' => $ujian,
            'filter' => $kategori,
            'mapel' => $mapel,
            'mapelSelect' => $mapelSelect
        ]);
    }

    public function listSoalDibeli() {
        $mapelSelect = null;
        $idUjian = isset($_GET['idUjian']) && $_GET['idUjian'] != null ? $_GET['idUjian'] : null;
        $idSekolah = isset($_GET['idSekolah']) && $_GET['idSekolah'] != null ? $_GET['idSekolah'] : null;
        $idKelas = isset($_GET['idKelas']) && $_GET['idKelas'] != null ? $_GET['idKelas'] : null;
        $idMataPelajaran = isset($_GET['idMataPelajaran']) && $_GET['idMataPelajaran'] != null ? $_GET['idMataPelajaran'] : null;
        $idJenisUjian = isset($_GET['idJenisUjian']) && $_GET['idJenisUjian'] != null ? $_GET['idJenisUjian'] : null;

        $pembelianUjian = PembelianUjian::select("id_ujian")->where('id_user', Auth::id())->get();

        $ujian = Ujian::where('is_published', 1)->whereIn('id', $pembelianUjian);
        if($idKelas != null)
        $ujian = $ujian->where('id_tingkat_kelas', $idKelas);
        if($idMataPelajaran != null) {
            $ujian = $ujian->where('id_mata_pelajaran', $idMataPelajaran);
            $mapelSelect = SetPustaka::find($idMataPelajaran);
        }
        $ujian = $ujian->get();
        $kategori = SetPustaka::whereIn('id', [$idSekolah, $idKelas, $idMataPelajaran, $idJenisUjian])->get();
        $mapel = $this->getMapel($idSekolah, $idJenisUjian);

        return view('member.ujian.list')->with([
            'ujian' => $ujian,
            'filter' => $kategori,
            'mapel' => $mapel,
            'mapelSelect' => $mapelSelect
        ]);
    }

    public function getMapel($idSekolah, $idJenisUjian) {
        $idSekolah = null;
        $idJenisUjian = null;
        if(isset($_GET['idSekolah']) && $_GET['idSekolah'] != null) $idSekolah = $_GET['idSekolah'];
        if(isset($_GET['idJenisUjian']) && $_GET['idJenisUjian'] != null) $idJenisUjian = $_GET['idJenisUjian'];

        $mapel = [];
        if($idJenisUjian == 1401) {
            if($idSekolah == 1301) {
                $mapel = SetPustaka::whereIn('id', [1501, 1502, 1504])->get();
            }
            else if($idSekolah == 1302) {
                $mapel = SetPustaka::whereIn('id', [1501, 1502, 1503, 1504])->get();
            }
            else if($idSekolah == 1303) {
                if(isset($_GET['jurusan'])) {
                    if($_GET['jurusan'] == "IPA") {
                        $mapel = SetPustaka::whereIn('id', [1501, 1502, 1503, 1513, 1514, 1515])->get();
                    }
                    else if($_GET['jurusan'] == "IPS") {
                        $mapel = SetPustaka::whereIn('id', [1501, 1502, 1503, 1510, 1511, 1512])->get();
                    }
                    else {
                        $mapel = SetPustaka::whereIn('id', [1501, 1502, 1503, 1510, 1511, 1512, 1513, 1514, 1515])->get();
                    }
                }
                else {
                    $mapel = SetPustaka::whereIn('id', [1501, 1502, 1503, 1510, 1511, 1512, 1513, 1514, 1515])->get();
                }
            }
        }
        else if($idJenisUjian == 1402 || $idJenisUjian == 1403) {
            if($idSekolah == 1301) {
                $mapel = SetPustaka::whereIn('id', [1501, 1502, 1503, 1504, 1505])->get();
            }
            else if($idSekolah == 1302) {
                $mapel = SetPustaka::whereIn('id', [1501, 1502, 1503, 1504, 1505])->get();
            }
            else if($idSekolah == 1303) {
                if(isset($_GET['jurusan'])) {
                    if($_GET['jurusan'] == "IPA") {
                        $mapel = SetPustaka::whereIn('id', [1501, 1502, 1503, 1509, 1513, 1514, 1515])->get();
                    }
                    else if($_GET['jurusan'] == "IPS") {
                        $mapel = SetPustaka::whereIn('id', [1501, 1502, 1503, 1509, 1510, 1511, 1512])->get();
                    }
                    else {
                        $mapel = SetPustaka::whereIn('id', [1501, 1502, 1503, 1509, 1510, 1511, 1512, 1513, 1514, 1515])->get();
                    }
                }
                else {
                    $mapel = SetPustaka::whereIn('id', [1501, 1502, 1503, 1509, 1510, 1511, 1512, 1513, 1514, 1515])->get();
                }
            }
        }
        else if($idJenisUjian == 1404) {
            $mapel = SetPustaka::whereIn('id', [1504, 1505, 1506])->get();
        }
        return $mapel;
    }

    public function history($idAttempt = null) {
        $history = Attempt::where('id_user', Auth::id())
                            ->where('end_attempt', '<', date('Y-m-d H:i:s'))
                            ->get();
        if($idAttempt == null)
        return view('member.ujian.history')->with([
            'history' => $history
        ]);

        $attempt = Attempt::findOrFail($idAttempt);
        $idUjian = $attempt->id_ujian;
        $query   = "SELECT
                    soal.id,
                    soal.soal,
                    soal.a,
                    soal.b,
                    soal.c,
                    soal.d,
                    soal.e,
                    soal.jawaban as kunci,
                    correct.jawaban,
                    correct.is_correct
                    FROM
                    tbl_attempt_correction as correct
                    RIGHT JOIN tbl_soal as soal ON
                    correct.id_soal=soal.id AND
                    soal.id_ujian='" . $idUjian. "' AND
                    correct.id_attempt='" . $idAttempt . "'";
        $jawaban = collect(DB::select("
                $query
                WHERE
                soal.id_ujian='" . $idUjian . "' &&
                soal.deleted_at IS NULL &&
                correct.deleted_at IS NULL
                ORDER BY soal.created_at ASC"));
        if($attempt->ujian->is_grouped) {
            $jawaban = $attempt->group->map(function($d) use ($idUjian, $query){
                $idUjianGroup = $d->id_ujian_group;
                $jawaban = collect(DB::select("
                            $query
                            WHERE
                            soal.id_ujian='" . $idUjian . "' &&
                            soal.id_ujian_group='" . $idUjianGroup . "' &&
                            soal.deleted_at IS NULL &&
                            correct.deleted_at IS NULL
                            ORDER BY soal.created_at ASC"));
                return [
                    'nama' => $d->ujianGroup->nama,
                    'jawaban' => $jawaban
                ];
            });
        }
        return view('member.ujian.preview')->with([
            'attempt' => $attempt,
            'jawaban' => $jawaban
        ]);
    }
}
