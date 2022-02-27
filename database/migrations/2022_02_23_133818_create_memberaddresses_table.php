<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberaddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberaddresses', function (Blueprint $table) {
            $table->id();
            $table->integer('a_member_id');
            $table->text('a_address');
            $table->integer('tambon_id');
            $table->integer('province_id');
            $table->integer('district_id');
            $table->integer('a_status');
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
        Schema::dropIfExists('memberaddresses');
    }
}
