<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CetakTiket extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_cetak_tiket';
    protected $primaryKey   = 'id';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $dates        = ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
            $data->tiket()->delete();
        });
    }

    //RELATION table
  	public function kategoriTiket() {
  		return $this->belongsTo('App\Models\SetPustaka', 'id_kategori_tiket');
  	}
  	public function user() {
  		return $this->belongsTo('App\Models\User', 'id_user');
  	}
  	public function tiket() {
  		return $this->hasMany('App\Models\Tiket', 'id_cetak_tiket');
  	}
}
