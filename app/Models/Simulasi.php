<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Simulasi extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_simulasi';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
    protected $appends = ['image_url', 'tiket_url'];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($data) {
            // $data->tiket()->delete();
        });
    }

    //RELATION table
    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'id_creator');
    }
    public function cetakTiket()
    {
        return $this->hasMany('App\Models\CetakTiket', 'id_simulasi');
    }
    public function tiket()
    {
        return $this->hasMany('App\Models\Tiket', 'id_simulasi');
    }
    public function grupChat()
    {
        return $this->hasMany('App\Models\GrupChat', 'id_simulasi');
    }
    public function tingkatSekolah()
    {
        return $this->belongsTo('App\Models\SetPustaka', 'id_tingkat_sekolah');
    }
    public function jenisUjian()
    {
        return $this->belongsTo('App\Models\SetPustaka', 'id_jenis_ujian');
    }
    public function status()
    {
        return $this->belongsTo('App\Models\SetPustaka', 'id_status');
    }
    public function kunciJawaban()
    {
        return $this->hasMany('App\Models\SimulasiKunciJawaban', 'id_simulasi');
    }
    public function agenda()
    {
        return $this->hasMany('App\Models\SimulasiAgenda', 'id_simulasi');
    }
    public function ruang()
    {
        return $this->hasMany('App\Models\SimulasiRuang', 'id_simulasi');
    }
    public function jadwalOnline()
    {
        return $this->hasMany('App\Models\SimulasiJadwalOnline', 'id_simulasi');
    }
    public function peserta()
    {
        return $this->hasMany('App\Models\SimulasiPeserta', 'id_simulasi');
    }
    public function simulasiUjian()
    {
        return $this->hasMany('App\Models\SimulasiUjian', 'id_simulasi');
    }
    public function pengawas()
    {
        return $this->hasMany('App\Models\SimulasiPengawas', 'id_simulasi');
    }

	// APPEND ATTRIBUTES
    public function getImageUrlAttribute()
    {
        return env('APP_STORAGE_URL') . $this->featured_image;
    }
    public function getTiketUrlAttribute()
    {
		if($this->gambar_tiket) 
			return env('APP_STORAGE_URL') . $this->gambar_tiket;
		return asset('image/template_tiket.png');
    }

}
