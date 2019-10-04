<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use DB;
use Excel;
use App\Models\User;
use App\Models\Provinsi;

class MemberController extends Controller {

    public function index() {
        $user = User::select(['id', 'nama', 'email', 'no_hp', 'no_hp_ortu', 'id_sekolah', 'id_provinsi', 'saldo'])
                    ->where('id_role', 1004)
                    ->orderBy('id_role', 'asc')
                    ->get()->count();
        return view('admin.member.index')->with([
            'jumlah_user' => $user
        ]);
    }

    public function export() {
        $user = User::select(['id', 'nama', 'email', 'no_hp', 'no_hp_ortu', 'id_sekolah', 'id_provinsi', 'saldo'])
                    ->where('id_role', 1004)
                    ->orderBy('id_role', 'asc')
                    ->get();
        $pesertaArray = [];
        $pesertaArray[] = ['Nama', 'Asal Sekolah'];
        foreach ($user as $data) {
            $pesertaArray[] = [
                strtoupper($data->nama), 
                $data->sekolah != null ? $data->sekolah->nama : "-"
            ];
        }
        $title = "Data Member Sanedu";
        Excel::create($title, function($excel) use ($title, $pesertaArray) {
            $excel->setTitle($title);
            $excel->setCreator('Niki Rahmadi Wiharto')->setCompany('Sanedu');
            $excel->setDescription('Data Peserta');
            $excel->sheet('sheet1', function($sheet) use ($pesertaArray) {
                $sheet->fromArray($pesertaArray, null, 'A1', false, false);
            });
        })->download('xlsx');
    }

    public function data() {
        $user = User::select(['id', 'nama', 'email', 'no_hp', 'no_hp_ortu', 'id_sekolah', 'id_provinsi', 'saldo'])
                    ->where('id_role', 1004)
                    ->orderBy('id_role', 'asc')
                    ->get();
        return view('admin.member.data')->with([
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

    public function pesertaEdit($id) {
        $user = User::findOrFail($id);
        return view('admin.profil.edit')->with([
            'user' => $user
        ]);
    }

    public function pesertaDelete($id) {
        $user = User::findOrFail($id)->delete();
        return back()->with('success', 'Berhasil Menghapus');
    }

}
