<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RiwayatSaldo extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_riwayat_saldo';
    protected $dates        = ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
            // $data->tiket()->delete();
        });
    }

    //RELATION table
  	public function kategori() {
  		return $this->belongsTo('App\Models\SetPustaka', 'id_kategori')->withDefault();
  	}
  	public function ujian() {
  		return $this->belongsTo('App\Models\Ujian', 'id_object')->withDefault();
  	}
  	public function user() {
  		return $this->belongsTo('App\Models\User', 'id_user')->withDefault();
  	}
}
