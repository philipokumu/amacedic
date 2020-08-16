<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_coins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('admin_id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('adminInvoice_id')->nullable();
            $table->decimal('amount')->default('0.00');
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
        Schema::dropIfExists('admin_coins');
    }
}
