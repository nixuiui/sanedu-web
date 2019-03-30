<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class UjianGroup extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_ujian_group';
    protected $primaryKey   = 'id';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $dates        = ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
            // $data->soal()->delete();
        });
		static::addGlobalScope('order', function (Builder $builder) {
			$builder->orderBy('created_at', 'asc');
		});
    }

    //RELATION table
  	public function ujian() {
  		return $this->belongsTo('App\Models\Ujian', 'id_ujian');
  	}
  	public function soal() {
  		return $this->hasMany('App\Models\Soal', 'id_ujian_group');
  	}
}
