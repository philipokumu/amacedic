<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->default('07 20 123 456');
            $table->string('country')->default('United States');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('isFirstOrderPaid')->default('no');
            $table->string('status')->default('active');
            $table->ipAddress('visitor')->nullable();
            $table->uuid('referralId')->nullable();
            $table->unsignedInteger('referredBy')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::update("ALTER TABLE users AUTO_INCREMENT = 100;");
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
