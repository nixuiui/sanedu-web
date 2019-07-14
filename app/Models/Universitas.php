<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Universitas extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_passing_grade_universitas';
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

    public static function mapData($data) {
        return (object)[
            'id' => $data->id,
            'nama' => $data->nama,
            'akreditasi' => $data->akreditasi,
            'harga' => $data->harga,
            'format_harga' => $data->harga > 0 ? formatUang($data->harga) : "Gratis",
            'url_detail' => route('member.passgrade', ['universitas' => $data->id])
        ];
    }

    //RELATION table
    public function jurusan() {
        return $this->hasMany('App\Models\Jurusan', 'id_universitas');
    }
    public function getNamaAttribute($value) {
        return strtoupper($value);
    }
    public function ownedBy() {
        return $this->belongsToMany('App\Models\User', 'tbl_passing_grade_owned', 'id_passing_grade_universitas', 'id_user');
    }
}
