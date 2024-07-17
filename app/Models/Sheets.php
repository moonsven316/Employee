<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sheets extends Model
{
    use HasFactory;   
	protected $table = 'sheets';

	protected $fillable = [
		'id',
		'company_id',
		'sheet_name',
		'sheet_name_1',
		'sheet_color',
		'rest_day',
		'open_time',
		'close_time',
		'rest_time',
		'rest_apply',
		'minashi_1',
		'minashi_2',
		'minashi_3',
		'ch_sheet',
	];
	
}
