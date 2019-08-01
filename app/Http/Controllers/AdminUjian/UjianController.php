<?php

namespace App\Http\Controllers\AdminUjian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Uuid;
use DB;
use App\Models\SetPustaka;
use App\Models\Ujian;
use App\Models\UjianGroup;
use App\Models\Soal;
use App\Models\Attempt;
use App\Models\User;
use App\Models\AttemptCorrection;

class UjianController extends Controller
{
    public function index() {
        $ujian = Ujian::where("is_published", "!=" ,3)->orderby('created_at', 'desc')->get();
        return view('adminujian.ujian.index')->with([
            'ujian' => $ujian
        ]);
    }

    public function unpublish() {
        $publish = isset($_GET['publish']) && $_GET['publish'] == 0 ? 0 : 1;
        Ujian::whereIn('is_published', [0,1])->update(['is_published' => $publish]);
        return back()->with("success", "Berhasil Unpublish semua ujian");
    }

    public function formTambahUjian() {
        $sekolah = SetPustaka::where('id_kategori', 13)->orderBy('id', 'asc')->get();
        return view('adminujian.ujian.tambah')->with([
            'sekolah' => $sekolah
        ]);
    }

    public function prosesTambahUjian(Request $input) {
        $this->validate($input, [
            'id_sekolah'        => 'required|exists:set_pustaka,id',
            'id_ujian'          => 'required|exists:set_pustaka,id',
            'id_kelas'          => 'nullable|exists:set_pustaka,id',
            'id_mata_pelajaran' => 'nullable|exists:set_pustaka,id',
            'judul'             => 'required|string|max:100',
            'menit'             => 'required_if:check_soal,false|numeric',
            'detik'             => 'required_if:check_soal,false|numeric',
            'harga'             => 'required|numeric',
        ]);
        $ujian = new Ujian;
        $ujian->id = UUid::generate();
        $ujian->id_tingkat_sekolah = $input->id_sekolah;
        $ujian->id_jenis_ujian = $input->id_ujian;
        $ujian->id_tingkat_kelas = $input->id_kelas;
        $ujian->id_mata_pelajaran = $input->id_mata_pelajaran;
        $ujian->judul = $input->judul;
        $ujian->harga = $input->harga;

        if($input->check_soal) $ujian->is_grouped = 1;
        else $ujian->durasi = ($input->menit*60) + $input->detik;

        $ujian->save();
        return redirect()->route('admin.ujian.soal.kelola', $ujian->id)->with('success', 'Berhasil membuat soal ujian baru');
    }

    public function prosesEditUjian(Request $input, $id) {
        $this->validate($input, [
            'judul'     => 'required|string|max:100',
            'harga'     => 'required|numeric',
            'url'       => 'nullable|url',
            'menit'     => 'numeric',
            'detik'     => 'numeric',
        ]);
        $ujian = Ujian::find($id);
        $ujian->judul           = $input->judul;
        $ujian->harga           = $input->harga;
        $ujian->link_pembahasan = $input->url;
        if(!$ujian->is_grouped)
        $ujian->durasi          = ($input->menit*60) + $input->detik;
        $ujian->save();
        return redirect()->back()->with("success", "Berhasil menyimpan perubahan");
    }

    public function upUjian($id) {
        $ujian = Ujian::find($id);
        $ujian->created_at = date("Y-m-d H:i:s");
        $ujian->save();
        return redirect()->back()->with('success', 'Berhasil menyimpan perubahan');
    }

    public function deleteUjian($id) {
        $ujian = Ujian::find($id);
        $ujian->is_published = 3;
        $ujian->save();
        return redirect()->back()->with('success', 'Berhasil menghapus '. $ujian->judul);
    }

    public function publish($id) {
        $ujian = Ujian::find($id);
        $ujian->is_published = 1;
        $ujian->save();
        return redirect()->route('admin.ujian.soal.kelola', $ujian->id)->with('success', 'Berhasil dipublish');
    }

    public function formKelompokSoal($id, $idKelompokSoal = null) {
        $ujian = Ujian::findOrFail($id);
        if($ujian->is_published == 1) return redirect()->route("admin.ujian.soal.kelola", $ujian->id);

        $group = null;
        if($idKelompokSoal)
        $group = UjianGroup::findOrFail($idKelompokSoal);
        return view('adminujian.ujian.formkelompoksoal')->with([
            'ujian' => $ujian,
            'group' => $group
        ]);
    }

    public function prosesKelompokSoal(Request $input, $id, $idKelompokSoal = null) {
        $this->validate($input, [
            'nama'  => 'required|string|max:50',
            'menit' => 'required|numeric',
            'detik' => 'required|numeric',
        ]);

        $ujian = Ujian::findOrFail($id);
        if($ujian->is_published == 1) return redirect()->route("admin.ujian.soal.kelola", $ujian->id);

        if($idKelompokSoal) {
            $group              = UjianGroup::find($idKelompokSoal);
        }
        else {
            $group              = new UjianGroup;
            $group->id          = Uuid::generate();
            $group->id_ujian    = $ujian->id;
        }
        $group->nama        = $input->nama;
        $group->durasi      = ($input->menit*60) + $input->detik;
        $group->save();return redirect()->route('admin.ujian.soal.kelola', $ujian->id);
    }
    
    public function deleteKelompokSoal($id, $idKelompokSoal) {
        $ujian = Ujian::findOrFail($id);
        $group = UjianGroup::findOrFail($idKelompokSoal);
        $group->forceDelete();
        $soal = Soal::where("id_ujian_group", $group->id)->forceDelete();
        return redirect()->route('admin.ujian.soal.kelola', $ujian->id);
    }

    public function kelolaSoal($id) {
        $ujian = Ujian::find($id);
        return view('adminujian.ujian.soal')->with([
            'ujian' => $ujian
        ]);
    }

    public function formPeraturan($id, $idSoal = null) {
        $ujian = Ujian::findOrFail($id);
        return view('adminujian.ujian.formperaturan')->with([
            'ujian' => $ujian
        ]);
    }

    public function savePeraturan(Request $input, $id) {
        $ujian = Ujian::findOrFail($id);
        $ujian->peraturan = $input->peraturan;
        $ujian->save();
        return redirect()->route('admin.ujian.soal.kelola', $ujian->id)->with('success', 'Berhasil menyimpan peraturan');
    }

    public function formSoal($id, $idSoal = null) {
        $ujian = Ujian::findOrFail($id);

        $group = null;
        if(isset($_GET['idKelompokSoal']) && $_GET['idKelompokSoal'] != "") {
            $group = UjianGroup::findOrFail($_GET['idKelompokSoal']);
        }
        if($idSoal == null)
        return view('adminujian.ujian.formsoal')->with([
            'ujian' => $ujian,
            'group' => $group
        ]);

        $soal = Soal::find($idSoal);
        return view('adminujian.ujian.formsoal')->with([
            'ujian' => $ujian,
            'group' => $group,
            'soal' => $soal
        ]);
    }

    public function prosesFormSoal(Request $input, $id, $idSoal = null) {
        $this->validate($input, [
            'soal'      => 'required',
            'jawaban'   => 'required',
            'id_group'  => 'nullable|exists:tbl_ujian_group,id',
        ]);
        
        $ujian = Ujian::findOrFail($id);

        $soal = new Soal;
        $soal->id = UUid::generate();
        $soal->id_ujian = $ujian->id;
            
        $groupId = null;
        if($input->id_group) {
            $group = UjianGroup::findOrFail($input->id_group);
            $groupId = $group->id;
            $soal->id_ujian_group = $group->id;
        }

        $jawaban = $input->jawaban;
        $kunciLama = null;
        if($idSoal != null) {
            $soal = Soal::find($idSoal);
            $kunciLama = $soal->jawaban;
            $groupId = $soal->id_ujian_group;
        }

        $soal->soal = $input->soal;
        $soal->a = $input->a;
        $soal->b = $input->b;
        $soal->c = $input->c;
        $soal->d = $input->d;
        $soal->e = $input->e;
        $soal->jawaban = $jawaban;
        $soal->save();
        
        // UPDATE KUNCI JAWABAN
        $attemptCorrection = AttemptCorrection::where("id_soal", $idSoal)
                                ->where(function($query) use ($jawaban) {
                                    $query->where("is_correct", 1)
                                            ->orWhere("jawaban", $jawaban); 
                                })->get();
        if(($kunciLama != $input->jawaban) && $attemptCorrection->count() > 0) {
            foreach($attemptCorrection as $data) {
                $data->is_correct = $data->jawaban == $input->jawaban;
                $data->save();
            }
        }

        if($input->simpan == "simpan")
            return redirect()->route('admin.ujian.soal.kelola', $ujian->id)->with('success', 'Berhasil menambah butir soal');
        return redirect(route('admin.ujian.soal.form.soal', ['id' => $ujian->id]) . "?idKelompokSoal=" . $groupId)->with('success', 'Berhasil menambah butir soal');
    }

    public function prosesImportSoal(Request $input, $id) {
        $this->validate($input, [
            'file' => 'required|file|max:2000', // max 2MB
        ]);

        $ujian = Ujian::findOrFail($id);

        $fileInput = $input->file('file');
        $file = File::get($fileInput);
        $soals = [];
        $soal = null;
        $indexSoal = 0;
        $pilihan = ["A.", "B.", "C.", "D.", "E."];
        foreach (explode("\n", $file) as $line){
            $checkPilihan = substr($line, 0, 2);
            $checkJawaban = substr($line, 0, 7);
            if(in_array($checkPilihan, $pilihan)) {
                $jawaban = substr($line, 3);
                switch ($checkPilihan) {
                    case "A.":
                        $soals[$indexSoal]['a'] = $jawaban;
                        break;
                    case "B.":
                        $soals[$indexSoal]['b'] = $jawaban;
                        break;
                    case "C.":
                        $soals[$indexSoal]['c'] = $jawaban;
                        break;
                    case "D.":
                        $soals[$indexSoal]['d'] = $jawaban;
                        break;
                    case "E.":
                        $soals[$indexSoal]['e'] = $jawaban;
                        break;
                }
            }
            else if($checkJawaban == "ANSWER:") {
                $soals[$indexSoal]['answer'] = substr($line, 8);
                $soals[$indexSoal]['soal'] = $soal;

                $soal = new Soal;
                $soal->id = UUid::generate();
                $soal->id_ujian = $ujian->id;
                $soal->soal = $soals[$indexSoal]['soal'];
                $soal->a = $soals[$indexSoal]['a'];
                $soal->b = $soals[$indexSoal]['b'];
                $soal->c = $soals[$indexSoal]['c'];
                $soal->d = $soals[$indexSoal]['d'];
                $soal->e = $soals[$indexSoal]['e'];
                $soal->jawaban = $soals[$indexSoal]['answer'];
                $soal->save();

                $indexSoal++;
                $soal = null;
            }
            else if($line == "") {
                continue;
            }
            else {
                if($soal == null) {
                    $soal = $line;
                }
                else {
                    $soal .= "\n".$line;
                }
            }
        }

        // return json_encode($soals);
        
        return redirect()->back()->with('success', $indexSoal . ' soal berhasil diimport');

    }

    public function deleteSoal($id, $idSoal) {
        $soal = Soal::find($idSoal);
        $soal->forceDelete();
        return redirect()->back()->with('success', 'Berhasil menghapus Soal');
    }

    public function viewSoal($id, $idSoal) {
        $soal = Soal::find($idSoal);
        return view('adminujian.ujian.lihatsoal')->with([
            'soal' => $soal
        ]);
    }

    public function history($id, $idAttempt = null) {
        $peserta = null;
        $ujian = Ujian::findOrFail($id);
        $history = Attempt::where('id_ujian', $id)->where('end_attempt', '<', date('Y-m-d H:i:s'));
        if(isset($_GET['idPeserta']) && $_GET['idPeserta']) {
            $peserta = User::findOrFail($_GET['idPeserta']);
            $history = $history->where('id_user', $peserta->id);
        }
        $history = $history->orderBy("created_at", "desc")->get();
        if($idAttempt == null)
        return view('adminujian.ujian.history')->with([
            'history' => $history,
            'ujian' => $ujian,
            'peserta' => $peserta
        ]);

        $attempt = Attempt::findOrFail($idAttempt);
        $idUjian = $attempt->id_ujian;
        $jawaban = collect(DB::select("
                SELECT
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
                correct.id_attempt='" . $idAttempt . "'
                WHERE
                soal.id_ujian='" . $idUjian . "' &&
                soal.deleted_at IS NULL &&
                correct.deleted_at IS NULL
                ORDER BY soal.created_at ASC"));
        
        if($ujian->is_grouped) {
            $jawaban = $attempt->group->map(function($d) use ($idUjian, $idAttempt){
                $idUjianGroup = $d->id_ujian_group;
                $jawaban = collect(DB::select("
                            SELECT
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
                            correct.id_attempt='" . $idAttempt . "'
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
        return view('adminujian.ujian.preview')->with([
            'attempt' => $attempt,
            'jawaban' => $jawaban,
            'ujian' => $ujian
        ]);
    }

    public function peserta($id) {
        $ujian = Ujian::findOrFail($id);
        return view('adminujian.ujian.peserta')->with([
            'ujian' => $ujian
        ]);
    }

    public function setting($id) {
        $ujian = Ujian::findOrFail($id);
        return view('adminujian.ujian.setting')->with([
            'ujian' => $ujian
        ]);
    }

    public function view($id) {
        $ujian = Ujian::findOrFail($id);
        if($ujian->is_grouped)
            return view('adminujian.ujian.viewsoal-group')->with([
                'ujian' => $ujian
            ]);
        return view('adminujian.ujian.viewsoal')->with([
            'ujian' => $ujian
        ]);
    }

    public function reqSoal($idUjian) {
        $ujian = Ujian::findOrFail($idUjian);
        $data = [];
        if($ujian->is_grouped) {
            $no = 0;
            foreach($ujian->group as $key => $group) {
                $group->waktu = gmdate("H:i:s", $group->durasi);
                $group->no_start = ++$no;
                $group->no_end = $no += ($group->jumlah_soal-1);
                $group->soal = $group->soal;
                $data[$key] = $group;
            }
        }
        else {
            $data = Soal::select(['soal', 'a', 'b', 'c', 'd', 'e'])->where('id_ujian', $idUjian)->orderBy('created_at', 'asc')->get();
        }
        if(count($data) > 0)
            return $this->success($data);
        return $this->error("Soal gagal di load");
    }

    public function analitikSoal($id) {
        $ujian = Ujian::find($id);
        return view('adminujian.ujian.analitiksoal')->with([
            'ujian' => $ujian
        ]);
    }

    public function analisisSoal($id) {
        $attempt = Attempt::select(['id'])->where("id_ujian", $id)->get();
        $soal = Soal::where("id_ujian", $id)->get();
        foreach($soal as $s) {
            $benar = AttemptCorrection::whereIn("id_attempt", $attempt)->where("id_soal", $s->id)->where("is_correct", 1)->get()->count();
            $salah = AttemptCorrection::whereIn("id_attempt", $attempt)->where("id_soal", $s->id)->where("is_correct", 0)->get()->count();
            $s->jumlah_benar = $benar;
            $s->jumlah_salah = $salah;
            $s->save();
        }
        return redirect()->route('admin.ujian.soal.kriteria', $id);
    }

    public function kriteriaSoal($id) {
        $ujian = Ujian::findOrFail($id);
        $soal = Soal::where("id_ujian", $ujian->id)
                                        ->orderBy("jumlah_benar", "DESC")
                                        ->get();

        //SAINTEK
        $mudah = $soal->count() * (40/100);
        $sedang = $mudah + $soal->count() * (40/100);
        $sulit = $sedang + $soal->count() * (20/100);
        foreach ($soal as $index => $data) {
            $kriteria = ($index+1) <= $mudah ? "mudah" : (($index+1) <= $sedang ? "sedang" : "sulit");
            $data->kriteria = $kriteria;
            $data->save();
        }
        return redirect()->route('admin.ujian.soal.analitik', $ujian->id)->with("success", "Proses Analisis Soal Berhasil");
    }

}
