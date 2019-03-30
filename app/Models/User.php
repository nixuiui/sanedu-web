<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use SoftDeletes;
    protected $table        = 'tbl_users';
    protected $primaryKey   = 'id';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $dates        = ['deleted_at'];
    protected $hidden       = [
        'password', 'remember_token',
    ];

    protected static function boot() {
        parent::boot();
        static::deleting(function($data) {
            // $data->method()->delete();
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('nama', 'asc');
        });
    }

    //RELATION table
  	public function role() {
  		return $this->belongsTo('App\Models\SetPustaka', 'id_role');
  	}
  	public function tingkatSekolah() {
  		return $this->belongsTo('App\Models\SetPustaka', 'id_tingkat_sekolah');
  	}
  	public function sekolah() {
  		return $this->belongsTo('App\Models\Sekolah', 'id_sekolah');
  	}
  	public function simulasi() {
  		return $this->hasMany('App\Models\Simulasi', 'id_creator');
  	}
  	public function simulasiDibeli() {
  		return $this->belongsToMany('App\Models\Simulasi', 'tbl_simulasi_peserta', 'id_user', 'id_simulasi')
                    ->withPivot('id', 'harga', 'no_peserta', 'created_at');
  	}
    public function cetakTiket() {
        return $this->hasMany('App\Models\CetakTiket', 'id_user');
    }
  	public function tiket() {
  		return $this->hasMany('App\Models\Tiket', 'id_user');
  	}
  	public function grupChat() {
        return $this->belongsToMany('App\Model\GrupChat', 'tbl_grup_chat', 'id_user', 'id_grup_chat')
                    ->withPivot('id', 'akun');
  	}
    public function passwordReset() {
        return $this->hasMany('App\Model\PasswordReset', 'email');
    }
  	public function informasi() {
  		return $this->hasMany('App\Models\Informasi', 'id_author');
  	}
  	public function ujianDibeli() {
  		return $this->belongsToMany('App\Models\Ujian', 'tbl_pembelian_ujian', 'id_user', 'id_ujian')
                    ->withPivot('id', 'harga', 'created_at');
  	}
    public function attempt() {
      return $this->hasMany('App\Models\Attempt', 'id_user');
    }
    public function riwayatSaldo() {
      return $this->hasMany('App\Models\RiwayatSaldo', 'id_user');
    }
}
