<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'company_id',
        'job_id',
        'depart_id',
        'sub_depart_id',
        'password', 
        'user_name',
        'user_name_g',
        'zip1',
        'zip2',
        'pref',
        'addr',
        'str',
        'phone',
        'avatar',
        'address',
        'country',
        'gender',
        'social_num',
        'employ_num',
        'email',
        'email_verified_at',
        'birthday',
        'role',
        'metaitem',
        'total_work_time',
        'salary_date',
        'idm',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    // public function categories() {
    //     return $this->hasMany(
    //         Category::class,
    //     );
    // }

    public function items() {
        return $this->hasMany(
            Item::class,
        );
    }
}
