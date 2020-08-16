<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->UnsignedBigInteger('account_id');
            $table->string('accountType');
            $table->string('subjectArea');
            $table->timestamps();

            // $table->foreign('writer_id')->references('id')->on('writer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_areas');
    }
}
