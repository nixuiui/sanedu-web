<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Simulasi extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_simulasi';
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
  	public function creator() {
  		return $this->belongsTo('App\Models\User', 'id_creator');
  	}
  	public function jenisUjian() {
  		return $this->belongsTo('App\Models\SetPustaka', 'id_jenis_ujian');
  	}
  	public function agenda() {
  		return $this->hasMany('App\Models\SimulasiAgenda', 'id_simulasi');
  	}
  	public function ruang() {
  		return $this->hasMany('App\Models\SimulasiRuang', 'id_simulasi');
  	}
  	public function ujianDibeli() {
  		return $this->belongsToMany('App\Models\User', 'tbl_simulasi_peserta', 'id_simulasi', 'id_user')
                    ->withPivot('id', 'harga', 'no_peserta', 'created_at');
  	}

}
