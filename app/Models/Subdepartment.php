<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdepartment extends Model
{
    use HasFactory;   
	protected $table = 'subdepartment';

	protected $fillable = [
		'id',
		'depart_id',
		'name',
		'description',
	];
}
