<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SetPustaka;
use App\Models\Universitas;
use App\Models\Jurusan;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Sekolah;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

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
                        $jenisUjian = SetPustaka::whereIn('id', [1401, 1402, 1403, 1410])->get();
                        break;
                    case '1302':    //SMP
                        $jenisUjian = SetPustaka::whereIn('id', [1401, 1402, 1403, 1410])->get();
                        break;
                    case '1303':    //SMA
                        $jenisUjian = SetPustaka::whereIn('id', [1401, 1402, 1403, 1404, 1405, 1406, 1407, 1408, 1409, 1410])->get();
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
                if($idSekolah == '1303')
                    $mapel = SetPustaka::whereIn('id', [1527, 1528, 1502, 1503, 1510, 1511, 1512, 1513, 1514, 1515])->get();
                $kelas = SetPustaka::whereIn('id', [1606, 1609, 1612])->orderBy('id','asc')->get();
            }
            //UTS & UAS & LATIHAN SOAL
            else if($idUjian == 1402 || $idUjian == 1403 || $idUjian == 1410) {
                $mapel = SetPustaka::whereIn('id', [1501, 1502, 1503, 1504, 1505, 1507, 1508, 1509, 1510, 1511, 1512, 1513, 1514, 1515])->get();
                if($idSekolah == 1301) $kelas = SetPustaka::whereIn('id', [1601, 1602, 1603, 1604, 1605, 1606])->get();
                if($idSekolah == 1302) $kelas = SetPustaka::whereIn('id', [1607, 1608, 1609])->get();
                if($idSekolah == 1303) $kelas = SetPustaka::whereIn('id', [1610, 1611, 1612])->get();
            }
            //SBMPTN
            else if($idUjian == 1404) {
                $mapel = SetPustaka::whereIn('id', [1516, 1517, 1529])->get();
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


    public function provinsi($id = null) {
        if($id == null)
            $data = Provinsi::orderBy('name', 'desc')->get();
        else
            $data = Provinsi::with('kota')->where('id', $id)->first();
        $json = array(
            "success" => false,
            "message" => "Data Provinsi Belum Ada"
        );
        if($data != null)
            $json = array(
                "success"   => true,
                "data"      => $data
            );
        return json_encode($json);
    }

    public function kota($id = null) {
        if($id == null)
            $data = Kota::orderBy('name', 'desc')->get();
        else
            $data = Kota::with('kecamatan')->where('id', $id)->first();
        $json = array(
            "success" => false,
            "message" => "Data kota Belum Ada"
        );
        if($data != null)
            $json = array(
                "success"   => true,
                "data"      => $data
            );
        return json_encode($json);
    }

    public function kecamatan($id = null) {
        if($id == null)
            $data = Kecamatan::orderBy('name', 'desc')->get();
        else
            $data = Kecamatan::with('kelurahan')->where('id', $id)->first();
        $json = array(
            "success" => false,
            "message" => "Data Kecamatan Belum Ada"
        );
        if($data != null)
            $json = array(
                "success"   => true,
                "data"      => $data
            );
        return json_encode($json);
    }

    public function kelurahan($id = null) {
        if($id == null)
            $data = Kelurahan::orderBy('name', 'desc')->get();
        else
            $data = Kelurahan::with('rw')->where('id', $id)->first();
        $json = array(
            "success" => false,
            "message" => "Data Kelurahan Belum Ada"
        );
        if($data != null)
            $json = array(
                "success"   => true,
                "data"      => $data
            );
        return json_encode($json);
    }

    public function sekolah() {
        $data = [];
        if(isset($_GET['id_kota'])) {
            $data = Sekolah::where("id_kota", $_GET['id_kota']);
            if(isset($_GET['id_tingkat_sekolah']))
                $data = $data->where("id_tingkat_sekolah", $_GET['id_tingkat_sekolah']);
            $data = $data->orderBy("nama", "asc")->get();
        }
        else if(isset($_GET['id_provinsi'])) {
            $data = Sekolah::where("id_provinsi", $_GET['id_provinsi']);
            if(isset($_GET['id_tingkat_sekolah']))
                $data = $data->where("id_tingkat_sekolah", $_GET['id_tingkat_sekolah']);
            $data = $data->orderBy("nama", "asc")->get();
        }
        else if(isset($_GET['id_tingkat_sekolah'])) {
            $data = Sekolah::where("id_tingkat_sekolah", $_GET['id_tingkat_sekolah'])
                            ->orderBy("nama", "asc")
                            ->get();
        }
        $json = array(
            "success"   => true,
            "data"      => $data
        );
        return json_encode($json);
    }

    public function kelas() {
        $data = SetPustaka::tingkatKelas();
        if(isset($_GET['id_tingkat_sekolah'])) {
            switch($_GET['id_tingkat_sekolah']) {
                case 1301:
                    $data = SetPustaka::whereIn("id", [1601, 1602, 1603, 1604, 1605, 1606])
                                        ->orderBy("nama", "asc")
                                        ->get();
                    break;
                case 1302:
                    $data = SetPustaka::whereIn("id", [1607, 1608, 1609])
                                        ->orderBy("nama", "asc")
                                        ->get();
                    break;
                case 1303:
                    $data = SetPustaka::whereIn("id", [1610, 1611, 1612])
                                        ->orderBy("nama", "asc")
                                        ->get();
                    break;
            }
        }
        $json = array(
            "success"   => true,
            "data"      => $data
        );
        return json_encode($json);
    }
}
