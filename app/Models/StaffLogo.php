<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffLogo extends Model
{
    use HasFactory;
    protected $table = 'staff_logo';

	protected $fillable = [
		'id',
        'user_id',
        'card_id',
	];
}
