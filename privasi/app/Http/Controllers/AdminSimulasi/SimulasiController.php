<?php

namespace App\Http\Controllers\AdminSimulasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Uuid;
use DB;
use App\Models\SetPustaka;
use App\Models\User;
use App\Models\Simulasi;
use App\Models\SimulasiPengawas;
use App\Models\SimulasiPeserta;
use App\Models\SimulasiAgenda;
use App\Models\SimulasiRuang;
use App\Models\SimulasiKunciJawaban;

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
            'link_soal'             => 'nullable|url',
            'link_pembahasan'       => 'nullable|url',
            'harga'                 => 'required|numeric',
        ]);
        $simulasi = new Simulasi;
        $simulasi->id = UUid::generate();
        $simulasi->id_creator = Auth::id();
        $simulasi->id_tingkat_sekolah = $input->id_sekolah;
        $simulasi->id_jenis_ujian = 1404;
        $simulasi->judul = $input->judul;
        $simulasi->instansi = $input->instansi;
        $simulasi->tanggal_pelaksanaan = $input->tanggal_pelaksanaan;
        $simulasi->tempat_pelaksanaan = $input->tempat_pelaksanaan;
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
        $simulasi = Simulasi::findOrFail($id);
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
        $simulasi->link_soal = $input->link_soal;
        $simulasi->link_pembahasan = $input->link_pembahasan;
        $simulasi->harga = $input->harga;
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

    public function ruangForm($id, $idRuang = null) {
        $simulasi = Simulasi::findOrFail($id);

        $mapel = "";
        if($simulasi->id_jenis_ujian == 1404)
            $mapel = SetPustaka::whereIn("id", [1516, 1517, 1518])->get();

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
        return redirect()->route('adminsimulasi.simulasi.kelola', $simulasi->id)->with('success', 'Berhasil menyimpan ruangan');
        return redirect()->route('adminsimulasi.simulasi.kelola.ruang.form', $simulasi->id)->with('success', 'Berhasil menyimpan ruangan');
    }

    public function ruangDelete($id, $idRuang) {
        $ruang = SimulasiRuang::find($idRuang);
        $ruang->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus ruangan');
    }

    public function peserta($id) {
        $simulasi = Simulasi::findOrFail($id);
        return view('adminsimulasi.simulasi.peserta')->with('simulasi', $simulasi);
    }

    public function kunciJawaban($id) {
        $simulasi = Simulasi::findOrFail($id);
        return view('adminsimulasi.simulasi.kuncijawaban')->with('simulasi', $simulasi);
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

        $pengawas = new SimulasiPengawas;
        $pengawas->id = Uuid::generate();
        $pengawas->id_simulasi = $simulasi->id;
        $pengawas->id_user = $user->id;
        $pengawas->id_ruang = $input->ruang;
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
                $pengawas = new SimulasiPengawas;
                $pengawas->id = Uuid::generate();
                $pengawas->id_simulasi = $simulasi->id;
                $pengawas->id_user = $user->id;
                $pengawas->id_ruang = $input->ruang;
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
            $pengawas->id_ruang = $input->ruang;
            if($pengawas->save()) {
                return redirect()->route('adminsimulasi.simulasi.kelola.pengawas', ["id" => $simulasi->id])->with("success", "Berhasil Menyimpan Perubahan");
            }
        }
    }

}
