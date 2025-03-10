<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelurahan extends Model
{
    use SoftDeletes;
    protected $table    = 'set_kelurahan';
    protected $dates 	= ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
        });
    }

    //RELATION table
  	public function kecamatan() {
  		return $this->belongsTo('App\Models\Kecamatan', 'id_kecamatan')->withDefault();
  	}
}
