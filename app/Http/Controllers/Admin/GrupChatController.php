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
        $grub = GrupChat::whereNull('id_simulasi')
                            ->orderBy("jumlah_member", "desc")
                            ->orderBy("created_at", "asc")
                            ->get();
        return view('admin.grupchat.index')->with([
            'grub' => $grub
        ]);
    }

    public function viewGrup($id) {
        $grup = GrupChat::findOrFail($id);
        $member = GrupChatMember::where("id_grup_chat", $grup->id)->get();
        return view('admin.grupchat.view')->with([
            'grup' => $grup,
            'member' => $member
        ]);
    }

    public function formTambah() {
        return view('admin.grupchat.tambah');
    }

    public function prosesTambah(Request $input) {
        $this->validate($input, [
            'nama'      => 'required|string|max:255',
            'link'      => 'required|url',
        ]);
        $grup = new GrupChat;
        $grup->id = Uuid::generate();
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
        $member = GrupChatMember::where('id', $id)->first();
        if($member->delete())
            return back()->with('success', "Berhasil menghapus " . $member->user->nama . " dari Grup Chat");
        return back()->with('danger', 'Terjadi kesalahan saat menghapus member dari Grup Chat');
    }
}
