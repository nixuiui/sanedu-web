<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaldoTopup extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_saldo_topup';
    protected $primaryKey   = 'id';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $dates        = ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
        });
    }

    //RELATION table
    public function metodePembayaran() {
        return $this->belongsTo('App\Models\MetodePembayaran', 'id_metode_pembayaran')->withDefault();
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'id_user')->withDefault();
    }

}
