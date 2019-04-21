<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Attempt extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_attempt';
    protected $primaryKey   = 'id';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $dates        = ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
            $data->correction()->delete();
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('start_attempt', 'asc');
        });
    }

    //RELATION table
  	public function ujian() {
  		return $this->belongsTo('App\Models\Ujian', 'id_ujian');
  	}
  	public function user() {
  		return $this->belongsTo('App\Models\User', 'id_user');
  	}
  	public function group() {
  		return $this->hasMany('App\Models\AttemptGroup', 'id_attempt');
  	}
  	public function correction() {
  		return $this->hasMany('App\Models\AttemptCorrection', 'id_attempt');
  	}
}
