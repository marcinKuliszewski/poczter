<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOdbioriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odbiories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('user_name');
            $table->text('kod');
            $table->text('status');
            $table->text('name');
            $table->text('data_odbioru');
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
        Schema::dropIfExists('odbiories');
    }
}
