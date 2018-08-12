<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ujian extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_ujian';
    protected $primaryKey   = 'id';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $dates        = ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
            // $data->tiket()->delete();
        });
    }

    //RELATION table
  	public function tingkatSekolah() {
  		return $this->belongsTo('App\Models\SetPustaka', 'id_tingkat_sekolah');
  	}
  	public function jenisUjian() {
  		return $this->belongsTo('App\Models\SetPustaka', 'id_jenis_ujian');
  	}
  	public function tingkatKelas() {
  		return $this->belongsTo('App\Models\SetPustaka', 'id_tingkat_kelas');
  	}
  	public function mataPelajaran() {
  		return $this->belongsTo('App\Models\SetPustaka', 'id_mata_pelajaran');
  	}
  	public function soal() {
  		return $this->hasMany('App\Models\Soal', 'id_ujian');
  	}
  	public function attempt() {
  		return $this->hasMany('App\Models\Attempt', 'id_ujian');
  	}
  	public function diBeliOleh() {
  		return $this->belongsToMany('App\Models\User', 'tbl_pembelian_ujian', 'id_ujian', 'id_user')
                    ->withPivot('id', 'harga', 'created_at');
  	}
}
