<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SetPustaka;
use App\Models\Universitas;
use App\Models\Jurusan;

class AJAXController extends Controller
{
    public function createUjian() {
        $idSekolah = null;
        $idUjian = null;
        if(isset($_GET['idSekolah']) && $_GET['idSekolah'] != null) $idSekolah = $_GET['idSekolah'];
        if(isset($_GET['idUjian']) && $_GET['idUjian'] != null) $idUjian = $_GET['idUjian'];

        if($_GET['request'] == 'jenisujian') {
            $jenisUjian = SetPustaka::jenisUjian();
            if($idSekolah != null){
                switch ($idSekolah) {
                    case '1301':    //SD
                        $jenisUjian = SetPustaka::whereIn('id', [1401, 1402, 1403])->get();
                        break;
                    case '1302':    //SMP
                        $jenisUjian = SetPustaka::whereIn('id', [1401, 1402, 1403])->get();
                        break;
                    case '1303':    //SMA
                        $jenisUjian = SetPustaka::whereIn('id', [1401, 1402, 1403, 1404, 1405, 1406, 1407, 1408, 1409])->get();
                        break;
                }
            }
            return response()->json($jenisUjian);
        }
        else if($_GET['request'] == 'kelasmapel') {
            $mapel = [];
            $kelas = [];
            //UJIAN NASIONAL
            if($idUjian == 1401) {
                $mapel = SetPustaka::whereIn('id', [1501, 1502, 1503, 1504])->get();
            }
            //UTS & UAS
            else if($idUjian == 1402 || $idUjian == 1403) {
                $mapel = SetPustaka::whereIn('id', [1501, 1502, 1503, 1504, 1505, 1507, 1508, 1509, 1510, 1511, 1512, 1513, 1514, 1515])->get();
                if($idSekolah == 1301) $kelas = SetPustaka::whereIn('id', [1601, 1602, 1603, 1604, 1605, 1606])->get();
                if($idSekolah == 1302) $kelas = SetPustaka::whereIn('id', [1607, 1608, 1609])->get();
                if($idSekolah == 1303) $kelas = SetPustaka::whereIn('id', [1610, 1611, 1612])->get();
            }
            //SBMPTN
            else if($idUjian == 1404) {
                $mapel = SetPustaka::whereIn('id', [1516, 1517, 1518])->get();
            }
            //STAN
            else if($idUjian == 1405) {
                $mapel = SetPustaka::whereIn('id', [1525])->get();
            }
            //POLTEKES
            else if($idUjian == 1406) {
                $mapel = SetPustaka::whereIn('id', [1524])->get();
            }
            //POLITEKNIK
            else if($idUjian == 1407) {
                $mapel = SetPustaka::whereIn('id', [1523])->get();
            }
            //STIS
            else if($idUjian == 1408) {
                $mapel = SetPustaka::whereIn('id', [1526])->get();
            }
            //KEDINASAN
            else if($idUjian == 1409) {
                $mapel = SetPustaka::whereIn('id', [1519, 1520, 1521, 1522])->get();
            }
            return response()->json([
                'mapel' => $mapel,
                'kelas' => $kelas
            ]);
        }


    }

    public function selectUjian($idUjian = null) {

    }

    public function universitas($id=null) {
        $universitas = Universitas::select('id', 'nama')->orderBy('nama', 'asc')->get();
        if($id==null) return response()->json($universitas);

        $jurusan = Jurusan::where('id_universitas', $id)->select('id', 'jurusan', 'saintek', 'soshum');
        if(isset($_GET['jurusan']) && $_GET['jurusan'] != null) {
            $idjur = $_GET['jurusan'];
            if($idjur == 1516)
                $jurusan = $jurusan->where('saintek', 1);
            elseif($idjur == 1517)
                $jurusan = $jurusan->where('soshum', 1);
            else
                $jurusan = $jurusan->where('saintek', 1)->where('soshum', 1);
        }
        $jurusan = $jurusan->orderBy('jurusan', 'asc')->get();
        return response()->json($jurusan);
    }
}
