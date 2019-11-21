<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrupChatMember extends Model {
    use SoftDeletes;
    protected $table        = 'tbl_grup_chat_member';
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

    //RELATION table
  	public function kategoriGrupChat() {
  		return $this->belongsTo('App\Models\SetPustaka', 'id_kategori_grup_chat')->withDefault();
  	}
  	public function grupChat() {
  		return $this->belongsTo('App\Models\GrupChat', 'id_grup_chat')->withDefault();
  	}
  	public function user() {
  		return $this->belongsTo('App\Models\User', 'id_user')->withDefault();
  	}
}
