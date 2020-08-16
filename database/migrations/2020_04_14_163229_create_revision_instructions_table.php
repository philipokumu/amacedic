<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionInstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision_instructions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('order_id');
            $table->longText('revisionInstructions');
            $table->string('messageSender');
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
        Schema::dropIfExists('revision_instructions');
    }
}
