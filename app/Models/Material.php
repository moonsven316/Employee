<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;   
	protected $table = 'material';

	protected $fillable = [
		'id',
		'user_id',
		'dt1',
		'dt2',
		'dt3',
		'dt4',
		'dt5',
		'dt6',
		'dt7',
		'dt8'
	];
	
}
