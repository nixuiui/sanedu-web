<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class SimulasiKunciJawaban extends Model {
    protected $table        = 'tbl_simulasi_kunci_jawaban';
    protected $primaryKey   = 'id';
    protected $keyType      = 'string';
    public $incrementing    = false;

    protected static function boot() {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('no', 'asc');
        });
    }

    //RELATION table
  	public function simulasi() {
  		return $this->belongsTo('App\Models\Simulasi', 'id_simulasi')->withDefault();
  	}
    public function getJawabanAttribute($value) {
        return strtoupper($value);
    }

}
