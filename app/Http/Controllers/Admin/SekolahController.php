<?php

namespace App\Http\Controllers\Admin;

use Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Sekolah;
use App\Models\SetPustaka;
use App\Models\User;

class SekolahController extends Controller
{
    public function index() {
        $sekolah = Sekolah::where('is_checked', 1)->get();
        $sekolah = $sekolah->map(function($data) {
            return [
                'id' => $data->id,
                'nama' => $data->nama,
                'provinsi' => $data->provinsi->name,
                'kota' => $data->kota->name,
                'siswa' => $data->siswa->count()
            ];
        });
        return view('admin.sekolah.index')->with([
            'sekolah' => $sekolah,
            'jumlahSekolahBaru' => $this->jumlahSekolahBaru()
        ]);
    }

    public function siswa($id) {
        $sekolah = Sekolah::findOrFail($id);
        $siswa = User::select(['id', 'nama', 'email', 'no_hp', 'no_hp_ortu'])
                    ->where('id_role', 1004)
                    ->where('id_sekolah', $id)
                    ->orderBy('id_role', 'asc')
                    ->get();
        return view('admin.sekolah.siswa')->with([
            'siswa' => $siswa,
            'jumlahSekolahBaru' => $this->jumlahSekolahBaru()
        ]);
    }

    public function unchecked() {
        $sekolah = Sekolah::where('is_checked', 0)->get();
        $sekolah = $sekolah->map(function($data) {
            return [
                'id' => $data->id,
                'nama' => $data->nama,
                'provinsi' => $data->provinsi->name,
                'kota' => $data->kota->name,
                'siswa' => $data->siswa->count()
            ];
        });
        return view('admin.sekolah.index')->with([
            'sekolah' => $sekolah,
            'jumlahSekolahBaru' => $this->jumlahSekolahBaru()
        ]);
    }

    public function tambahForm() {
        $provinsi = Provinsi::all();
        $tingkatSekolah = SetPustaka::tingkatSekolah();
        return view('admin.sekolah.tambah')->with([
            "provinsi" => $provinsi,
            "tingkatSekolah" => $tingkatSekolah,
            'jumlahSekolahBaru' => $this->jumlahSekolahBaru()
        ]);
    }

    public function tambahPost(Request $input) {
        $this->validate($input, [
            'id_provinsi'  => 'nullable|exists:set_provinsi,id',
            'id_kota'  => 'nullable|exists:set_kota,id',
            'nama' => 'required'
        ]);
        foreach($input->nama as $nama) {
            $sekolah = new Sekolah;
            $sekolah->id = Uuid::generate();
            $sekolah->id_provinsi = $input->id_provinsi;
            $sekolah->id_kota = $input->id_kota;
            $sekolah->id_tingkat_sekolah = $input->id_tingkat_sekolah;
            $sekolah->nama = $nama;
            $sekolah->is_checked = 1;
            $sekolah->save();
        }
        return back()->with("success", "Berhasil menambah data");
    }

    public function delete($id) {
        $sekolah = Sekolah::findOrFail($id);
        if($sekolah->siswa->count() > 0)
            return back()->with("danger", "Maaf, untuk sekolah yang dipilih sudah terdapat siswa yang mendaftar, sebaiknya jangan di hapus karena akan merusak data.");
        $sekolah->delete();
        return back()->with("success", "Berhasil menghapus data sekolah");
    }

    public function editForm($id) {
        $provinsi = Provinsi::all();
        $sekolah = Sekolah::findOrFail($id);
        $kota = Kota::where("id_provinsi", $sekolah->id_provinsi)->get();
        $tingkatSekolah = SetPustaka::tingkatSekolah();
        return view('admin.sekolah.edit')->with([
            "provinsi" => $provinsi,
            "kota" => $kota,
            "tingkatSekolah" => $tingkatSekolah,
            "sekolah" => $sekolah,
            'jumlahSekolahBaru' => $this->jumlahSekolahBaru()
        ]);
    }

    public function editPost(Request $input, $id) {
        $this->validate($input, [
            'id_provinsi'  => 'nullable|exists:set_provinsi,id',
            'id_kota'  => 'nullable|exists:set_kota,id',
            'nama' => 'required'
        ]);
        $sekolah = Sekolah::findOrFail($id);
        $sekolah->id_provinsi = $input->id_provinsi;
        $sekolah->id_kota = $input->id_kota;
        $sekolah->id_tingkat_sekolah = $input->id_tingkat_sekolah;
        $sekolah->nama = $input->nama;
        $sekolah->is_checked = 1;
        $sekolah->save();
        return back()->with("success", "Berhasil menambah data");
    }

    public function jumlahSekolahBaru(Type $var = null) {
        return $jumlahSekolahBaru = Sekolah::select('id')->where('is_checked', 0)->get()->count();
    }
}
