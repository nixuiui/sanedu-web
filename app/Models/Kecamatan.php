<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kecamatan extends Model
{
    use SoftDeletes;
    protected $table    = 'set_kecamatan';
    protected $dates 	= ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
        });
    }

    //RELATION table
  	public function kelurahan() {
  		return $this->hasMany('App\Models\Kelurahan', 'id_kecamatan');
  	}
  	public function kota() {
        return $this->belongsTo('App\Models\Kota', 'id_kabupaten')->withDefault();
  	}
}
