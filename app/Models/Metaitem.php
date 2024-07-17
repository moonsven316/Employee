<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metaitem extends Model
{
    use HasFactory;   
	protected $table = 'metaitem';

	protected $fillable = [
		'id',
		'company_id',
		'metaitem',
		'metaitem_id',
		'kind',
		'description'
	];
	
}
