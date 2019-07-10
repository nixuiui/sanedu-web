<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PassingGradeNilaiUTBK extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_passing_grade_nilai_utbk';
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
    public function jurusan() {
        return $this->belongsTo('App\Models\Jurusan', 'id_jurusan')->withDefault();
    }
    public function getJurusanAttribute($value) {
        return strtoupper($value);
    }
}
