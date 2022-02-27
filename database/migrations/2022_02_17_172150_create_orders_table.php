<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('o_product_id');
            $table->integer('o_address_id');
            $table->string('o_amount');
            $table->integer('o_total');
            $table->integer('o_member_id');
            $table->integer('o_status');
            $table->integer('o_bank_id')->nullable();
            $table->string('o_payment')->nullable();
            $table->text('o_note')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
