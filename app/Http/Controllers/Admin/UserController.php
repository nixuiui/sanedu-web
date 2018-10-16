<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Validator;
use Excel;
use Uuid;
use App\Models\User;
use App\Models\SetPustaka;

class UserController extends Controller {

    public function index() {
        $user = User::orderBy('id_role', 'asc');
        if(isset($_GET['role']) && ($_GET['role'] != null))
            $user = $user->where('id_role', $_GET['role']);
        $role = SetPustaka::role();
        return view('superadmin.user.index')->with([
            'users' => $user->get(),
            'roles' => $role,
        ]);
    }

    public function export() {
        $user = User::select(['id', 'name', 'username', 'telpon', 'id_role', 'foto', 'id_rt'])->where('id_role', '!=', 1)->orderBy('id_role', 'desc');
        if(isset($_GET['role'])) {
            if($_GET['role'] != null)
            $user = $user->where("id_role", $_GET['role']);
        }
        $user = $user->get();
        $userArrays     = [];
        $userArrays[]   = ['Nama Lengkap', 'Username', 'Email', 'Role', 'Kecamatan', 'Kelurahan', 'RW', 'RT'];
        foreach ($user as $data) {
            $userArrays[] =
            [
                $data->name,
                $data->username,
                $data->email,
                $data->role->nama,
                $data->rt->nama_kecamatan,
                $data->rt->nama_kelurahan,
                $data->rt->nama_rw,
                $data->rt->nama_rt
            ];
        }
        Excel::create('userronda', function($excel) use ($userArrays) {
            $excel->setTitle('User Ronda');
            $excel->setCreator('Niki Rahmadi Wiharto')->setCompany('DJ Corp');
            $excel->setDescription('Data pengguna Ronda');
            $excel->sheet('sheet1', function($sheet) use ($userArrays) {
                $sheet->fromArray($userArrays, null, 'A1', false, false);
            });

        })->download('xlsx');
        return redirect()->route('superadmin.user');
    }

    public function tambahPost(Request $input) {
        $this->validate($input, [
            'role'              => 'required|exists:set_pustaka,id',
            'nama'              => 'required|string|max:255',
            'email'             => 'required|string|email|max:255|unique:tbl_users',
            'username'          => 'required|alpha_dash|unique:tbl_users,username|min:6|max:255',
            'password'          => 'required|string|min:6|confirmed'
        ]);
        $user           = new User();
        $user->id       = Uuid::generate();
        $user->id_role  = $input->role;
        $user->nama     = $input->nama;
        $user->email    = $input->email;
        $user->username = $input->username;
        $user->password = bcrypt($input->password);
        if($user->save())
        return redirect()->route('superadmin.user')->with("success", "Berhasil Menambah User");
        return redirect()->route('superadmin.user')->with("danger", "Gagal Menambah User");
    }

    public function ubahPost(Request $input, $id) {
        $this->validate($input, [
            'role'              => 'required|exists:set_pustaka,id',
            'nama'              => 'required|string|max:255',
            'email'             => 'required|string|email|max:255|unique:tbl_users,email,'.$id,
            'username'          => 'required|alpha_dash|unique:tbl_users,username,' . $id . '|min:6|max:255',
            'password'          => 'nullable|string|min:6|confirmed'
        ]);
        $user           = User::findOrFail($id);
        $user->id_role  = $input->role;
        $user->nama     = $input->nama;
        $user->email    = $input->email;
        $user->username = $input->username;
        if(!empty($input->password))
        $user->password = bcrypt($input->password);
        if($user->save())
        return redirect()->route('superadmin.user')->with("success", "Berhasil Mengubah User");
        return redirect()->route('superadmin.user')->with("danger", "Gagal Menambah User");
    }

    public function hapus($id) {
        $user = User::find($id);
        if($user != null)
        if($user->delete())
        return redirect()->route('superadmin.user')->with("success", "Berhasil Di Hapus");
        return redirect()->route('superadmin.user')->with("danger", "Gagal Menghapus User Tidak Ditemukan");
    }

    public function getUser($id) {
        $data = User::with('role')->where('id', $id)->first();
        $json = array(
            "success" => false,
            "message" => "Data User Belum Ada"
        );
        if($data != null)
        $json = array(
            "success"   => true,
            "data"      => $data
        );
        return json_encode($json);
    }

}
