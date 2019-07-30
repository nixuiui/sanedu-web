<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\SaldoTopup;
use App\Models\RiwayatSaldo;

class SaldoController extends Controller {

    public function index() {
        $topup = SaldoTopup::where('id_status_pembayaran', 2001)
                            ->where('expired_date', '>', date("Y-m-d H:i:s"))
                            ->get();
        return view('admin.saldo.index')->with([
            'topup' => $topup
        ]);
    }

    public function topupApprove($id) {
        $topup = SaldoTopup::where("id", $id)
                            ->where("id_status_pembayaran", 2001)
                            ->where('expired_date', '>', date("Y-m-d H:i:s"))
                            ->first();
        
        $user = User::find($topup->id_user);
        $user->saldo += $topup->saldo;
        $user->save();

        $saldo = new RiwayatSaldo;
        $saldo->id_user = $user->id;
        $saldo->deb_cr = $topup->saldo;
        $saldo->saldo = $user->saldo;
        $saldo->id_kategori = 1801;
        $saldo->id_object = $topup->id;
        $saldo->save();

        $topup->id_status_pembayaran = 2002;
        $topup->save();

        return back();
    }

    public function topupDelete($id) {
        SaldoTopup::findOrFail($id)->forceDelete();
        return back();
    }

}
