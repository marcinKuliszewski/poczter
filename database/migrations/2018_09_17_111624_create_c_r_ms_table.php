<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCRMsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_r_ms', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nazwa')->nullable(true);
            $table->text('tresc')->nullable(true);
            $table->text('autor')->nullable(true);
            $table->text('kategoria')->nullable(true);
            $table->text('pole_a')->nullable(true);
            $table->text('pole_b')->nullable(true);
            $table->text('pole_c')->nullable(true);
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
        Schema::dropIfExists('c_r_ms');
    }
}
