<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Model\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->create();
        // DB::table('users')->insert([
        //     'name' => Str::random(10),
        //     'name' => Str::random(10),
        //     'birthday' => now(),
        //     'email' => Str::random(10).'@gmail.com',
        //     'password' => Hash::make('123123'),
        // ]);
    }
}
