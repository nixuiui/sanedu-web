<?php

namespace App\Model;

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
  		return $this->hasMany('App\Model\Kelurahan', 'id_kecamatan');
  	}
  	public function kota() {
        return $this->belongsTo('App\Model\Kota', 'id_kabupaten');
  	}
}
