<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use Uuid;
use Excel;
use App\Models\Universitas;
use App\Models\Jurusan;

class PassingGradeController extends Controller
{
    public function index() {
        $universitas = Universitas::orderBy("nama", "asc")->get();
        return view('admin.passgrade.index')->with([
            'universitas' => $universitas
        ]);
    }

    public function openUniv($id) {
        $universitas    = Universitas::find($id);
        $jurusan        = Jurusan::where('id_universitas', $id)->orderBy("jurusan", "asc")->get();
        return view('admin.passgrade.jurusan')->with([
            'universitas' => $universitas,
            'jurusan' => $jurusan
        ]);
    }

    public function deleteUniv($idUnive) {
        $univ = Universitas::findOrFail($idUnive);
        $univ->delete();
        return redirect()->back()->with("success", "Berhasil dihapus");
    }

    public function formUniv($id=null) {
        if($id==null)
        return view('admin.passgrade.formuniv');

        $universitas = Universitas::find($id);
        return view('admin.passgrade.formuniv')->with([
            'universitas' => $universitas
        ]);
    }

    public function saveUniv(Request $input, $id=null) {
        $this->validate($input, [
            'nama' => 'required',
            'file' => 'nullable'
        ]);
        $universitas = new Universitas;
        $universitas->id = Uuid::generate();
        if($id != null)
        $universitas = Universitas::find($id);
        $universitas->nama = $input->nama;
        if($input->hasFile('file')){
            $path = $input->file('file')->getRealPath();
            $data = Excel::load($path, function($header) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    if( $value->jurusan == null &&
                        $value->daya_tampung == null &&
                        $value->peminat == null &&
                        $value->passing_grade == null &&
                        $value->akreditasi == null)
                    continue;
                    $passGrade                  = new Jurusan;
                    $passGrade->id              = Uuid::generate();
                    $passGrade->id_universitas  = $universitas->id;
                    $passGrade->jurusan         = $value->jurusan;
                    $passGrade->kuota           = $value->daya_tampung;
                    $passGrade->peminat         = $value->peminat;
                    $passGrade->passing_grade   = $value->passing_grade;
                    $passGrade->akreditasi      = $value->akreditasi;
                    $passGrade->soshum          = $value->soshum;
                    $passGrade->saintek         = $value->saintek;
                    $passGrade->save();
                }
            }
        }
        if($universitas->save())
        return redirect()->route('admin.passgrade')->with("success", "Berhasil menambah Universitas");
    }

    public function formJurusan($id, $idJur=null) {
        $universitas    = Universitas::find($id);
        if($idJur == null)
        return view('admin.passgrade.editjurusan')->with([
            'universitas' => $universitas
        ]);
        $jurusan        = Jurusan::find($idJur);
        return view('admin.passgrade.editjurusan')->with([
            'universitas' => $universitas,
            'jurusan' => $jurusan
        ]);
    }

    public function saveJurusan(Request $input, $id, $idJur=null) {
        $this->validate($input, [
            'jurusan' => 'required',
            'kuota' => 'required|numeric',
            'peminat' => 'required|numeric',
            'passing_grade' => 'required|numeric',
            'akreditasi' => 'required',
        ]);
        $universitas    = Universitas::find($id);
        $jurusan        = new Jurusan;
        $jurusan->id    = Uuid::generate();
        $jurusan->id_universitas = $universitas->id;
        if($idJur != null)
        $jurusan                = Jurusan::find($idJur);
        $jurusan->jurusan       = $input->jurusan;
        $jurusan->kuota         = $input->kuota;
        $jurusan->peminat       = $input->peminat;
        $jurusan->passing_grade = $input->passing_grade;
        $jurusan->akreditasi    = $input->akreditasi;
        $jurusan->soshum        = 0;
        $jurusan->saintek       = 0;
        if($input->soshum) $jurusan->soshum = 1;
        if($input->saintek) $jurusan->saintek = 1;
        $jurusan->save();
        return redirect()->route('admin.passgrade.open.univ', $universitas->id)->with('success', 'Berhasil mengubah data jurusan ' . $jurusan->jurusan);
    }

    public function deleteJurusan($id, $idJur) {
        $jurusan = Jurusan::find($idJur);
        $jurusan->delete();
        return redirect()->back()->with("success", "Berhasil dihapus");
    }
}
