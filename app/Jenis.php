<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
	protected $fillable=['nama'];

	public function pakets()
	{
		return $this->hasMany('App\Paket');
	}

	public static function boot()
	{
		parent::boot();
		self::deleting(function($model) {
// mengecek apakah jenis masih punya paket
			if ($model->pakets->count() > 0) {
// menyiapkan pesan error
				$html = 'Jenis tidak bisa dihapus karena masih memiliki Paket : ';
				$html .= '<ul>';
				foreach ($jenis->pakets as $paket) {
					$html .= "<li>$paket->nama</li>";
				}
				$html .= '</ul>';
				Session::flash("flash_notification", [
					"level"=>"danger",
					"message"=>$html
					]);
// membatalkan proses penghapusan
				return false;
			}
		});
	}
}

