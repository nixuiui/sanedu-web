<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sekolah extends Model
{
    use SoftDeletes;
    protected $table    = 'tbl_sekolah';
    protected $primaryKey   = 'id';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $dates 	= ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
        });
    }

    //RELATION table
  	public function kota() {
        return $this->belongsTo('App\Models\Kota', 'id_kota');
  	}
  	public function provinsi() {
        return $this->belongsTo('App\Models\Provinsi', 'id_provinsi');
  	}
}
