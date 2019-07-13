<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Informasi;
use App\Models\Universitas;
use App\Models\Jurusan;
use App\Models\PassingGradeTahun;

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
        $universitas = Universitas::orderBy("nama", "asc")->get();
        $universitas = $universitas->map(function($data){
            return (object)[
                'id' => $data->id,
                'nama' => $data->nama,
                'akreditasi' => $data->akreditasi,
                'harga' => $data->harga,
                'format_harga' => $data->harga > 0 ? formatUang($data->harga) : "Gratis",
                'url_detail' => route('member.passgrade', ['universitas' => $data->id])
            ];
        });
        if(isset($_GET['universitas']) && $_GET['universitas'] != null) {
            $jurusan = Jurusan::where('tahun', PassingGradeTahun::active()->tahun)
                                ->where('id_universitas', $_GET['universitas']);
            $jurusan = $jurusan->orderBy('jurusan', 'asc')->get();
            return view('member.informasi.passgrade')->with([
                'universitas' => $universitas,
                'jurusan' => $jurusan
            ]);
        }
        return view('member.informasi.passgrade')->with([
            'universitas' => $universitas
        ]);
    }
}
