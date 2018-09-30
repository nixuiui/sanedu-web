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
  	public function agenda() {
  		return $this->hasMany('App\Models\SimulasiAgenda', 'id_simulasi');
  	}
  	public function ruang() {
  		return $this->hasMany('App\Models\SimulasiRuang', 'id_simulasi');
  	}
  	public function peserta() {
  		return $this->belongsToMany('App\Models\User', 'tbl_simulasi_peserta', 'id_simulasi', 'id_user')
                    ->withPivot('id', 'harga', 'no_peserta', 'created_at');
  	}
    public function getImageUrlAttribute() {
        return env('APP_STORAGE_URL') . $this->featured_image;
    }

}
