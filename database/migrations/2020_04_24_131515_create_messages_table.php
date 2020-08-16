<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('order_id');
            $table->longText('message');
            $table->string('recipient');
            $table->string('messageSender');
            $table->string('hasClientRead')->nullable();
            $table->string('hasEditorRead')->nullable();
            $table->string('hasWriterRead')->nullable();
            $table->string('hasAdminRead')->default('no');
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
        Schema::dropIfExists('messages');
    }
}
