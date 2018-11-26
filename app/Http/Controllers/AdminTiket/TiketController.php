<?php

namespace App\Http\Controllers\AdminTiket;

use Illuminate\Http\Request;
use Auth;
use Uuid;
use Illuminate\Support\Facades\Input;
use Excel;
use PDF;
use DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CetakTiket;
use App\Models\Tiket;

class TiketController extends Controller
{
    public function index() {
        $cetakTiket = CetakTiket::where("id_kategori_tiket", 1101)->orderBy("created_at", "desc")->get();
        $jumlahTiket = collect(DB::select(
            "SELECT
            SUM(jumlah_tiket) as jumlah
            FROM
            tbl_cetak_tiket
            WHERE
            id_kategori_tiket=1101 &&
            deleted_at IS NULL"
        ))->first();
        $jumlahMember = collect(DB::select(
            "SELECT
            COUNT(tbl_users.id) as jumlah
            FROM
            tbl_users
            INNER JOIN tbl_tiket ON tbl_users.kap=tbl_tiket.kap
            INNER JOIN tbl_cetak_tiket ON tbl_cetak_tiket.id=tbl_tiket.id_cetak_tiket
            WHERE
            tbl_users.kap=tbl_tiket.kap &&
            tbl_cetak_tiket.id_kategori_tiket=1101 &&
            tbl_users.deleted_at IS NULL"
        ))->first();
        return view('admintiket.tiket.member')->with([
            "cetakTiket" => $cetakTiket,
            "jumlahTiket" => $jumlahTiket->jumlah,
            "jumlahMember" => $jumlahMember->jumlah
        ]);
    }

    public function dataMember() {
        $member = User::select(['id', 'pin', 'kap', 'nama', 'asal_sekolah', 'no_hp'])->where('id_role', 1004)->get();
        return view('admintiket.tiket.memberdata')->with([
            "member" => $member
        ]);
    }

    public function dataMemberEdit($id) {
        $user = User::findOrFail($id);
        return view('admintiket.tiket.memberdataedit')->with([
            "user" => $user
        ]);
    }

    public function download() {
        $tiket = Tiket::where('id_user', '!=', null)->get();
        // return view('template.download-data-member')->with([
        //     "tiket" => $tiket
        // ]);
        $filename = 'datamember-' . hariTanggalWaktu();
        if(isset($_GET['file'])) {
            if($_GET['file'] == "pdf") {
                $pdf = PDF::loadView('template.download-data-member', ['tiket' => $tiket]);
                return $pdf->stream($filename.'.pdf');
            }
            else if($_GET['file'] == "excel") {
                $tiketArray = [];
                $tiketArray[] = ['No', 'PIN', 'KAP', 'Nama','Asal Sekolah','No. HP', 'Total Point'];
                foreach ($tiket as $no => $val) {
                    $tiketArray[] = [
                        $no + 1,
                        $val->pin,
                        $val->kap,
                        $val->user->nama,
                        $val->user->asal_sekolah,
                        $val->user->no_hp,
                        '0'
                    ];
                }
                Excel::create($filename, function($excel) use ($tiketArray) {
                    $excel->setTitle('Data Member Sanedu');
                    $excel->setCreator('Laravel')->setCompany('WJ Gilmore, LLC');
                    $excel->setDescription('payments file');
                    $excel->sheet('sheet1', function($sheet) use ($tiketArray) {
                        $sheet->fromArray($tiketArray, null, 'A1', false, false);
                    });
                })->download('xlsx');
            }
        }
    }

    public function generateTiket(Request $input){
        $this->validate($input, [
            'jumlah'         => 'required|max:1000|numeric',
        ]);
        $cetakTiket                     = new CetakTiket;
        $cetakTiket->id                 = Uuid::generate();
        $cetakTiket->id_kategori_tiket  = 1101;
        $cetakTiket->id_user            = Auth::id();
        if($cetakTiket->save()) {
            foreach (range(1,$input->jumlah) as $i => $key) {
                $date                       = date("ymdhis");
                $kap                        = 1 . substr(time(), -2) . substr(time(), -6, 2) . substr(time(), -1) . substr(time(), -8, 1) .  randomNumber(2) . angkaUrut($i);
                $pin                        = 1 . date("y") . substr($date, -2) . substr($date, -6, 2) . substr(time(), -6, 2) . substr(time(), -1) .  randomNumber(3) . angkaUrut($i);
                $tiket                      = new Tiket;
                $tiket->id                  = Uuid::generate();
                $tiket->id_kategori_tiket   = 1101;
                $tiket->id_cetak_tiket      = $cetakTiket->id;
                $tiket->kap                 = $kap;
                $tiket->pin                 = $pin;
                $tiket->save();
            }
        }
        return back()->with('success', 'Tiket berhasil dibuat.');
    }

    public function import(Request $input) {
        if($input->hasFile('file')){
            $path = $input->file('file')->getRealPath();
            $data = Excel::load($path, function($header) {
            })->get();
            if(!empty($data) && $data->count()){
                $cetakTiket                     = new CetakTiket;
                $cetakTiket->id                 = Uuid::generate();
                $cetakTiket->id_kategori_tiket  = 1101;
                $cetakTiket->id_user            = Auth::id();
                if($cetakTiket->save()) {
                    foreach ($data as $key => $value) {
                        if($value->kap == null || $value->pin == null)
                        continue;
                        $tiket                  = new Tiket;
                        $tiket->id              = Uuid::generate();
                        $tiket->id_cetak_tiket  = $cetakTiket->id;
                        $tiket->kap             = $value->kap;
                        $tiket->pin             = $value->pin;
                        $tiket->save();
                    }
                }
            }
        }
        return back()->with('success', 'Tiket berhasil dibuat.');
    }

    public function delete($id) {
        $cetakTiket = CetakTiket::findOrFail($id);
        $cetakTiket->delete();
        return back()->with('success', 'Berhasil Menghapus.');
    }

    public function printTiket($id) {
        $cetakTiket = CetakTiket::findOrFail($id);
        $tiket      = Tiket::where('id_cetak_tiket', $cetakTiket->id)->get();
        // return view('template.tiket')->with('tiket', $tiket);
        $pdf        = PDF::loadView('template.tiket.member-feb', compact(['tiket']))->setPaper('a4');
        return $pdf->stream($cetakTiket->kategoriTiket->nama.' - '.tanggal($cetakTiket->created_at).'.pdf');
    }
}
