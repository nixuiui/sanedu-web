<?php

namespace App\Http\Controllers\AdminTiket;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Storage;
use Validator;
use App\Models\User;

class ProfilController extends Controller {

    public function editProfil(Request $data, $id) {
        // 'alamat'            => 'required|string|email|max:255|unique:users,email,'. $id .'',
        $this->validate($data, [
            'nama'              => 'required|string|max:255',
            'no_hp'             => 'required',
            'alamat'            => 'required',
            'tempat_lahir'      => 'required',
        ]);

        $user               = User::find($id);
        $user->nama         = $data->nama;
        $user->no_hp        = $data->no_hp;
        $user->alamat       = $data->alamat;
        $user->tempat_lahir = $data->tempat_lahir;
        if($user->save())
            return redirect()->back()->with('success', 'Berhasil Mengubah Profil');
        return redirect()->back()->with('danger', 'Gagal Mengubah Profil');
    }

    public function editEmail(Request $data, $id) {
        $this->validate($data, [
            'email' => 'required|string|email|max:255|unique:tbl_users,email,'. $id .'',
        ]);
        $user           = User::find($id);
        $user->email    = $data->email;
        if($user->save())
            return redirect()->back()->with('success', 'Berhasil Mengubah Email menjadi <strong>' . $user->email . '</strong>');
        return redirect()->back()->with('danger', 'Gagal Mengubah Email');
    }

    public function editUsername(Request $data, $id) {
        $this->validate($data, [
            'username' => 'required|string|alpha_dash|max:255|unique:tbl_users,username,'. $id .'',
        ]);
        $user           = User::find($id);
        $user->username = $data->username;
        if($user->save())
            return redirect()->back()->with('success', 'Berhasil Mengubah Username menjadi <strong>' . $user->username . '</strong>');
        return redirect()->back()->with('danger', 'Gagal Mengubah Username');
    }

    public function editPassword(Request $data, $id) {
        $this->validate($data, [
            'password'      => 'required|string|min:6|confirmed',
        ]);

        $user = User::find($id);
        $user->password         = bcrypt($data->password);
        if($user->save())
            return redirect()->back()->with('success', 'Password berhasil diubah.');
        return redirect()->back()->with('danger', 'Gagal mengubah Password');
    }

}
