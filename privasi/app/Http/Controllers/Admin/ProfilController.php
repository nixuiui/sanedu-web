<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Storage;
use Validator;
use App\Models\User;

class ProfilController extends Controller {

    public function edit() {
        $user       = User::find(Auth::id());
        return view('admin.profil.edit')->with([
            'user' => $user,
        ]);
    }

    public function editProfil(Request $data) {
        // 'alamat'            => 'required|string|email|max:255|unique:users,email,'. Auth::id() .'',
        $this->validate($data, [
            'nama'              => 'required|string|max:255',
            'no_hp'             => 'required',
            'alamat'            => 'required',
            'asal_sekolah'      => 'required',
            'tempat_lahir'      => 'required',
        ]);

        $user               = User::find(Auth::id());
        $user->nama         = $data->nama;
        $user->no_hp        = $data->no_hp;
        $user->alamat       = $data->alamat;
        $user->asal_sekolah = $data->asal_sekolah;
        $user->tempat_lahir = $data->tempat_lahir;
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

    public function uploadPhoto(Request $input){
        list($type, $input->img)    = explode(';', $input->img);
        list(, $input->img)         = explode(',', $input->img);
        $file                       = base64_decode($input->img);
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
