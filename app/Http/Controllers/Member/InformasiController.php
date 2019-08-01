<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Uuid;
use App\Models\Informasi;
use App\Models\Universitas;
use App\Models\Jurusan;
use App\Models\PassingGradeTahun;
use App\Models\PassingGradeOwned;
use App\Models\PassingGradeVoucher;

class InformasiController extends Controller
{
    public function index() {
        $informasi = Informasi::paginate(15);
        if(isset($_GET['kategori']) && ($_GET['kategori'] == 1701 || $_GET['kategori'] == 1702 || $_GET['kategori'] == 1703))
            $informasi = Informasi::where('id_kategori', $_GET['kategori'])->paginate(15);
        return view('member.informasi.index')->with([
            'informasi' => $informasi
        ]);
    }

    public function view($id) {
        $informasi = Informasi::find($id);
        $other = Informasi::where("id_kategori", $informasi->id_kategori)->limit(3)->get();
        return view('member.informasi.view')->with([
            'informasi' => $informasi,
            'other' => $other
        ]);
    }

    public function passGrade() {
        $universitas = Universitas::where('is_published', 1)->orderBy("updated_at", "desc")->get();
        $universitas = $universitas->map(function($data){
            return Universitas::mapData($data);
        });
        if(isset($_GET['universitas']) && $_GET['universitas'] != null) {
            $universitas = Universitas::findOrFail($_GET['universitas']);

            // CEK JIKA PASSGRADE SUDAH DIMILIKI
            $owned = PassingGradeOwned::where('id_passing_grade_universitas', $universitas->id)
                                        ->where('id_user', Auth::id())
                                        ->first();
            if(!$owned) {
                return view('member.informasi.passgrade-payment')->with([
                    'universitas' => $universitas
                ]);
            }

            $jurusan = Jurusan::where('tahun', PassingGradeTahun::active()->tahun)
                                ->where('id_universitas', $_GET['universitas']);
            $jurusan = $jurusan->orderBy('jurusan', 'asc')->get();
            $jurusan = $jurusan->map(function($data){
                return Jurusan::mapData($data);
            });
            return view('member.informasi.passgrade')->with([
                'universitas' => $universitas,
                'jurusan' => $jurusan
            ]);
        }
        return view('member.informasi.passgrade')->with([
            'universitas' => $universitas
        ]);
    }

    public function beliPassGrade(Request $request, $id) {
        $universitas = Universitas::findOrFail($id);
        if(!$request->voucher && Auth::user()->saldo < $universitas->harga)
            return back()->with('danger', 'Saldo Anda tidak cukup untuk membeli Passing Grade. Gunakan voucher bila Ada.');
        else if($request->voucher) {
            $voucher = PassingGradeVoucher::where('pin', $request->voucher)
                                            ->whereNull('id_user')
                                            ->first();
            if(!$voucher)
                return back()->with('danger', 'Kode Voucher yang Anda masukan tidak tersedia');
            else if($voucher->harga < $universitas->harga) {
                return back()->with('danger', 'Anda tidak dapat membeli Passing Grade dengan harga lebih dari ' . formatUang($voucher->harga));
            }
            else {
                $voucher->id_user = Auth::id();
                $voucher->save();
            }
        }
                    
        $own = new PassingGradeOwned;
        $own->id = Uuid::generate();
        $own->id_passing_grade_universitas = $universitas->id;
        $own->id_user = Auth::id();
        $own->harga = $universitas->harga;
        $own->save();

        return redirect(route('member.passgrade', ['universitas' => $universitas->id]));
    }
}
