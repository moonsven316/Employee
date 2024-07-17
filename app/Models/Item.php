<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	use HasFactory;

	protected $table = 'items';

	protected $fillable = [
		'user_id',
		'item_category',
		'name',
		'caption',
		'asin',
		'jan',
		'am_price',
		'img_url',
		'shop_url',
		'status',
		'is_notified',
		'exhibit',
	];

	// public function category() {
	// 	return $this->belongsTo(
	// 		User::class,
	// 		'category_id'
	// 	);
	// }

	public function user() {
		return $this->belongsTo(
			User::class,
			'user_id'
		);
	}
}
