<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class MetodePembayaran extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_metode_pembayaran';
    protected $dates        = ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
        });
        static::addGlobalScope('order', function (Builder $builder) {
        });
    }
}
