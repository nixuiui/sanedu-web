<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PassingGradeCetakVoucher extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_passing_grade_cetak_voucher';
    protected $primaryKey   = 'id';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $dates        = ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
            $data->vouchers()->delete();
        });
    }

    //RELATION table
  	public function user() {
  		return $this->belongsTo('App\Models\User', 'id_user');
  	}
  	public function vouchers() {
  		return $this->hasMany('App\Models\PassingGradeVoucher', 'id_cetak_voucher');
  	}
}
