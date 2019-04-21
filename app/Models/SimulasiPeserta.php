<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;


class SimulasiPeserta extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_simulasi_peserta';
    protected $primaryKey   = 'id';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $dates        = ['deleted_at'];

    protected static function boot() {
		parent::boot();
        static::deleting(function($data) {
            $data->attempt()->delete();
            $data->koreksi()->delete();
            $data->passingGrade()->delete();
        });
    }

    //RELATION table
  	public function simulasi() {
  		return $this->belongsTo('App\Models\Simulasi', 'id_simulasi');
  	}
  	public function mapel() {
  		return $this->belongsTo('App\Models\SetPustaka', 'id_mapel');
  	}
  	public function ruang() {
  		return $this->belongsTo('App\Models\SimulasiRuang', 'id_ruang');
  	}
  	public function jadwalOnline() {
  		return $this->belongsTo('App\Models\SimulasiJadwalOnline', 'id_jadwal_online');
  	}
  	public function koreksi() {
  		return $this->hasMany('App\Models\SimulasiKoreksi', 'id_peserta');
  	}
  	public function attempt() {
  		return $this->hasMany('App\Models\Attempt', 'id_peserta_simulasi');
  	}
  	public function profil() {
  		return $this->belongsTo('App\Models\User', 'id_user');
  	}
  	public function passingGrade() {
  		return $this->hasOne('App\Models\PilihanPassingGrade', 'id_peserta');
  	}
  	public function passingGradeLolos() {
  		return $this->belongsTo('App\Models\Jurusan', 'id_passing_grade_lolos')->withDefault();
  	}

}
