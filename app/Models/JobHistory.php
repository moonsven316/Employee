<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobHistory extends Model
{
    use HasFactory;
    protected $table = 'job_history';

	protected $fillable = [
		'staff_id',
        'job_history',
        'depart_history'
	];
}
