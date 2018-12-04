<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kota extends Model
{
    use SoftDeletes;
    protected $table    = 'set_kota';
    protected $dates 		= ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
        });
    }

    //RELATION table
  	public function kecamatan() {
  		return $this->hasMany('App\Model\Kecamatan', 'id_kabupaten');
  	}
  	public function provinsi() {
  		return $this->belongsTo('App\Model\Provinsi', 'id_provinsi');
  	}

    //SCOPE
    public function scopeLampung($query) {
        return $query->where("id_provinsi", 18)->get();
    }
}
