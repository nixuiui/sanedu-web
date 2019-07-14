<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PassingGradeVoucher extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_passing_grade_voucher';
    protected $primaryKey   = 'id';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $dates        = ['deleted_at'];

    //RELATION table
  	public function cetakVoucher() {
  		return $this->belongsTo('App\Models\PassingGradeCetakVoucher', 'id_cetak_voucher');
    }
  	public function user() {
  		return $this->belongsTo('App\Models\User', 'id_user');
  	}
}
