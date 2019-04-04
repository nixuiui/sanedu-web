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
use App\Models\Provinsi;

class MemberController extends Controller {

    public function index() {
        $user = User::select(['id', 'nama', 'email', 'id_sekolah', 'id_provinsi'])
                    ->where('id_role', 1004)
                    ->orderBy('id_role', 'asc')
                    ->get();
        return view('admin.member.index')->with([
            'users' => $user
        ]);
    }

    public function provinsi($id = null) {
        $jumlahMember = collect(DB::select("SELECT COUNT(id) as jumlah FROM tbl_users WHERE id_role='1004' AND deleted_at IS NULL"))->first();
        if($id == null) {
            $prov = Provinsi::all();
            return view('admin.member.provinsi')->with([
                'provinsi' => $prov,
                'jumlahMember' => $jumlahMember
            ]);
        }
        else {
            $prov = Provinsi::findOrFail($id);
            $user = User::select(['id', 'nama', 'email', 'id_sekolah', 'id_provinsi'])
                        ->where('id_role', 1004)
                        ->where('id_provinsi', $prov->id)
                        ->orderBy('id_role', 'asc')
                        ->get();
            return view('admin.member.index')->with([
                'users' => $user
            ]);
        }
    }

    public function generate() {
        $user = User::where('id_role', 1004)->orderBy('id_role', 'asc')->get();
        foreach($user as $data) {
            if($data->sekolah != null) {
                $data->id_provinsi = $data->sekolah->provinsi->id;
                $data->id_kota = $data->sekolah->kota->id;
                $data->save();
            }
            else {
                $data->id_provinsi = 18;
                $data->id_kota = 1871;
                $data->save();
            }
        }
    }

}
