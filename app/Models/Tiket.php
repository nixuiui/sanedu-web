<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tiket extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_tiket';
    protected $primaryKey   = 'id';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $dates        = ['deleted_at'];

    //RELATION table
  	public function kategoriTiket() {
  		return $this->belongsTo('App\Models\SetPustaka', 'id_kategori_tiket')->withDefault();
  	}
  	public function cetakTiket() {
  		return $this->belongsTo('App\Models\CetakTiket', 'id_cetak_tiket')->withDefault();
    }
  	public function simulasi() {
  		return $this->belongsTo('App\Models\Simulasi', 'id_simulasi')->withDefault();
  	}
  	public function user() {
  		return $this->belongsTo('App\Models\User', 'id_user')->withDefault();
  	}
}
