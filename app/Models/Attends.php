<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attends extends Model
{
    use HasFactory;   
	protected $table = 'attends';

	protected $fillable = [
		'id',
		'company_id',
		'depart_id',
		'user_id',
		's1',
		's2',
		's3',
		's4',
		's5',
		's6',
		's7',
		's8',
		's9',
		's10',
		's11',
		's12',
		's13',
		's14',
		's15',
		's16',
		's17',
		's18',
		's19',
		's20',
		's21',
		's22',
		's23',
		's24',
		's25',
		's26',
		's27',
		's28',
		's29',
		's30',
		's31',

		'a1',
		'a2',
		'a3',
		'a4',
		'a5',
		'a6',
		'a7',
		'a8',
		'a9',
		'a10',
		'a11',
		'a12',
		'a13',
		'a14',
		'a15',
		'a16',
		'a17',
		'a18',
		'a19',
		'a20',
		'a21',
		'a22',
		'a23',
		'a24',
		'a25',
		'a26',
		'a27',
		'a28',
		'a29',
		'a30',
		'a31',
		'year',
		'month',
		'notes'

	];
	
}
