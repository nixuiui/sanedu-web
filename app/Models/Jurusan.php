<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jurusan extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_passing_grade_jurusan';
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
        $arr = [
            "id" => $data->id,
            "id_universitas" => $data->id_universitas,
            "universitas" => $data->universitas->nama,
            "jurusan" => $data->jurusan,
            "kuota" => $data->kuota,
            "peminat" => $data->peminat,
            "passing_grade" => $data->passing_grade,
            "akreditasi" => $data->akreditasi,
            "soshum" => $data->soshum,
            "saintek" => $data->saintek,
            "tahun" => $data->tahun,
            "s_penalaran_umum" => $data->nilaiUTBK->s_penalaran_umum ?: "-",
            "s_kuantitatif" => $data->nilaiUTBK->s_kuantitatif ?: "-",
            "s_pemahaman_umum" => $data->nilaiUTBK->s_pemahaman_umum ?: "-",
            "s_baca_menulis" => $data->nilaiUTBK->s_baca_menulis ?: "-"
        ];
        if($data->soshum) {
            $arr["ips_matematika"] = $data->nilaiUTBK->ips_matematika ?: "-";
            $arr["ips_geografi"] = $data->nilaiUTBK->ips_geografi ?: "-";
            $arr["ips_sejarah"] = $data->nilaiUTBK->ips_sejarah ?: "-";
            $arr["ips_sosiologi"] = $data->nilaiUTBK->ips_sosiologi ?: "-";
            $arr["ips_ekonomi"] = $data->nilaiUTBK->ips_ekonomi ?: "-";
        }
        if($data->saintek) {
            $arr["ipa_matematika"] = $data->nilaiUTBK->ipa_matematika ?: "-";
            $arr["ipa_fisika"] = $data->nilaiUTBK->ipa_fisika ?: "-";
            $arr["ipa_kimia"] = $data->nilaiUTBK->ipa_kimia ?: "-";
            $arr["ipa_biologi"] = $data->nilaiUTBK->ipa_biologi ?: "-";
        }
        return (object) $arr;
    }

    //RELATION table
    public function universitas() {
        return $this->belongsTo('App\Models\Universitas', 'id_universitas')->withDefault();
    }
    public function nilaiUTBK() {
        return $this->hasOne('App\Models\PassingGradeNilaiUTBK', 'id_jurusan')->withDefault();
    }
    public function getJurusanAttribute($value) {
        return strtoupper($value);
    }
}
