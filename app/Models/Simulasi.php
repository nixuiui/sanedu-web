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
    protected $appends      = ['image_url'];

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
  	public function tingkatSekolah() {
  		return $this->belongsTo('App\Models\SetPustaka', 'id_tingkat_sekolah');
  	}
  	public function status() {
  		return $this->belongsTo('App\Models\SetPustaka', 'id_status');
  	}
  	public function kunciJawaban() {
  		return $this->hasMany('App\Models\SimulasiKunciJawaban', 'id_simulasi');
  	}
  	public function agenda() {
  		return $this->hasMany('App\Models\SimulasiAgenda', 'id_simulasi');
  	}
  	public function ruang() {
  		return $this->hasMany('App\Models\SimulasiRuang', 'id_simulasi');
  	}
  	public function jadwalOnline() {
  		return $this->hasMany('App\Models\SimulasiJadwalOnline', 'id_simulasi');
  	}
  	public function peserta() {
  		return $this->hasMany('App\Models\SimulasiPeserta', 'id_simulasi');
  	}
  	public function simulasiUjian() {
  		return $this->hasMany('App\Models\SimulasiUjian', 'id_simulasi');
  	}
  	public function pengawas() {
  		return $this->hasMany('App\Models\SimulasiPengawas', 'id_simulasi');
  	}
    public function getImageUrlAttribute() {
        return env('APP_STORAGE_URL') . $this->featured_image;
    }

}
