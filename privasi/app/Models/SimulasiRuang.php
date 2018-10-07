<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class SimulasiRuang extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_simulasi_ruang';
    protected $primaryKey   = 'id';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $dates        = ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
            $data->peserta()->delete();
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('nama', 'asc');
        });
    }

    //RELATION table
  	public function simulasi() {
  		return $this->belongsTo('App\Models\Simulasi', 'id_simulasi');
  	}
  	public function ruangMapel() {
  		return $this->belongsTo('App\Models\SetPustaka', 'id_mapel');
  	}
  	public function peserta() {
  		return $this->belongsToMany('App\Models\User', 'tbl_simulasi_ruang', 'id_ruang', 'id_user')
                    ->withPivot('id', 'id_mapel', 'harga', 'no_peserta', 'created_at');
  	}

}
