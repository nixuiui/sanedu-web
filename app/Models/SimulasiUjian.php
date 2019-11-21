<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SimulasiUjian extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_simulasi_ujian';
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
  		return $this->belongsTo('App\Models\Ujian', 'id_ujian')->withDefault();
  	}
  	public function mapel() {
  		return $this->belongsTo('App\Models\SetPustaka', 'id_mapel')->withDefault();
  	}
  	public function simulasi() {
  		return $this->belongsTo('App\Models\Simulasi', 'id_simulasi')->withDefault();
  	}

}
