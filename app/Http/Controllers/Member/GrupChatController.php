<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Auth;
use Uuid;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\GrupChat;
use App\Models\GrupChatMember;

class GrupChatController extends Controller
{

    public function index() {
        $wa = GrupChatMember::where('id_user', Auth::id())->first();
        $grupWa = GrupChat::where('jumlah_member', '<', 40)
                ->orderBy('jumlah_member', 'desc')->get();

        return view('member.grupchat.index')->with([
            'wa' => $wa,
            'grupWa' => $grupWa,
        ]);
    }

    public function joinWa() {
        $cekSudahJoin = GrupChatMember::where('id_kategori_grup_chat', 1202)->where('id_user', Auth::id())->first();
        if($cekSudahJoin != null) return back();

        $grup = GrupChat::where('id_kategori_grup_chat', 1202)
                ->where('jumlah_member', '<', 40)
                ->orderBy('jumlah_member', 'desc')->first();
        if($grup == null)
            return back()->with('danger', "Maaf saat ini Grup Chat WhatsApp belum tersedia");

        $member = new GrupChatMember;
        $member->id = Uuid::generate();
        $member->id_user = Auth::id();
        $member->id_grup_chat = $grup->id;
        $member->id_kategori_grup_chat = 1202;
        if($member->save())
            return back();
        return back()->with('danger', "Terjadi kesalahan saat ingin join Grup Chat");
    }

    public function joinLine() {
        $cekSudahJoin = GrupChatMember::where('id_kategori_grup_chat', 1201)->where('id_user', Auth::id())->first();
        if($cekSudahJoin != null) return back();

        $grup = GrupChat::where('id_kategori_grup_chat', 1201)
                ->where('jumlah_member', '<', 40)
                ->orderBy('jumlah_member', 'desc')->first();
        if($grup == null)
            return back()->with('danger', "Maaf saat ini Grup Chat LINE belum tersedia");

        $member = new GrupChatMember;
        $member->id = Uuid::generate();
        $member->id_user = Auth::id();
        $member->id_grup_chat = $grup->id;
        $member->id_kategori_grup_chat = 1201;
        if($member->save())
            return back();
        return back()->with('danger', "Terjadi kesalahan saat ingin join Grup Chat");
    }

}
