<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
	protected $fillable = ['id','jenis_id','nama', 'isi', 'harga','cover'];

	public function jenis()
	{
		return $this->belongsTo('App\Jenis');
	}
}
