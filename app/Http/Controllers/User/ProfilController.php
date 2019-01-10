<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Storage;
use Validator;
use App\Models\User;
use App\Models\Tiket;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Sekolah;
use App\Models\SetPustaka;

class ProfilController extends Controller {

    public function edit() {
        $user       = User::find(Auth::id());
        $provinsi   = Provinsi::all();
        $kota = [];
        $sekolah = [];
        $kelas = [];
        if($user->id_sekolah != null) {
            $kota = Kota::where("id_provinsi", $user->sekolah->id_provinsi)->get();
            $sekolah = Sekolah::where("id_kota", $user->sekolah->id_kota)->get();
            $idTingkatSekolah = $user->sekolah->id_tingkat_sekolah;
            switch($idTingkatSekolah) {
                case 1301:
                    $kelas = SetPustaka::whereIn("id", [1601, 1602, 1603, 1604, 1605, 1606])
                                        ->orderBy("nama", "asc")
                                        ->get();
                    break;
                case 1302:
                    $kelas = SetPustaka::whereIn("id", [1607, 1608, 1609])
                                        ->orderBy("nama", "asc")
                                        ->get();
                    break;
                case 1303:
                    $kelas = SetPustaka::whereIn("id", [1610, 1611, 1612])
                                        ->orderBy("nama", "asc")
                                        ->get();
                    break;
            }
        }
        return view('user.profil.edit')->with([
            'user' => $user,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'sekolah' => $sekolah,
            'kelas' => $kelas
        ]);
    }

    public function editTiket(Request $data) {
        // return Auth::user()->tiket;
        if(Auth::user()->tiket != null)
            return redirect()->back()->with('danger', 'Anda sudah memiliki PIN dan KAP');
        $tiket = Tiket::where('pin', $data->pin)->where('kap', $data->kap);
        if($tiket->first() == null)
            return redirect()->back()->with('danger', 'Nomor PIN dan KAP tidak tersedia');
        $tiket = $tiket->where('id_user', null);
        if($tiket->first() == null)
            return redirect()->back()->with('danger', 'Nomor PIN dan KAP sudah dipakai');
        $tiket = $tiket->first();
        $tiket->id_user = Auth::id();
        $tiket->save();
        $user       = User::find(Auth::id());
        $user->pin  = $data->pin;
        $user->kap  = $data->kap;
        if($user->save())
            return redirect()->back()->with('success', 'Berhasil menambahkan PIN dan KAP Anda');
        return redirect()->back()->with('danger', 'Gagal menambahkan PIN dan KAP Anda');
    }

    public function editProfil(Request $data) {
        $this->validate($data, [
            'nama'                  => 'required|string|max:255',
            'no_hp'                 => 'required',
            'alamat'                => 'required',
            'tempat_lahir'          => 'required',
        ]);

        $user               = User::find(Auth::id());
        $user->nama         = $data->nama;
        $user->no_hp        = $data->no_hp;
        $user->no_hp_ortu   = $data->no_hp_ortu;
        $user->alamat       = $data->alamat;
        $user->tempat_lahir = $data->tempat_lahir;
        if($user->save())
        return redirect()->back()->with('success', 'Berhasil Mengubah Profil');
        return redirect()->back()->with('danger', 'Gagal Mengubah Profil');
    }

    public function editSekolah(Request $data) {
        $this->validate($data, [
            'id_sekolah'    => 'required|exists:tbl_sekolah,id',
            'id_kelas'    => 'required|exists:set_pustaka,id',
        ]);
        $user               = User::find(Auth::id());
        $user->id_sekolah = $data->id_sekolah;
        $user->id_kelas = $data->id_kelas;
        if($user->save())
            return redirect()->back()->with('success', 'Berhasil Mengubah Profil');
        return redirect()->back()->with('danger', 'Gagal Mengubah Profil');
    }

    public function editEmail(Request $data) {
        $this->validate($data, [
            'email' => 'required|string|email|max:255|unique:tbl_users,email,'. Auth::id() .'',
        ]);
        $user           = User::find(Auth::id());
        $user->email    = $data->email;
        if($user->save())
        return redirect()->back()->with('success', 'Berhasil Mengubah Email Anda menjadi <strong>' . $user->email . '</strong>');
        return redirect()->back()->with('danger', 'Gagal Mengubah Email Anda');
    }

    public function editUsername(Request $data) {
        $this->validate($data, [
            'username' => 'required|string|alpha_dash|max:255|unique:tbl_users,username,'. Auth::id() .'',
        ]);
        $user           = User::find(Auth::id());
        $user->username = $data->username;
        if($user->save())
        return redirect()->back()->with('success', 'Berhasil Mengubah Username Anda menjadi <strong>' . $user->username . '</strong>');
        return redirect()->back()->with('danger', 'Gagal Mengubah Username Anda');
    }

    public function editPassword(Request $data) {
        $this->validate($data, [
            'current_password'   => 'required',
            'password'      => 'required|string|min:6|confirmed',
        ]);

        $user = User::find(Auth::id());
        if (Hash::check($data->current_password, $user->password)) {
            $user->password         = bcrypt($data->password);
            if($user->save())
            return redirect()->back()->with('success', 'Password Anda berhasil diubah.');
            return redirect()->back()->with('danger', 'Gagal mengubah Password');
        }
        return redirect()->back()->with('danger', "Kata Sandi lama yang Anda masukan salah. Silahkan coba lagi.");
    }

    public function photo() {
        $user   = User::findOrFail(Auth::id());
        return view('backend.profil.photo')->with([
            'user' => $user,
        ]);
    }

    public function uploadPhoto(Request $data){
        list($type, $data->img)    = explode(';', $data->img);
        list(, $data->img)         = explode(',', $data->img);
        $file                       = base64_decode($data->img);
        $direktori 			        = date("Ymdhis");                 //Tahun/Bulan
        $foto                       = $direktori . time() .'.jpg';
        if(Storage::disk('photo-profil')->put($foto, $file)) {
            $user       = User::find(Auth::id());
            $user->foto = $foto;
            if($user->save()) {
                return redirect()->route('backend.profil')->with("success", "Photo Profil Berhasil Diubah");
            }
            return redirect()->back()->with("danger", "Gagal Menyimpan Photo Profil");
        }
        return redirect()->back()->with("danger", "Gagal Mengupload Photo Profil");
    }
}
