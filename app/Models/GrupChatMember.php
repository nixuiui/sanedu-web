<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupChatMember extends Model {
    protected $table        = 'tbl_grup_chat_member';
    protected $primaryKey   = 'id';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $dates        = ['deleted_at'];

    //RELATION table
  	public function kategoriGrupChat() {
  		return $this->belongsTo('App\Models\SetPustaka', 'id_kategori_grup_chat');
  	}
  	public function grupChat() {
  		return $this->belongsTo('App\Models\GrupChat', 'id_grup_chat');
  	}
  	public function user() {
  		return $this->belongsTo('App\Models\User', 'id_user');
  	}
}
