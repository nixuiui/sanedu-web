<?php

namespace App\Http\Controllers;
use Uuid;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Simulasi;
use App\Models\SimulasiPeserta;
use App\Models\PilihanPassingGrade;

class DummyController extends Controller
{

    public function dummySimulasiPeserta()
    {
        $user = User::where('id_role', 1004)->get();
        $simulasi = Simulasi::findOrFail('be805f40-c3a8-11e8-8e42-a5a1cf623806');
        foreach($user as $data) {
            $peserta = SimulasiPeserta::where('id_simulasi', $simulasi->id)
                                        ->where('id_user', $data->id)
                                        ->first();
            if(!$peserta)
                continue;
            $peserta = new SimulasiPeserta;
            $peserta->id = Uuid::generate();
            $peserta->id_simulasi = $simulasi->id;
            $peserta->id_user = $data->id;
            $peserta->harga = $simulasi->harga;
            $peserta->no_peserta = time();
            if($peserta->save()) {
                $passingGrade = new PilihanPassingGrade;
                $passingGrade->id = Uuid::generate();
                $passingGrade->id_simulasi = $simulasi->id;
                $passingGrade->pilihan_1 = '443da6e0-b847-11e8-a933-335dab9b2e96';
                $passingGrade->pilihan_2 = '443da6e0-b847-11e8-a933-335dab9b2e96';
                $passingGrade->pilihan_3 = '9dd49e20-9414-11e8-aae7-51686e1900ed';
                $passingGrade->jurusan = 1516;
                $passingGrade->save();
            }
        }
    }

}
