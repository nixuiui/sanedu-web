<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AttemptCorrection extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_attempt_correction';
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
  	public function soal() {
        return $this->belongsTo('App\Models\Soal', 'id_soal');
    }
  	public function attempt() {
        return $this->belongsTo('App\Models\Attempt', 'id_attempt');
    }
    public function attemptGroup() {
        return $this->belongsTo('App\Models\AttemptGroup', 'id_attempt_group');
    }
}
