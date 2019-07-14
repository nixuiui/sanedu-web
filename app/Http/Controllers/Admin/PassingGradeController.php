<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Uuid;
use PDF;
use Excel;
use Auth;
use App\Models\Universitas;
use App\Models\Jurusan;
use App\Models\PassingGradeTahun;
use App\Models\PassingGradeNilaiUTBK;
use App\Models\PassingGradeCetakVoucher;
use App\Models\PassingGradeVoucher;

class PassingGradeController extends Controller
{
    public function index() {
        if(isset($_GET['tahun'])) {
            PassingGradeTahun::where('is_active', 1)->update(['is_active' => 0]);
            $tahun = PassingGradeTahun::where("tahun", $_GET['tahun'])->first();
            $tahun->is_active = 1;
            $tahun->save();
        }
        $universitas = Universitas::orderBy("nama", "asc")->get();
        $tahun = PassingGradeTahun::orderBy("tahun", "asc")->get();
        $tahunAktif = PassingGradeTahun::active()->tahun;
        return view('admin.passgrade.index')->with([
            'universitas' => $universitas,
            'years' => $tahun,
            'activeYears' => $tahunAktif
        ]);
    }

    public function createPassgrade() {
        $tahun = PassingGradeTahun::where("tahun", $_GET['tahun'])->first();
        if($tahun != null)
            return redirect()->back()->with("error", "Passing Grade untuk tahun tersebut sudah tersedia");
        
        PassingGradeTahun::where('is_active', 1)->update(['is_active' => 0]);
        $tahun = new PassingGradeTahun;
        $tahun->tahun = $_GET['tahun'];
        $tahun->is_active = 1;
        $tahun->save();
        return redirect()->back()->with("success", "Berhasil membuat Passing Grade");
    }

    public function openUniv($id) {
        $universitas    = Universitas::find($id);
        $jurusan        = Jurusan::where('tahun', PassingGradeTahun::active()->tahun)
                                ->where('id_universitas', $id)
                                ->orderBy("jurusan", "asc")
                                ->get();
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
            'nama' => 'string',
            'akreditasi' => 'string|max:2',
            'harga' => 'numeric',
            'file' => 'nullable',
            'peminat' => 'numeric',
            'daya_tampung' => 'numeric'
        ]);
        $universitas = null;
        if(!isset($_GET['type'])) {
            $universitas = new Universitas;
            $universitas->id = Uuid::generate();
            if($id != null) $universitas = Universitas::find($id);
            $universitas->nama = $input->nama;
            $universitas->akreditasi = $input->akreditasi;
            $universitas->harga = $input->harga;
            $universitas->save();
        }
        else {
            if($id != null) 
                $universitas = Universitas::find($id);
        }
        if($input->hasFile('file')){
            $path = $input->file('file')->getRealPath();
            $data = collect(Excel::load($path, function($header) {})->get());
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
                    $passGrade->tahun           = PassingGradeTahun::active()->tahun;
                    $passGrade->save();

                    $nilaiUTBK                      = new PassingGradeNilaiUTBK;
                    $nilaiUTBK->id                  = Uuid::generate();
                    $nilaiUTBK->id_jurusan          = $passGrade->id;
                    $nilaiUTBK->s_penalaran_umum    = $value->s_penalaran_umum;
                    $nilaiUTBK->s_kuantitatif       = $value->s_kuantitatif;
                    $nilaiUTBK->s_pemahaman_umum    = $value->s_pemahaman_umum;
                    $nilaiUTBK->s_baca_menulis      = $value->s_baca_menulis;
                    $nilaiUTBK->ipa_matematika      = $value->ipa_matematika;
                    $nilaiUTBK->ipa_fisika          = $value->ipa_fisika;
                    $nilaiUTBK->ipa_kimia           = $value->ipa_kimia;
                    $nilaiUTBK->ipa_biologi         = $value->ipa_biologi;
                    $nilaiUTBK->ips_matematika      = $value->ips_matematika;
                    $nilaiUTBK->ips_geografi        = $value->ips_geografi;
                    $nilaiUTBK->ips_sejarah         = $value->ips_sejarah;
                    $nilaiUTBK->ips_sosiologi       = $value->ips_sosiologi;
                    $nilaiUTBK->ips_ekonomi         = $value->ips_ekonomi;
                    $nilaiUTBK->save();
                }
            }
        }
        return redirect()->route('admin.passgrade')->with("success", "Berhasil");
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

    public function downloadFormat() {
        $pesertaArray = [];
        $pesertaArray[] = [
            'jurusan', 
            'kuota', 
            'peminat', 
            'passing_grade', 
            'akreditasi', 
            'soshum', 
            'saintek', 
            's_penalaran_umum', 
            's_kuantitatif',
            's_pemahaman_umum',
            's_baca_menulis',
            'ipa_matematika',
            'ipa_fisika',
            'ipa_kimia',
            'ipa_biologi',
            'ips_matematika',
            'ips_geografi',
            'ips_sejarah',
            'ips_sosiologi',
            'ips_ekonomi'];
        $pesertaArray[] = [
            'Ilmu Komputer', 
            '130', 
            '1200', 
            '30', 
            'A', 
            1, 
            0, 
            '543', 
            '432',
            '342',
            '342',
            '342',
            '342',
            '342',
            '342',
            '342',
            '342',
            '342',
            '342',
            '342'];
        Excel::create('Format Import Passing Grade', function($excel) use ($pesertaArray) {
            $excel->setTitle('Format Import Passing Grade');
            $excel->setCreator('Niki Rahmadi Wiharto')->setCompany('Sanedu');
            $excel->setDescription('Format Import Passing Grade');
            $excel->sheet('sheet1', function($sheet) use ($pesertaArray) {
                $sheet->fromArray($pesertaArray, null, 'A1', false, false);
            });
        })->download('xlsx');
    }

    public function tiket() {
        $cetak = PassingGradeCetakVoucher::orderBy("created_at", "desc")->get();
        $jumlahVoucher = collect(DB::select(
            "SELECT
            SUM(jumlah_voucher) as jumlah
            FROM
            tbl_passing_grade_cetak_voucher
            WHERE
            deleted_at IS NULL"
        ))->first();
        return view('admin.passgrade.tiket')->with([
            "cetak" => $cetak,
            "jumlahVoucher" => $jumlahVoucher->jumlah,
        ]);
    }

    public function generateTiket(Request $input){
        $this->validate($input, [
            'jumlah'    => 'required|max:1000|numeric',
            'harga'     => 'required|numeric',
        ]);
        $cetakVoucher           = new PassingGradeCetakVoucher();
        $cetakVoucher->id       = Uuid::generate();
        $cetakVoucher->id_user  = Auth::id();
        $cetakVoucher->harga    = $input->harga;
        if($cetakVoucher->save()) {
            foreach (range(1,$input->jumlah) as $i => $key) {
                $date                       = date("ymdhis");
                $pin                        = 3 . date("y") . substr($date, -2) . substr($date, -6, 2) . substr(time(), -6, 2) . substr(time(), -1) .  randomNumber(3) . angkaUrut($i);
                $voucher                      = new PassingGradeVoucher();
                $voucher->id                  = Uuid::generate();
                $voucher->id_cetak_voucher      = $cetakVoucher->id;
                $voucher->pin                 = $pin;
                $voucher->save();
            }
        }
        return back()->with('success', 'Voucher berhasil dibuat.');
    }

    public function deleteCetakTiket($id) {
        $cetak = PassingGradeCetakVoucher::findOrFail($id);
        $cetak->delete();
        return back()->with('success', 'Berhasil Menghapus.');
    }

    public function printTiket($id) {
        $paperSize = isset($_GET['paperSize']) && $_GET['paperSize'] == 'a3' ? 'a3' : 'a4';
        $cetak = PassingGradeCetakVoucher::findOrFail($id);
        $tiket      = PassingGradeVoucher::where('id_cetak_voucher', $cetak->id)->get();
        // return view("template.tiket.legacy-2019-$paperSize")->with('tiket', $tiket);
        $pdf = PDF::loadView("template.tiket.voucher-pg-$paperSize", compact(['tiket', 'cetak']))->setPaper($paperSize);
        return $pdf->stream("Voucher Passing Grade - ".tanggal($cetak->created_at).'.pdf');
    }

    public function tiketDetail($idCetak = null) {
        $voucher = PassingGradeVoucher::get();
        if($idCetak != null)
        $voucher = PassingGradeVoucher::where("id_cetak_voucher", $idCetak)->get();
        return view('admin.passgrade.tiketdetail')->with([
            "voucher" => $voucher
        ]);
    }
}
