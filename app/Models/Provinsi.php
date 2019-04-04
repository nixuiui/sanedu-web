<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provinsi extends Model
{
    use SoftDeletes;
    protected $table    = 'set_provinsi';
    protected $dates 	= ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
        });
    }

    //RELATION table
  	public function kota() {
  		return $this->hasMany('App\Models\Kota', 'id_provinsi');
  	}
  	public function user() {
  		return $this->hasMany('App\Models\User', 'id_provinsi');
  	}
  	public function laporan() {
  		return $this->hasMany('App\Models\Laporan', 'id_provinsi');
  	}
}
