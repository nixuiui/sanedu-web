<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SimulasiPenempatan extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_simulasi_penempatan';
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
  	public function simulasi() {
  		return $this->belongsTo('App\Models\Simulasi', 'id_simulasi');
  	}
  	public function ruang() {
  		return $this->belongsTo('App\Models\SimulasiRuang', 'id_ruang');
  	}
  	public function user() {
  		return $this->belongsTo('App\Models\User', 'id_user');
  	}

}
