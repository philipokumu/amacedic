<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id')->from(500);
            $table->unsignedInteger('user_id');
            $table->string('academicLevel');
            $table->string('typeOfPaper');
            $table->string('subjectArea');
            $table->string('title');
            $table->longText('paperInstructions');
            $table->unsignedInteger('writer_id')->nullable();
            $table->unsignedInteger('editor_id')->nullable();
            $table->string('status')->default('unpaid');
            $table->string('isUrgent')->default('no');
            $table->dateTime('unassigned_at')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->string('preferredWriter_id')->nullable();
            $table->string('citation');
            $table->string('spacing');
            $table->integer('powerpointSlides')->default('0');
            $table->integer('noOfPages')->default('0');
            $table->integer('sources')->default('0');
            $table->string('deadline');
            $table->dateTime('endDate')->nullable();
            $table->dateTime('writerMaximumExtensionDate')->nullable();
            $table->dateTime('writerEndDate')->nullable();
            $table->string('currency');
            $table->decimal('totalPrice');
            $table->decimal('totalPriceInKsh');
            $table->decimal('discount')->nullable();
            $table->string('coupon')->nullable();
            $table->string('rating')->nullable();
            $table->string('ratingComment')->nullable();
            $table->longText('clientCancelReason')->nullable();
            $table->longText('adminCancelReason')->nullable();
            $table->string('isRefunded')->default('no');
            $table->dateTime('refunded_at')->nullable();
            $table->unsignedInteger('refundedByAdmin_id')->nullable();
            $table->decimal('originalWriterAmount')->default('0.00');
            $table->decimal('writerAmount')->default('0.00');
            $table->unsignedInteger('writerInvoice_id')->nullable();
            $table->dateTime('writerAmountRequested_at')->nullable();
            $table->decimal('editorAmount')->default('0.00');
            $table->unsignedInteger('editorInvoice_id')->nullable();
            $table->dateTime('editorAmountRequested_at')->nullable();
            $table->decimal('expensesAmount')->default('0.00');
            $table->unsignedInteger('expensesInvoice_id')->nullable();
            $table->dateTime('expensesAmountRequested_at')->nullable();
            $table->decimal('balance')->default('0.00');
            $table->ipAddress('visitor');
            $table->timestampsTz();
        });

        // DB::update("ALTER TABLE orders AUTO_INCREMENT = 500;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
