<?php

namespace App\Http\Controllers\AdminUjian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Uuid;
use DB;
use App\Models\SetPustaka;
use App\Models\Ujian;
use App\Models\UjianGroup;
use App\Models\Soal;
use App\Models\Attempt;
use App\Models\User;

class UjianController extends Controller
{
    public function index() {
        $ujian = Ujian::where("is_published", "!=" ,3)->orderby('created_at', 'desc')->get();
        return view('adminujian.ujian.index')->with([
            'ujian' => $ujian
        ]);
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
            'judul'             => 'required|string',
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
            'judul'     => 'required|string',
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
            'nama'  => 'required|string',
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
        if($ujian->is_published == 1) return redirect()->route("admin.ujian.soal.kelola", $ujian->id);

        $group = null;
        if(isset($_GET['idKelompokSoal']) && $_GET['idKelompokSoal'] != "") {
            $group = UjianGroup::findOrFail($_GET['idKelompokSoal']);
        }
        if($idSoal == null)
        return view('adminujian.ujian.tambahsoal')->with([
            'ujian' => $ujian,
            'group' => $group
        ]);

        $soal = Soal::find($idSoal);
        return view('adminujian.ujian.tambahsoal')->with([
            'ujian' => $ujian,
            'group' => $group,
            'soal' => $soal
        ]);
    }

    public function prosesTambahSoal(Request $input, $id, $idSoal = null) {
        $this->validate($input, [
            'soal'      => 'required',
            'jawaban'   => 'required',
            'id_group'  => 'nullable|exists:tbl_ujian_group,id',
        ]);
        
        $ujian = Ujian::findOrFail($id);
        if($ujian->is_published == 1) return redirect()->route("admin.ujian.soal.kelola", $ujian->id);

        $soal = new Soal;
        $soal->id = UUid::generate();
        $soal->id_ujian = $ujian->id;
            
        $groupId = null;
        if($input->id_group) {
            $group = UjianGroup::findOrFail($input->id_group);
            $groupId = $group->id;
            $soal->id_ujian_group = $group->id;
        }

        if($idSoal != null) {
            $soal = Soal::find($idSoal);
            $groupId = $soal->id_ujian_group;
        }

        $soal->soal = $input->soal;
        $soal->a = $input->a;
        $soal->b = $input->b;
        $soal->c = $input->c;
        $soal->d = $input->d;
        $soal->e = $input->e;
        $soal->jawaban = $input->jawaban;
        $soal->save();
        if($input->simpan == "simpan")
            return redirect()->route('admin.ujian.soal.kelola', $ujian->id)->with('success', 'Berhasil menambah butir soal');
        return redirect(route('admin.ujian.soal.form.soal', ['id' => $ujian->id]) . "?idKelompokSoal=" . $groupId)->with('success', 'Berhasil menambah butir soal');
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
        $soal = collect(DB::select("
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
        return view('adminujian.ujian.preview')->with([
            'attempt' => $attempt,
            'soal' => $soal,
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

}
