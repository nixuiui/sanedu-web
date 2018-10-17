<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jurusan extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_jurusan';
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
    public function universitas() {
        return $this->belongsTo('App\Models\Universitas', 'id_universitas');
    }
    public function getJurusanAttribute($value) {
        return strtoupper($value);
    }
}
