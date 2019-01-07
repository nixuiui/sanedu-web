<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Informasi;
use App\Models\Universitas;
use App\Models\Jurusan;

class InformasiController extends Controller
{

    public function passGrade() {
        $universitas = Universitas::orderBy("nama", "asc")->get();
        if(isset($_GET['universitas']) && $_GET['universitas'] != null && isset($_GET['jurusan'])) {
            $jurusan = Jurusan::where('id_universitas', $_GET['universitas']);
            if($_GET['jurusan'] != null) {
                $soshum = $_GET['jurusan'] == 'soshum' ? '1' : '0';
                $saintek = $_GET['jurusan'] == 'saintek' ? '1' : '0';
                $jurusan = Jurusan::where('id_universitas', $_GET['universitas'])
                ->where('saintek', $saintek)
                ->where('soshum', $soshum);
            }
            $jurusan = $jurusan->orderBy('jurusan', 'asc')->get();
            return view('user.informasi.passgrade')->with([
                'universitas' => $universitas,
                'jurusan' => $jurusan
            ]);
        }
        return view('user.informasi.passgrade')->with([
            'universitas' => $universitas
        ]);
    }
    
}
