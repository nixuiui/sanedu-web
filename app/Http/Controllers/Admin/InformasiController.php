<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use Uuid;
use App\Models\Informasi;
use App\Models\SetPustaka;

class InformasiController extends Controller
{
    public function index() {
        $informasi = Informasi::orderBy("created_at", "desc")->get();
        return view('admin.informasi.index')->with([
            'informasi' => $informasi
        ]);
    }

    public function viewGrup($id) {
        $grup = GrupChat::findOrFail($id);
        return view('admin.grupchat.view')->with([
            'grup' => $grup
        ]);
    }

    public function formInformasi($id = null) {
        $kategori = SetPustaka::kategoriInformasi();
        if($id == null)
        return view('admin.informasi.form')->with([
            'kategori' => $kategori
        ]);

        $informasi = Informasi::find($id);
        return view('admin.informasi.form')->with([
            'kategori' => $kategori,
            'informasi' => $informasi
        ]);
    }

    public function saveInformasi(Request $input, $id=null) {
        $this->validate($input, [
            'judul'     => 'required|string',
            'isi'       => 'required',
            'kategori'  => 'required|exists:set_pustaka,id',
        ]);
        $informasi = new Informasi;
        $informasi->id = Uuid::generate();
        if($id != null) $informasi = Informasi::find($id);
        $informasi->judul = $input->judul;
        $informasi->id_kategori = $input->kategori;
        $informasi->isi = $input->isi;
        $informasi->id_author = Auth::id();
        if($input->foto != null) {
            $upload = $this->uploadImage($input->foto);
            if($upload->success) $informasi->foto = $upload->filename;
            else return back()->with('danger', 'Gambar tidak terupload');
        }
        if($informasi->save())
            return redirect()->route('admin.informasi')->with('success', 'Berhasil membuat informasi baru');
        return redirect()->route('admin.informasi')->with('danger', 'Terjadi kesalahan saat membuat informasi');
    }

    public function delete($id) {
        $informasi = Informasi::findOrFail($id);
        if($informasi->delete())
            return redirect()->route('admin.informasi')->with('success', 'Berhasil menghapus Informasi ' . $informasi->judul);
        return redirect()->route('admin.informasi')->with('danger', 'Terjadi kesalahan saat menghapus Informasi');
    }

    public function kick($id) {
        $member = GrupChatMember::where('id_user', $id)->first();
        if($member->delete())
            return back()->with('success', "Berhasil menghapus " . $member->user->nama . " dari Grup Chat");
        return back()->with('danger', 'Terjadi kesalahan saat menghapus member dari Grup Chat');
    }
}
