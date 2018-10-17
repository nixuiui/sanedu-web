<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use Uuid;
use App\Models\GrupChat;
use App\Models\GrupChatMember;
use App\Models\SetPustaka;

class GrupChatController extends Controller
{
    public function index() {
        $grupLine = GrupChat::where('id_kategori_grup_chat', 1201)
                            ->orderBy("jumlah_member", "desc")
                            ->orderBy("created_at", "asc")
                            ->get();
        $grupWA = GrupChat::where('id_kategori_grup_chat', 1202)
                            ->orderBy("jumlah_member", "desc")
                            ->orderBy("created_at", "asc")
                            ->get();
        return view('admin.grupchat.index')->with([
            'line' => $grupLine,
            'wa' => $grupWA
        ]);
    }

    public function viewGrup($id) {
        $grup = GrupChat::findOrFail($id);
        return view('admin.grupchat.view')->with([
            'grup' => $grup
        ]);
    }

    public function formTambah() {
        $grupKategori = SetPustaka::kategoriGrupChat();
        return view('admin.grupchat.tambah')->with([
            'grupKategori' => $grupKategori
        ]);
    }

    public function prosesTambah(Request $input) {
        $this->validate($input, [
            'kategori'  => 'required|string|exists:set_pustaka,id',
            'nama'      => 'required|string|max:255',
            'link'      => 'required|url',
        ]);
        $grup = new GrupChat;
        $grup->id = Uuid::generate();
        $grup->id_kategori_grup_chat = $input->kategori;
        $grup->nama = $input->nama;
        $grup->link = $input->link;
        if($grup->save())
            return redirect()->route('admin.grupchat')->with('success', 'Berhasil menambah Grup Chat');
        return redirect()->route('admin.grupchat')->with('danger', 'Terjadi kesalahan saat menambah Grup Chat');
    }

    public function formEdit($id) {
        $grup = GrupChat::findOrFail($id);
        return view('admin.grupchat.edit')->with([
            'grup' => $grup
        ]);
    }

    public function prosesEdit(Request $input, $id) {
        $this->validate($input, [
            'nama'  => 'required|string|max:255',
            'link'  => 'required|url',
        ]);
        $grup = GrupChat::findOrFail($id);
        $grup->nama = $input->nama;
        $grup->link = $input->link;
        if($grup->save())
            return redirect()->route('admin.grupchat')->with('success', 'Berhasil mengubah Grup Chat');
        return redirect()->route('admin.grupchat')->with('danger', 'Terjadi kesalahan saat mengubah Grup Chat');
    }

    public function delete($id) {
        $grup = GrupChat::findOrFail($id);
        if($grup->delete())
            return redirect()->route('admin.grupchat')->with('success', 'Berhasil menghapus Grup Chat');
        return redirect()->route('admin.grupchat')->with('danger', 'Terjadi kesalahan saat menghapus Grup Chat');
    }

    public function kick($id) {
        $member = GrupChatMember::where('id_user', $id)->first();
        if($member->delete())
            return back()->with('success', "Berhasil menghapus " . $member->user->nama . " dari Grup Chat");
        return back()->with('danger', 'Terjadi kesalahan saat menghapus member dari Grup Chat');
    }
}
