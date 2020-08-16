<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('nickname')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('country')->default('Kenya');
            $table->string('phone')->default('07 20 123 456');
            $table->string('accountType')->nullable();
            $table->string('bankName')->nullable();
            $table->string('accountName')->nullable();
            $table->string('accountNumber')->nullable();
            $table->string('educationLevel')->nullable();
            $table->string('profilePhoto')->nullable();
            $table->longText('bio')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('status')->default('inactive');
            $table->rememberToken();
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
        Schema::dropIfExists('editors');
    }
}
