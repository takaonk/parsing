<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
	protected $fillable = ['id','categoris_id','judul', 'about','cover'];

	public function categoris()
	{
		return $this->belongsTo('App\Categori');
	}
}
