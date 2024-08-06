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
		's01',
		's02',
		's03',
		's04',
		's05',
		's06',
		's07',
		's08',
		's09',
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

		'a01',
		'a02',
		'a03',
		'a04',
		'a05',
		'a06',
		'a07',
		'a08',
		'a09',
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
