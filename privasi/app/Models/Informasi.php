<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Informasi extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_informasi';
    protected $primaryKey   = 'id';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $dates        = ['deleted_at'];
    protected $appends      = ['foto_url'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
            // $data->tiket()->delete();
        });
    }

    //RELATION table
    public function kategori() {
        return $this->belongsTo('App\Models\SetPustaka', 'id_kategori');
    }
    public function author() {
        return $this->belongsTo('App\Models\User', 'id_author');
    }
    public function getFotoUrlAttribute() {
        return "http://storage.sanedu.id/" . $this->foto;

    }
}
