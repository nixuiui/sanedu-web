<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetKategori extends Model {
    protected $table    = 'set_kategori';

    //RELATION table
  	public function pustaka() {
  		return $this->hasMany('App\Models\SetPustaka', 'id_kategori');
  	}
}
