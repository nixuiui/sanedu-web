<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembelianUjian extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_pembelian_ujian';
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
  	public function ujian() {
  		return $this->belongsTo('App\Models\Ujian', 'id_ujian');
  	}
  	public function user() {
  		return $this->belongsTo('App\Models\User', 'id_user');
  	}
}
