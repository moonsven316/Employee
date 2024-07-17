<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userhistory extends Model
{
    use HasFactory;
    protected $table = 'userhistory';

	protected $fillable = [
		'id',
        'staff_id',
		'history'
	];
}
