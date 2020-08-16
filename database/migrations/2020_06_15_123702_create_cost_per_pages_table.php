<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostPerPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_per_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('writerPageCPP')->default('5.00');
            $table->decimal('writerPowerpointCPP')->default('4.00');
            $table->decimal('writerUrgentPageCPP')->default('6.00');
            $table->decimal('writerUrgentPPTCPP')->default('5.00');
            $table->decimal('editorPageCPP')->default('1.00');
            $table->decimal('editorPowerpointCPP')->default('1.00');
            $table->decimal('expensesPageCPP')->default('1.00');
            $table->decimal('expensesPowerpointCPP')->default('1.00');
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
        Schema::dropIfExists('cost_per_pages');
    }
}
