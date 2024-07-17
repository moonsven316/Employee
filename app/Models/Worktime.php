<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worktime extends Model
{
    use HasFactory;
    protected $table = 'working_time';

	protected $fillable = [
		'company_id',
		'first_day',
		'second_day',
		'third_day',
		'fourth_day',
	];
}
