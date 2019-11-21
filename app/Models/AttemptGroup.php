<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class AttemptGroup extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_attempt_group';
    protected $primaryKey   = 'id';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $dates        = ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
            // $data->tiket()->delete();
        });
		static::addGlobalScope('order', function (Builder $builder) {
			$builder->orderBy('created_at', 'asc');
		});
    }

    //RELATION table
  	public function attempt() {
        return $this->belongsTo('App\Models\Attempt', 'id_attempt')->withDefault();
    }
    public function correction() {
        return $this->hasMany('App\Models\AttemptCorrection', 'id_attempt_group');
    }
    public function ujianGroup() {
      return $this->belongsTo('App\Models\UjianGroup', 'id_ujian_group')->withDefault();
  }
}
