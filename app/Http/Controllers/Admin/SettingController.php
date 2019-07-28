<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\MetodePembayaran;

class SettingController extends Controller {

    public function pembayaran() {
        $metodePembayaran = MetodePembayaran::get();
        return view('admin.setting.pembayaran.index')->with([
            'metodePembayaran' => $metodePembayaran
        ]);
    }
    
    public function formPembayaran($id = null) {
        if($id) {
            $pembayaran = MetodePembayaran::findOrFail($id);
            return view('admin.setting.pembayaran.form')->with("metodePembayaran", $pembayaran);
        }
        return view('admin.setting.pembayaran.form');
    }

    public function actionPembayaran(Request $request, $id = null) {
        $pembayaran = new MetodePembayaran;
        if($id) $pembayaran = MetodePembayaran::findOrFail($id);
        $pembayaran->nama = $request->nama;
        $pembayaran->nomor_rekening = $request->nomor_rekening;
        $pembayaran->nama_pemilik = $request->nama_pemilik;
        $pembayaran->intruksi = $request->intruksi;
        $pembayaran->save();
        return redirect()->route('admin.setting.metode.pembayaran')->with("success", "Berhasil menambah metode pembayaran");
    }

    public function hapusPembayaran($id) {
        MetodePembayaran::find($id)->delete();
        return back();
    }

}
