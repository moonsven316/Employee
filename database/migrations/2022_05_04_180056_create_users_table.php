<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // fields for auth
            $table->string('name')->unique();
            $table->timestamp('password')->nullable();
            $table->string('user_name')->nullable();
            $table->enum('user_name_g')->nullable();
            $table->string('post_code')->default('default.png');
            $table->string('phone')->default('default.png');
            $table->string('address')->nullable();
            $table->string('logo')->nullable();
            $table->enum('country', ['man', 'woman'])->nullable();
            $table->date('gender')->nullable();
            $table->string('social_num')->nullable();
            $table->string('employ_num')->nullable();
            $table->string('email')->nullable();
            $table->string('email_verified_at')->nullable();
            $table->string('birthday')->nullable();
            $table->string('role')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
