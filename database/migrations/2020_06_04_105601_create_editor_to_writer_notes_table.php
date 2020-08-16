<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditorToWriterNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editor_to_writer_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('editor_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('writer_id');
            $table->longText('noteToWriter');
            $table->string('rating');
            $table->string('hasWriterRead')->default('no');
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
        Schema::dropIfExists('editor_to_writer_notes');
    }
}
