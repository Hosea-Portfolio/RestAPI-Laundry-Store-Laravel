<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customer');
            $table->foreignId('laundry_type_id')->references('id')->on('laundry_type');
            $table->foreignId('payment_status_id')->references('id')->on('payment_status');
            $table->foreignId('payment_type_id')->references('id')->on('payment_type');
            $table->date('transaction_date');
            $table->date('finish_date')->nullable();
            $table->tinyInteger('kilograms');
            $table->integer('total_price');
            $table->integer('pay')->nullable();
            $table->integer('change_money')->nullable();
            $table->string('additional_description')->nullable();
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
        Schema::dropIfExists('transaction');
    }
}
