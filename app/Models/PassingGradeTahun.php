<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PassingGradeTahun extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_passing_grade_tahun';
    protected $primaryKey   = 'tahun';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $dates        = ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
            // $data->tiket()->delete();
        });
    }

    public function scopeActive($query, $id = null) {
        $query = $query->where("is_active", true)->first();
        return $query;
    }

    //RELATION table
    public function jurusan() {
        return $this->hasMany('App\Models\Jurusan', 'tahun');
    }
    public function getJurusanAttribute($value) {
        return strtoupper($value);
    }
}
