<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;   
	protected $table = 'company';

	protected $fillable = [
		'id',
		'user_id',
		'company_name',
		'seo_name',
		'company_num',
		'employ_num',
		'year_num',
		'labor_num',
		'service_employ',
		'service_attend',
		'labor_type',
		'mon_total_days',
		'goto_time_1',
		'goto_time_2',
		'goto_time_sheet',
		'goto_time_type',
		'close_time_1',
		'close_time_2',
		'close_time_sheet',
		'close_time_type',
	];
	
}
