<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Uuid;

use App\Models\SetPustaka;
use App\Models\Ujian;
use App\Models\Soal;

class UjianController extends Controller
{
    public function index() {
        $ujian = Ujian::orderby('created_at', 'desc')->get();
        return view('admin.ujian.index')->with([
            'ujian' => $ujian
        ]);
    }

    public function formTambahUjian() {
        $sekolah = SetPustaka::tingkatSekolah();
        return view('admin.ujian.tambah')->with([
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
        $ujian->save();
        return redirect()->route('admin.ujian.soal.kelola', $ujian->id)->with('success', 'Berhasil membuat soal ujian baru');
    }

    public function prosesEditUjian(Request $input, $id) {
        $this->validate($input, [
            'judul'     => 'required|string',
            'harga'     => 'required|numeric',
            'url'       => 'nullable|url',
            'durasi'    => 'required|numeric',
        ]);
        $ujian = Ujian::find($id);
        $ujian->judul           = $input->judul;
        $ujian->harga           = $input->harga;
        $ujian->link_pembahasan = $input->url;
        $ujian->durasi          = $input->durasi;
        $ujian->save();
        return redirect()->route('admin.ujian.soal.kelola', $ujian->id)->with('success', 'Berhasil menyimpan perubahan');
    }

    public function deleteUjian($id) {
        $ujian = Ujian::find($id);
        $ujian->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus '. $ujian->judul);
    }

    public function publish($id) {
        $ujian = Ujian::find($id);
        $ujian->is_published = 1;
        $ujian->save();
        return redirect()->route('admin.ujian.soal.kelola', $ujian->id)->with('success', 'Berhasil dipublish');
    }

    public function kelolaSoal($id) {
        $ujian = Ujian::find($id);
        $soal = Soal::where('id_ujian', $ujian->id)->orderBy('created_at', 'ASC')->get();
        return view('admin.ujian.kelola')->with([
            'ujian' => $ujian,
            'soal' => $soal
        ]);
    }

    public function formPeraturan($id, $idSoal = null) {
        $ujian = Ujian::findOrFail($id);
        return view('admin.ujian.formperaturan')->with([
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
        if($idSoal == null)
        return view('admin.ujian.tambahsoal')->with([
            'ujian' => $ujian
        ]);

        $soal = Soal::find($idSoal);
        return view('admin.ujian.tambahsoal')->with([
            'ujian' => $ujian,
            'soal' => $soal
        ]);
    }

    public function prosesTambahSoal(Request $input, $id, $idSoal = null) {
        $this->validate($input, [
            'soal'      => 'required',
            'jawaban'   => 'required',
        ]);
        $ujian = Ujian::findOrFail($id);
        $soal = new Soal;
        if($idSoal != null) {
            $soal = Soal::find($idSoal);
        }
        $soal->id = UUid::generate();
        $soal->soal = $input->soal;
        $soal->a = $input->a;
        $soal->b = $input->b;
        $soal->c = $input->c;
        $soal->d = $input->d;
        $soal->e = $input->e;
        $soal->jawaban = $input->jawaban;
        $soal->id_ujian = $ujian->id;
        $soal->save();
        if($input->simpan == "simpan")
        return redirect()->route('admin.ujian.soal.kelola', $ujian->id)->with('success', 'Berhasil menambah butir soal');
        return redirect()->route('admin.ujian.soal.form.soal', $ujian->id)->with('success', 'Berhasil menambah butir soal');
    }

    public function deleteSoal($id, $idSoal) {
        $soal = Soal::find($idSoal);
        $soal->forceDelete();
        return redirect()->back()->with('success', 'Berhasil menghapus Soal');
    }

    public function viewSoal($id, $idSoal) {
        $soal = Soal::find($idSoal);
        return view('admin.ujian.lihatsoal')->with([
            'soal' => $soal
        ]);
    }

}
