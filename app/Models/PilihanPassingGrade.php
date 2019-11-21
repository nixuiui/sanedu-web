<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PilihanPassingGrade extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_pilihan_passing_grade';
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
    public function attempt() {
        return $this->belongsTo('App\Models\Attempt', 'id_attempt')->withDefault();
    }
    public function ujian() {
        return $this->belongsTo('App\Models\Ujian', 'id_ujian')->withDefault();
    }
    public function pilihan1() {
        return $this->belongsTo('App\Models\Jurusan', 'pilihan_1')->withDefault();
    }
    public function pilihan2() {
        return $this->belongsTo('App\Models\Jurusan', 'pilihan_2')->withDefault();
    }
    public function pilihan3() {
        return $this->belongsTo('App\Models\Jurusan', 'pilihan_3')->withDefault();
    }
    public function jurusan() {
        return $this->belongsTo('App\Models\SetPustaka', 'id_ujursan')->withDefault();
    }
}
