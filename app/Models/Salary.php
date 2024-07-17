<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $table = 'salary';

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
