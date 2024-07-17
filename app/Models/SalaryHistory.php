<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryHistory extends Model
{
    use HasFactory;
    protected $table = 'salary_history';

	protected $fillable = [
		'staff_id',
		'hourly_wage',
        'basic_allowance',
        'business_allowance',
        'position_allowance',
        'technical_allowance',
        'adjustment_allowance',
        'add_item'
	];
}
