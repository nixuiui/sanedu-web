<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class SimulasiJadwalOnline extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_simulasi_jadwal_online';
    protected $primaryKey   = 'id';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $dates        = ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
            $data->pesertaPivot()->forceDelete();
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('tanggal', 'asc');
        });
    }

    //RELATION table
  	public function simulasi() {
  		return $this->belongsTo('App\Models\Simulasi', 'id_simulasi')->withDefault();
  	}
  	public function pesertaPivot() {
  		return $this->hasMany('App\Models\SimulasiPeserta', 'id_jadwal_online');
  	}
  	public function peserta() {
  		return $this->belongsToMany('App\Models\User', 'tbl_simulasi_peserta', 'id_jadwal_online', 'id_user')
                    ->withPivot('id', 'id_mapel', 'harga', 'no_peserta', 'is_attempted', 'created_at');
  	}

}
