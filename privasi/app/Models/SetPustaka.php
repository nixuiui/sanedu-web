<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class SetPustaka extends Model {
    protected $table = 'set_pustaka';

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
            // $data->tiket()->delete();
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('nama', 'asc');
        });
    }

    //SCOPE
    public function scopeRole($query, $id = null) {
        $query = $query->where("id_kategori", 10)->get();
        if($id != null) $query = $query->where("id", $id)->first();
        return $query;
    }
    public function scopeKategoriTiket($query, $id = null) {
        $query = $query->where("id_kategori", 11)->get();
        if($id != null) $query = $query->where("id", $id)->first();
        return $query;
    }
    public function scopeKategoriGrupChat($query, $id = null) {
        $query = $query->where("id_kategori", 12)->get();
        if($id != null) $query = $query->where("id", $id)->first();
        return $query;
    }
    public function scopeTingkatSekolah($query, $id = null) {
        $query = $query->where("id_kategori", 13)->get();
        if($id != null) $query = $query->where("id", $id)->first();
        return $query;
    }
    public function scopeJenisUjian($query, $id = null) {
        $query = $query->where("id_kategori", 14)->get();
        if($id != null) $query = $query->where("id", $id)->first();
        return $query;
    }
    public function scopeMataPelajaran($query, $id = null) {
        $query = $query->where("id_kategori", 15)->get();
        if($id != null) $query = $query->where("id", $id)->first();
        return $query;
    }
    public function scopeTingkatKelas($query, $id = null) {
        $query = $query->where("id_kategori", 16)->get();
        if($id != null) $query = $query->where("id", $id)->first();
        return $query;
    }
    public function scopeKategoriInformasi($query, $id = null) {
        $query = $query->where("id_kategori", 17)->get();
        if($id != null) $query = $query->where("id", $id)->first();
        return $query;
    }
    public function scopeKategoriRiwayatSaldo($query, $id = null) {
        $query = $query->where("id_kategori", 18)->get();
        if($id != null) $query = $query->where("id", $id)->first();
        return $query;
    }

    //RELATION table
  	public function kategori() {
  		return $this->belongsTo('App\Models\SetKategori', 'id_kategori');
  	}
  	public function user() {
  		return $this->hasMany('App\Models\User', 'id_role');
  	}
  	public function grupChat() {
  		return $this->hasMany('App\Models\GrupChat', 'id_kategori_grup_chat');
  	}
  	public function ujianBySekolah() {
  		return $this->hasMany('App\Models\Ujian', 'id_tingkat_sekolah');
  	}
  	public function ujianByJenisUjian() {
  		return $this->hasMany('App\Models\Ujian', 'id_jenis_ujian');
  	}
  	public function ujianByKelas() {
  		return $this->hasMany('App\Models\Ujian', 'id_tingkat_kelas');
  	}
  	public function ujianByMataPelajaran() {
  		return $this->hasMany('App\Models\Ujian', 'id_mata_pelajaran');
  	}
  	public function simulasiByTingkatSekolah() {
  		return $this->hasMany('App\Models\Simulasi', 'id_tingkat_sekolah');
  	}
  	public function informasi() {
  		return $this->hasMany('App\Models\Informasi', 'id_kategori');
  	}
  	public function riwayatSaldo() {
  		return $this->hasMany('App\Models\RiwayatSaldo', 'id_kategori');
  	}
}
