<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class SimulasiMapel extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_simulasi_mapel';
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
    public function mapel() {
        return $this->belongsTo('App\Models\SetPustaka', 'id_mapel');
    }

}
