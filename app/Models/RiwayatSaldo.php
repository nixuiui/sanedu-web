<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RiwayatSaldo extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_riwayat_saldo';
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
  	public function kategori() {
  		return $this->belongsTo('App\Models\SetPustaka', 'id_kategori');
  	}
  	public function ujian() {
  		return $this->belongsTo('App\Models\Ujian', 'id_object');
  	}
  	public function user() {
  		return $this->belongsTo('App\Models\User', 'id_user');
  	}
}
