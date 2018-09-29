<?php

namespace App\Http\Controllers\AdminSimulasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Uuid;
use DB;
use App\Models\SetPustaka;
use App\Models\Simulasi;
use App\Models\SimulasiAgenda;
use App\Models\SimulasiRuang;

class SimulasiController extends Controller
{
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
            'tanggal_pelaksanaan'   => 'required|date',
            'tempat_pelaksanaan'    => 'required',
            'harga'                 => 'required|numeric',
        ]);
        $simulasi = new Simulasi;
        $simulasi->id = UUid::generate();
        $simulasi->id_creator = Auth::id();
        $simulasi->id_tingkat_sekolah = $input->id_sekolah;
        $simulasi->judul = $input->judul;
        $simulasi->instansi = $input->instansi;
        $simulasi->tanggal_pelaksanaan = $input->tanggal_pelaksanaan;
        $simulasi->tempat_pelaksanaan = $input->tempat_pelaksanaan;
        $simulasi->harga = $input->harga;
        $simulasi->save();
        return redirect()->route('adminsimulasi.simulasi.kelola', $simulasi->id)->with('success', 'Simulasi berhasil dibuat');
    }

    public function kelola($id) {
        $simulasi = Simulasi::findOrFail($id);
        return view('adminsimulasi.simulasi.kelola')->with([
            'simulasi' => $simulasi,
        ]);
    }

    public function editPost(Request $input, $id) {
        $this->validate($input, [
            'judul'                 => 'required',
            'instansi'              => 'required',
            'tanggal_pelaksanaan'   => 'required|date',
            'tempat_pelaksanaan'    => 'required',
            'harga'                 => 'required|numeric',
        ]);
        $simulasi = Simulasi::find($id);
        $simulasi->judul = $input->judul;
        $simulasi->instansi = $input->instansi;
        $simulasi->tanggal_pelaksanaan = $input->tanggal_pelaksanaan;
        $simulasi->tempat_pelaksanaan = $input->tempat_pelaksanaan;
        $simulasi->harga = $input->harga;
        $simulasi->save();
        return redirect()->route('adminsimulasi.simulasi.kelola', $simulasi->id)->with('success', 'Berhasil menyimpan perubahan');
    }

    public function publish($id) {
        $simulasi = Simulasi::find($id);
        $simulasi->is_published = 1;
        $simulasi->save();
        return redirect()->route('adminsimulasi.simulasi.kelola', $simulasi->id)->with('success', 'Berhasil dipublish');
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
            'tanggal'       => 'required|date',
            'waktu'         => 'required|date_format:"H:i"',
            'nama_agenda'   => 'required',
            'deskripsi'     => 'required',
        ]);
        $simulasi = Simulasi::findOrFail($id);
        $agenda = new SimulasiAgenda;
        $agenda->id = UUid::generate();
        $agenda->id_simulasi = $simulasi->id;
        if($idAgenda != null) {
            $agenda = SimulasiAgenda::find($idAgenda);
        }
        $agenda->waktu = $input->tanggal . " " . $input->waktu;
        $agenda->nama_agenda = $input->nama_agenda;
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

    public function ruangForm($id, $idRuang = null) {
        $simulasi = Simulasi::findOrFail($id);
        if($idRuang == null)
        return view('adminsimulasi.simulasi.ruangform')->with([
            'simulasi' => $simulasi
        ]);

        $ruang = SimulasiRuang::find($idRuang);
        return view('adminsimulasi.simulasi.ruangform')->with([
            'simulasi' => $simulasi,
            'ruang' => $ruang
        ]);
    }

    public function ruangPost(Request $input, $id, $idRuang = null) {
        $this->validate($input, [
            'nama_ruang'    => 'required',
            'kapasitas'     => 'required|numeric',
            'alamat'        => 'required',
        ]);
        $simulasi = Simulasi::findOrFail($id);
        $ruang = new SimulasiRuang;
        $ruang->id = UUid::generate();
        $ruang->id_simulasi = $simulasi->id;
        if($idRuang != null) {
            $ruang = SimulasiRuang::find($idRuang);
        }
        $ruang->nama_ruang = $input->nama_ruang;
        $ruang->kapasitas = $input->kapasitas;
        $ruang->alamat = $input->alamat;
        $ruang->save();
        if($input->simpan == "simpan")
        return redirect()->route('adminsimulasi.simulasi.kelola', $simulasi->id)->with('success', 'Berhasil menyimpan ruangan');
        return redirect()->route('adminsimulasi.simulasi.kelola.ruang.form', $simulasi->id)->with('success', 'Berhasil menyimpan ruangan');
    }

    public function ruangDelete($id, $idRuang) {
        $ruang = SimulasiRuang::find($idRuang);
        $ruang->forceDelete();
        return redirect()->back()->with('success', 'Berhasil menghapus ruangan');
    }



    //-----------------------------------------------------------------

    public function savePeraturan(Request $input, $id) {
        $ujian = Ujian::findOrFail($id);
        $ujian->peraturan = $input->peraturan;
        $ujian->save();
        return redirect()->route('admin.ujian.soal.kelola', $ujian->id)->with('success', 'Berhasil menyimpan peraturan');
    }

    public function formSoal($id, $idSoal = null) {
        $ujian = Ujian::findOrFail($id);
        if($idSoal == null)
        return view('adminujian.ujian.tambahsoal')->with([
            'ujian' => $ujian
        ]);

        $soal = Soal::find($idSoal);
        return view('adminujian.ujian.tambahsoal')->with([
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
        return view('adminujian.ujian.lihatsoal')->with([
            'soal' => $soal
        ]);
    }

    public function history($id, $idAttempt = null) {
        $ujian = Ujian::findOrFail($id);
        $history = Attempt::where('id_ujian', $id)
                            ->where('end_attempt', '<', date('Y-m-d H:i:s'))
                            ->get();
        if($idAttempt == null)
        return view('adminujian.ujian.history')->with([
            'history' => $history,
            'ujian' => $ujian
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

    public function pembeli($id) {
        $ujian = Ujian::findOrFail($id);
        return view('adminujian.ujian.pembeli')->with([
            'ujian' => $ujian
        ]);
    }

}
