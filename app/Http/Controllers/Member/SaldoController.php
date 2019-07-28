<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Uuid;
use App\Models\RiwayatSaldo;
use App\Models\SaldoTopup;
use App\Models\MetodePembayaran;

class SaldoController extends Controller
{

    public function index() {
        $riwayat = RiwayatSaldo::where('id_user', Auth::id())
                                ->where('deb_cr', '!=', 0)
                                ->orderBy('created_at', 'desc')
                                ->get();
        $topup = SaldoTopup::where('id_status_pembayaran', 2001)
                            ->where('id_user', Auth::id())
                            ->where('expired_date', '>', date("Y-m-d H:i:s"))
                            ->get();
        $metodePembayaran = MetodePembayaran::orderby('nama', 'asc')->get();
        return view('member.saldo.index')->with([
            'metodePembayaran' => $metodePembayaran,
            'topup' => $topup,
            'riwayat' => $riwayat
        ]);
    }

    public function topUp(Request $request) {
        $now = date("Y-m-d H:i:s");
        $topup = new SaldoTopup;
        $topup->id = Uuid::generate();
        $topup->saldo = $request->saldo;
        $topup->jumlah_bayar = $request->jumlah_bayar;
        $topup->id_status_pembayaran = 2001;
        $topup->id_metode_pembayaran = $request->metode_pembayaran;
        $topup->id_user = Auth::id();
        $topup->expired_date = date("Y-m-d H:i:s", strtotime($now . ' +1 day'));
        $topup->save();
        return redirect()->route('member.saldo.petunjuk.bayar', $topup->id);
    }

    public function petunjukBayar($id) {
        $topup = SaldoTopup::findOrFail($id);
        $metodePembayaran = MetodePembayaran::findOrFail($topup->id_metode_pembayaran);
        return view('member.saldo.petunjukbayar')->with([
            'metodePembayaran' => $metodePembayaran,
            'topup' => $topup
        ]);
    }

}
