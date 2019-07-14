<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PassingGradeOwned extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_passing_grade_owned';
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
  	public function passingGrade() {
  		return $this->belongsTo('App\Models\Universitas', 'id_passing_grade_universitas')->withDefault();
  	}
  	public function user() {
  		return $this->belongsTo('App\Models\User', 'id_user')->withDefault();
  	}
}
