<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categori extends Model
{
	protected $fillable=['nama'];

	public function blogs()
	{
		return $this->hasMany('App\Blog');
	}

	public static function boot()
	{
		parent::boot();
		self::deleting(function($model) {
// mengecek apakah categori masih punya blog
			if ($model->blogs->count() > 0) {
// menyiapkan pesan error
				$html = 'Categori tidak bisa dihapus karena masih memiliki Blog : ';
				$html .= '<ul>';
				foreach ($categoris->blogs as $blog) {
					$html .= "<li>$blog->judul</li>";
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