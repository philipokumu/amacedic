<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('couponCode')->unique();
            $table->string('couponName');
            $table->integer('orderBasedCouponValue')->nullable();
            $table->longText('description');
            $table->string('isUsed')->default('no');
            $table->string('type');
            $table->integer('percent_off')->nullable();
            $table->integer('page_off')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
